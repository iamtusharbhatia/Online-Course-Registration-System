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

$result = mysqli_query($conn,"select term_id from term_code where status = 1");

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)){
		$term_id = $row["term_id"];
	}
}

$result = mysqli_query($conn,"SELECT c.c_id as id, c.c_name as name, c.descr as descr, t.avail_seats as seats, CASE when t.status = '0' THEN 'Not Available' ELSE 'Available' END as status FROM course_details c,user_cart u, course_term_assignment t WHERE u.net_id = '$net_id' and u.c_id = c.c_id and u.c_id = t.c_id and t.term_id = '$term_id'");

$json = array();
if (mysqli_num_rows($result) > 0) {
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

mysqli_close($conn);

?>
       