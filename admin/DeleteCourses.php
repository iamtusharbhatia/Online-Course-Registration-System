<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";
$c_id = $_POST["c_id"];

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');

$result = mysqli_query($conn,"select term_id from term_code where status = 1");

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)){
		$term_id = $row["term_id"];
	}
}

$result = mysqli_query($conn,"update course_term_assignment set status=0 where c_id='$c_id'");
if($result){
	$result = mysqli_query($conn,"update user_courses_enrolled set estatus='d' where c_id='$c_id' and term_id = '$term_id'");
}

if($result)	{
	echo "success";
} else {
	echo "Error";
}

?>