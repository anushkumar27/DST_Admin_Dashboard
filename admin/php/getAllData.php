<?php
	include('connect.php');
	$sth = mysqli_query($bd, "SELECT DISTINCT COUNT(*) FROM `school`");
	$rows = array();
	while($r = mysqli_fetch_assoc($sth)) {
	    $rows[] = $r;
	}

	$sth =  mysqli_query($bd, "SELECT DISTINCT COUNT(*) FROM `child` WHERE gender=1");
	while($r = mysqli_fetch_assoc($sth)) {
	    $rows[] = $r;
	}
	$sth =  mysqli_query($bd, "SELECT DISTINCT COUNT(*) FROM `child` WHERE gender=2");
	while($r = mysqli_fetch_assoc($sth)) {
	    $rows[] = $r;
	}
	print json_encode($rows);
?>