<?php
session_start();

if(isset($_SESSION['sess_username']))
{
	session_destroy();
	
}
	header("Location: ../index.html");
?>