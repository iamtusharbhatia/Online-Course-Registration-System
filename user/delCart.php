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

$c_id = $_GET["c_id"];

$result = mysqli_query($conn,"delete from user_cart where c_id=$c_id and net_id = '$net_id'");

header('Content-Type: application/json');
print '{"Netid" :';
print json_encode($net_id);
print ', "Courseid" :';
print json_encode($c_id);
print '}'; 
?>