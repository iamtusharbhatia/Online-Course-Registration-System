<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";
$net_id= $_GET['netId'];

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');

if($net_id == ""){
	$json = array();
	echo json_encode($json);
} else {
	$result = mysqli_query($conn,"SELECT c.c_id as id, c.c_name as name, c.descr as descr, u.term_id as term, u.estatus as status FROM course_details c,user_courses_enrolled u WHERE u.net_id = '$net_id' and u.c_id = c.c_id");

	if (mysqli_num_rows($result) > 0) {
		$json = array();
		 while ($row = mysqli_fetch_assoc($result))
			{
			 $json[] = $row; 
			}
		$response = array(
			"data" => $json
		);

		echo json_encode($response);
	} else {
		$json = array();
		$response = array(
			"data" => $json
		);
		echo json_encode($response);
	}
}

mysqli_close($conn);

?>
       