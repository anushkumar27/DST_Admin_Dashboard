<?php
	require  './connect.php';
	// data
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];

	$datas = $database->select("users", ["name", "role"], [
		"AND" => [
			"uname" => $uname,
			"upass" => $pass
		]
	]);
	switch ($datas[0]['role']) {
		case '1':
			$loc = "school";
			break;
		case '2':
			$loc = "govt";
			break;
		case '3':
			$loc = "admin";
			break;
		default:
			$loc = "govt";
			break;
	}
	if(sizeof($datas) == 0){
		header('Location: /DST_Admin_Dashboard');
	}else{
		session_start();
		$_SESSION["userId"] = $uname;
		$_SESSION["userName"] = $datas[0]['name'];
		header('Location:'.$loc);
	}
?>