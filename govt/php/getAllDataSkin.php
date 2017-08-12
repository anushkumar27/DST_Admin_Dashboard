<?php
	include('connect.php');

	$rows = array();

	$sqlMale = "SELECT COUNT(DISTINCT(`child_id`)) FROM `child` WHERE `child_id` IN (SELECT DISTINCT(`child_id`) FROM `skin` WHERE `referal`=1) AND `gender`=1 ";

	$sqlFemale = "SELECT COUNT(DISTINCT(`child_id`)) FROM `child` WHERE `child_id` IN (SELECT DISTINCT(`child_id`) FROM `skin` WHERE `referal`=1) AND `gender`=2 ";

	$sc = "SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `sc`=1";

	$pi =  "SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `pi`=1";

	$ph =  "SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `ph`=1";

	$pe =  "SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `pe`=1";

	$pity =  "SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `pity`=1";

	$im =  "SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `im`=1";

	$pap =  "SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `pap`=1";

	$tc =  "SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `tc`=1";

	$mi =  "SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `mi`=1";

	$vi =  "SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `vi`=1";

	$xerosis =  "SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `xerosis`=1";

	
	// compute total number of male students affected by skin 
	$sth = mysqli_query($bd,  "SELECT COUNT(DISTINCT(`child_id`)) FROM `child` WHERE `child_id` IN (SELECT DISTINCT(`child_id`) FROM `skin` WHERE `referal`=1) AND `gender`=1");
	
	while($r = mysqli_fetch_row($sth)) {
	    $rows['nMale'] = $r[0];
	}

	// compute total number of female students affected by skin 
	$sth = mysqli_query($bd,  "SELECT COUNT(DISTINCT(`child_id`)) FROM `child` WHERE `child_id` IN (SELECT DISTINCT(`child_id`) FROM `skin` WHERE `referal`=1) AND `gender`=2");
	
	while($r = mysqli_fetch_row($sth)) {
	    $rows['nFemale'] = $r[0];
	}


	// compute total number of children with scabies
	$sth =  mysqli_query($bd, "SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `sc`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['Scabies'] = $r[0];
	}

	// compute total number of children PityriasisAlba
	$sth =  mysqli_query($bd, "SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `pi`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['PityriasisAlba'] = $r[0];
	}

	// compute total number of children Phrynoderma
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `ph`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['Phrynoderma'] = $r[0];
	}

	// compute total number of children Pediculosis
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `pe`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['Pediculosis'] = $r[0];
	}

	// compute total number of children Impetigo
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `im`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['Impetigo'] = $r[0];
	}

	// compute total number of children Papularurticaria
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `pap`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['Papularurticaria'] = $r[0];
	}

	// compute total number of children TineaCrusis
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `tc`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['TineaCrusis'] = $r[0];
	}

	// compute total number of children Miliaria
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `mi`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['Miliaria'] = $r[0];
	}
	// compute total number of children ViralWarts
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `vi`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['ViralWarts'] = $r[0];
	}
	// compute total number of children Xerosis
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `skin` WHERE `xerosis`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['Xerosis'] = $r[0];
	}

	print json_encode($rows);
?>