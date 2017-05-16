<?php
session_start();
	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "root";

	if(empty($_POST["username"]) || empty($_POST["password"])){
		header('Location: index.html');
	}
	
	$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');
	
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	//echo "Connected successfully";
	$username = $_POST["username"];
	$pass_word = $_POST["password"];
	$pass_word1=trim($pass_word);
	
	$sql = "SELECT * FROM user_login WHERE net_id='$username'";
	echo $sql;
	$result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
			echo "password: " . $row["password"]. " - net_id: " . $row["net_id"] . "<br>";
			echo $row['salt_value'];
			
			$hash = hash('sha256', $row['salt_value'] . hash('sha256', $pass_word1)) ;
			$hash1=substr($hash, 0, -14);
				
				if($hash1 != $row['password']) // Incorrect password. So, redirect to login_form again.
                {
				  header('Location: index.html');
       		    } 	
			else 
			{
				//echo " matched";
				
				$sql1 = "select * from users where users.net_id='".$username."'";
	          
	             $result1 = mysqli_query($conn, $sql1);
				 $row1= mysqli_fetch_array($result1,MYSQLI_ASSOC);
				 
				 if($row1['u_role']=='administrator') {
					  echo "admin page";
					  header('Location: admin/welcomeAdmin.html'); //redirects to Admin HomePage
				 } else {
				    echo "student";
					session_regenerate_id();
					$_SESSION['sess_username'] = $username;
					$_SESSION['sess_name'] = $name;
					session_write_close();
					header('Location: user/welcome.html'); //redirects to Student HomePage
                  }
			}
	} else {
		//echo "not retrieved";
		header('Location: index.html');
	}
	
	session_write_close();

?>
