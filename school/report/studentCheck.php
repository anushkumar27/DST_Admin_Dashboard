<?php
require_once('connect.php');
session_start();
$sid=$_POST['sid'];

$qry1="SELECT * FROM child WHERE child_id='$sid'";
$result1=mysqli_query($bd,$qry1);

if($result1)
{
	if(mysqli_num_rows($result1)>0)
	{
		$_SESSION['sid']=$sid;
		header("location: dashboard.php");
		exit();
	}
	else
	{
		header("location: index.php");
		exit();
	}
}
else
{
	die("Query failed");
}
?>
