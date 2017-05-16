<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');  
$courseid = mysqli_real_escape_string($conn, $_POST['courseid']);

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
		case 'Insert':
		    $coursenumber = mysqli_real_escape_string($conn, $_POST['coursenumber']);
			$sectionnumber = mysqli_real_escape_string($conn, $_POST['sectionnumber']);
			$prereq = mysqli_real_escape_string($conn, $_POST['prereq']);
			$professor = mysqli_real_escape_string($conn, $_POST['professor']);
			$termid = mysqli_real_escape_string($conn, $_POST['termid']);
			$timings = mysqli_real_escape_string($conn, $_POST['timings']);
			$maxclassstrength = mysqli_real_escape_string($conn, $_POST['maxclassstrength']);
			
			$deptid= mysqli_real_escape_string($conn, $_POST['deptid']);
			$coursename = mysqli_real_escape_string($conn, $_POST['coursename']);
			$description= mysqli_real_escape_string($conn, $_POST['description']);
         
            insert($conn,$courseid,$coursenumber,$sectionnumber,$prereq,$professor,$termid,$timings,$maxclassstrength,$deptid,$coursename,$description);
			break;
    }
}

if(mysqli_connect_errno()){
	echo "Failed";
}	

function insert($conn,$courseid,$coursenumber,$sectionnumber,$prereq,$professor,$termid,$timings,$maxclassstrength,$deptid,$coursename,$description)
{
	
	$sql = "INSERT INTO course_details(c_id, c_no,s_no,d_id,c_name,descr) VALUES ('$courseid','$coursenumber','$sectionnumber','$deptid','$coursename','$description')";
	$result = mysqli_query($conn,$sql);
	echo $sql;
	
	$sql1 = "INSERT INTO course_term_assignment(c_id,lname,term_id,status,timings,max_strength,avail_seats) VALUES ('$courseid','$professor','$termid','1','$timings','$maxclassstrength','$maxclassstrength')";
	$result1 = mysqli_query($conn,$sql1);
	echo $sql1;
	
	$sql2 = "INSERT INTO pre_req(c_id,prereq) VALUES ('$courseid','$prereq')";
	$result2= mysqli_query($conn,$sql2);
	echo $sql2;
	exit;
}	

mysqli_close($conn);

?>