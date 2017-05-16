<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');

$net_id = $_GET["username"];

$result = mysqli_query($conn,"SELECT net_id from user_login where net_id = '$net_id'");

if (mysqli_num_rows($result) > 0) {
	echo "1";
} else {
	echo "0";
}

?>