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
$c_id = $_POST["c_id"];

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');

$result = mysqli_query($conn,"select term_id from term_code where status = 1");

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)){
		$term_id = $row["term_id"];
	}
}


$result = mysqli_query($conn,"delete from user_courses_enrolled where c_id=$c_id and net_id = '$net_id' and term_id = '$term_id'");

if($result)	{
	$result = mysqli_query($conn,"UPDATE course_term_assignment SET avail_seats = avail_seats + 1 WHERE c_id = $c_id and term_id = '$term_id'");
} else {
	$result = false;
}

if($result)	{
	echo "success";
} else {
	echo "Error";
}

?>