<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');  
$courseid = mysqli_real_escape_string($conn, $_POST['courseid']);

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
		case 'update':
		    $faculty_id= mysqli_real_escape_string($conn, $_POST['faculty_id']);
			
			$seatings= mysqli_real_escape_string($conn, $_POST['seatings']);
			$timing= mysqli_real_escape_string($conn, $_POST['timing']);
			$coursename = mysqli_real_escape_string($conn, $_POST['coursename']);
			echo $coursename;
			$description= mysqli_real_escape_string($conn, $_POST['description']);
         echo $description;
			update($conn,$courseid,$coursename,$description,$timing,$seatings,$faculty_id);
            //insert($conn,$courseid,$coursenumber,$sectionnumber,$prereq,$professor,$termid,$timings,$maxclassstrength,$deptid,$coursename,$description);
			break;
    }
}

if(mysqli_connect_errno()){
	echo "Failed";
}	
function update($conn,$courseid,$coursename,$description,$timing,$seatings,$faculty_id)
{
	
	$sql = "update course_details set c_name='$coursename',descr='$description' where c_id='$courseid'";
	$result = mysqli_query($conn,$sql);
	//echo $sql;
	$sql1 = "update course_term_assignment set lname='$faculty_id',timings='$timing',max_strength='$seatings', avail_seats='$seatings' where c_id='$courseid'";
	$result1 = mysqli_query($conn,$sql1);
	
	exit;
}

mysqli_close($conn);

?>