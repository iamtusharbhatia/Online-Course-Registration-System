<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";
$param1 = $_GET['param1'];

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');

$result = mysqli_query($conn,"select term_id from term_code where status = 1");

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)){
		$term_id = $row["term_id"];
	}
}


if($param1 != "" && $param1 != "All"){
	$result = mysqli_query($conn,"SELECT c.c_id as id, c.c_no as cnum, c.s_no as snum, c.c_name as cname, c.descr as descr, d.dname as dname FROM course_details c,department d, course_term_assignment t WHERE c.d_id = d.d_id and d.d_id='$param1' and c.c_id = t.c_id");// and t.term_id = '$term_id' and t.status = '1'");
} else {
	$result = mysqli_query($conn,"SELECT c.c_id as id, c.c_no as cnum, c.s_no as snum, c.c_name as cname, c.descr as descr, d.dname as dname FROM course_details c,department d, course_term_assignment t WHERE c.d_id = d.d_id and c.c_id = t.c_id");  //and t.term_id = '$term_id' and t.status = '1'");
}


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

mysqli_close($conn);

?>
       