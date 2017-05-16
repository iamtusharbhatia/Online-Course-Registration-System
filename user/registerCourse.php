<?php
session_start();
?>

<?php
if(!isset($_SESSION['sess_username'])) {
  header("location: ../index.html");
  exit();
}

?>

<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";
$net_id= $_SESSION['sess_username'];
$c_id = $_POST['c_id'];


//Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');

$result = mysqli_query($conn,"select term_id from term_code where status = 1");

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)){
		$term_id = $row["term_id"];
	}
}

$result = mysqli_query($conn,"select count(*) as total from user_courses_enrolled where net_id = '$net_id' and term_id = '$term_id' and estatus = 'e'");
$data=mysqli_fetch_assoc($result);
$numCoursesEnrolled = $data['total'];

if( count($c_id) + $numCoursesEnrolled >3 ){
	echo "Your cannot have a total of more than three courses";
} else {
	foreach( $c_id as $v ) {
		
		$result = mysqli_query($conn,"select status from course_term_assignment where c_id = $v and term_id = '$term_id'");

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)){
				$courseStatus = $row["status"];
			}
		}
		
		if($courseStatus == '1'){
			$result = mysqli_query($conn,"select avail_seats from course_term_assignment where c_id = $v");
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)){
					$available = $row["avail_seats"];
				}
			}
			
			if($available > 0){
				$result = mysqli_query($conn,"INSERT INTO user_courses_enrolled VALUES ('$net_id',$v,'e','$term_id')");
				if($result)	{
					$result = mysqli_query($conn,"UPDATE course_term_assignment SET avail_seats = avail_seats - 1 WHERE c_id = $v and term_id = '$term_id' ");
					if($result){
						$result = mysqli_query($conn,"DELETE FROM user_cart where net_id='$net_id' and c_id = $v");
					}
				} else {
					$result = false;
				}
			} else {
				$result = false;
			}
			
			if($result == false){
				break;
			}
		} else {
			$result = false;
		}
	}
	if($result)	{
		echo "success";
	} else {
		echo "Error";
	}
}

?>