<?php
	require  './connect.php';
	// data
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];

	$datas = $database->select("users", "name",  [
		"AND" => [
			"uname" => $uname,
			"upass" => $pass
		]
	]);
	$loc = "admin";
	if(sizeof($datas) == 0){
		header('Location: /DST_Admin_Dashboard');
	}else{
		session_start();
		$_SESSION["user"] = $datas[0];
		header('Location:'.$loc);
	}
?>