<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";
$c_id = $_POST['c_id'];
$net_id = $_POST['netId'];


//Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');

$result = mysqli_query($conn,"select term_id from term_code where status = 1");

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)){
		$term_id = $row["term_id"];
	}
}

	
$result = mysqli_query($conn,"select avail_seats from course_term_assignment where c_id = $c_id");
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)){
		$available = $row["avail_seats"];
	}
}


$result = mysqli_query($conn,"INSERT INTO user_courses_enrolled VALUES ('$net_id',$c_id,'e','$term_id')");
if($result)	{
	$result = mysqli_query($conn,"UPDATE course_term_assignment SET avail_seats = avail_seats - 1 WHERE c_id = $c_id");
} else {
	$result = false;
}
	
if($result)	{
	echo "success";
} else {
	echo "Error";
}

?>