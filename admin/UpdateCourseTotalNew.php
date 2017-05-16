<html lang="en">
<head>
      <title>Course Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.1/css/select.dataTables.min.css">
	
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>	
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>  
  <script src="https://cdn.datatables.net/select/1.2.1/js/dataTables.select.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 600px}

    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
     footer {
      background-color: #555;
      color: white;	  
	  position: relative;
	  right: 0;
	  bottom: 0;
	  left: 0;
	  padding: 1rem;
	  text-align: center;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;}
    }
  </style>
</head>
<body bgcolor="#c1bdba">
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h2>UT Dallas Course Registration--ADMIN</h2>
      <ul class="nav nav-pills nav-stacked">
	   <li><a href="welcomeAdmin.html">Home</a></li>
         <li><a href="AddCourses.html">Add Course</a></li>
        <li><a href="DeleteCourses.html">Delete Course</a></li>
		<li><a href="AddUserCoursesAdmin.html">Add Course for a user</a></li>
        <li><a href="DeleteUserCoursesAdmin.html">Delete User Course</a></li>
        
		<li><a href="logout.php">Logout</a></li>
      </ul><br>
    </div>

    <div class="col-sm-9" style="background-color:white">
	<br>
	<br>
	<div class='container' style='width:100%;'>
	
		<div class="field-wrap">
<?php
$c_id = $_GET['c_id'];
$conn = mysqli_connect('localhost','root', 'root','project');
//echo "hello";

// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn,"select term_id from term_code where status = 1");

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)){
		$term_id = $row["term_id"];
	}
}

	$result = mysqli_query($conn,"SELECT c.c_id as id, c.c_name as cname, c.descr as descr, t.lname as lname,t.timings as timings,t.max_strength as max FROM course_details c, course_term_assignment t WHERE c.c_id = t.c_id and c.c_id='$c_id' and t.term_id = '$term_id'");

if (mysqli_num_rows($result) > 0) {
    // output data of each row
	while ($row = mysqli_fetch_assoc($result))
	{
		
		$c_id=$row['id'];
		$c_name=$row['cname'];
		$descr=$row['descr'];
		$lname=$row['lname'];
		$timings=$row['timings'];
		$max=$row['max'];
?>
<br>
<form name="updateCourses" >
		
		<span><h2><u>Update Course</u></h2></span>
		
		<center>
		<table style='border-right:none;border-left:none;border-bottom:none;border-top:none' cellspacing="1" cellpadding="1">
				<tr>
					<td>
					Course ID<font color="red">*</font></td><td><input name="courseid" value="<?php echo $c_id; ?>"style="width: 320px;"  type="text" id="courseid"></input>
					</td>

				</tr>
				<tr>
				<td>Course Name<font color="red">*</font></td> <td><input id="coursename" value="<?php echo $c_name; ?>" style="width: 320px;" type="text"></input></td>
				</tr>
				
				
				<tr>
				<td>Description</td><td><textarea id="description" rows="10" cols="45"><?php echo $descr; ?></textarea></td>
				</tr>	
				
				
				<tr>
					<td>Instructor</td><td><input name="faculty_id" id="faculty_id" value="<?php echo $lname; ?>" style="width: 320px;" type="text" value=""</input>
				</tr>
				<tr>
					<td>Schedule</td><td><input name="timing" id="timing" type="text"  style="width: 320px;" value="<?php echo $timings; ?> "></td>
				</tr>
				<tr>
					<td>Maximum Strength</td><td><input name="seatings" id="seatings" type="text" style="width: 320px;" value="<?php echo $max; ?>"></input></td>
				</tr>
				
				<tr>
				<td align="center" colspan="2"><input id="buttons" type="button" class="button" style="width: 100px;" name="update" value="update"></td></tr>
				</div>	
	 <br><br>
    </div>
  </div>
</div></div>
</form>

<script type="text/javascript">
$(document).ready(function(){
    $(document).on("click",".button",function(){
        var clickBtnValue = $(this).val();
		
		var courseid=$("#courseid").val();
		
		
		if(courseid.length<1)
		{
			document.getElementById("result").innerHTML="Course ID is mandatory. Please enter!!";			
		}
		else{			
					var faculty_id=$("#faculty_id").val();
					var seatings=$("#seatings").val();
					var coursename=$("#coursename").val();
					var timing=$("#timing").val();
					var description=$("#description").val();
		
       data =  {'action': clickBtnValue,'courseid':courseid,'coursename':coursename,'faculty_id':faculty_id,'seatings':seatings,'timing':timing,'description':description};
	   
	   
	   //switch(clickBtnValue)
	   if(clickBtnValue=='update')
	   {
            update(data); 
	   }
	   }
    }); 
	

});

function update(data)
{
	 $.ajax(
				{
					url: "UpdateCourseTotalNewAdmin.php",
					datatype:"json",
					type:"POST",
					data:data,
					success: function(response){
						
						if(response){
						alert("Course updated successfully ");
						document.location="welcomeAdmin.html";
						} else {
						document.location="UpdateCourseTotalNew.php";
						}
				    },
					error: function(error)
					{
					alert(error);
					}
				});
}

</script>

<?php
	}
} else {
	echo "No data found";
}?>

<!--<footer class="container-fluid">
  <p>Copyrights@Utdallas</p>
</footer>-->

    </body>
</html>

<?php
mysqli_close($con);
?>