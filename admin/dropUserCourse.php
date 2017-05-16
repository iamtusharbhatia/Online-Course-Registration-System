<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";

$c_id = $_POST["c_id"];
$net_id = $_POST["netId"];

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');

$result = mysqli_query($conn,"delete from user_courses_enrolled where c_id=$c_id and net_id = '$net_id'");

if($result)	{
	$result = mysqli_query($conn,"UPDATE course_term_assignment SET avail_seats = avail_seats + 1 WHERE c_id = $c_id");
} else {
	$result = false;
}

if($result)	{
	echo "success";
} else {
	echo "Error";
}

?>