<?php
	//Include database connection details
	require_once('connect.php');
	session_start();
	
	//Sanitize the POST values
	$username = $_POST['username'];
	$password = $_POST['password'];
	$schID = $_POST['schID'];
	
	//Create query
	$qry="SELECT * FROM `users` WHERE `uname`='$username' AND `upass`='$password'";
	$query1="SELECT `name` FROM `school` WHERE `school_id`='$schID'";
	
	$result=mysqli_query($bd,$qry);
	$result1=mysqli_query($bd,$query1);
	
	//Check whether the query was successful or not
	if($result && $result1) {
		if(mysqli_num_rows($result) > 0 && mysqli_num_rows($result1) > 0) {
			//Login Successful
			$_SESSION['username'] = $username;
			$_SESSION['schID'] = $schID;
			header("location: export.php");
			exit();
		}else {
			//Login failed
				echo "<script type='text/javascript'>alert('lol');</script>";
				header("location: index.php");
				exit();
		}
	}
	else {
		die("Query failed");
	}
?>
