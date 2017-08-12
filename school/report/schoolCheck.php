<?php
require_once('connect.php');
session_start();
$schID=$_POST['schID'];
$schNm=$_POST['schNm'];
$tableName=array("skin","ent","health1","health2","eye");

if($schID!='')
{
	$qry1="SELECT * FROM school WHERE school_id='$schID'";
	$result1=mysqli_query($bd,$qry1);

	if($result1)
	{
		if(mysqli_num_rows($result1)>0)
		{
			$row=mysqli_fetch_assoc($result1);
			$_SESSION['schID']=$schID;
			$_SESSION['schNm']=$row['name'];
			header("location: ConsolidatedReport/export.php");
			exit();
		}
		else
		{
			header("location: select.php");
			exit();
		}
	}
	else
	{
		die("Query failed");
	}

}
else
{
	$qry1="SELECT * FROM `school` WHERE `name`='$schNm'";
	$result1=mysqli_query($bd,$qry1);
	
	if($result1)
	{
		if(mysqli_num_rows($result1)>0)
		{
			$row=mysqli_fetch_assoc($result1);
			$_SESSION['schID']=$row['school_id'];
			$_SESSION['schNm']=$schNm;
			header("location: ConsolidatedReport/export.php");
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
}


?>