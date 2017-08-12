<?php
	require  './connect.php';
	// data
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];
	
	$sth = mysqli_query($bd,  'SELECT `name`, `role` FROM `users` WHERE `uname`="'.$uname.'" AND `upass`="'.$pass.'"');
	
	$datas = mysqli_fetch_row($sth);

	switch ($datas[1]) {
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
		$_SESSION["userName"] = $datas[0];
		header('Location:'.$loc);
	}
?>