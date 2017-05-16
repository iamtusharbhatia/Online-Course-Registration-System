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

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');

$c_id = $_POST["c_id"];

$result = mysqli_query($conn,"INSERT INTO user_cart(net_id, c_id) VALUES ('$net_id',$c_id)");

if($result)	{
	echo "success";
} else {
	echo "Error";
}

?>