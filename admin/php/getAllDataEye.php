<?php
	include('connect.php');

	$rows = array();

	// compute total number of male students affected by ent 
	$sth = mysqli_query($bd,  "SELECT COUNT(DISTINCT(`child_id`)) FROM `child` WHERE `child_id` IN (SELECT DISTINCT(`child_id`) FROM `eye` WHERE `referal`=1) AND `gender`=1");
	
	while($r = mysqli_fetch_row($sth)) {
	    $rows['nMale'] = $r[0];
	}

	// compute total number of female students affected by ent 
	$sth = mysqli_query($bd,  "SELECT COUNT(DISTINCT(`child_id`)) FROM `child` WHERE `child_id` IN (SELECT DISTINCT(`child_id`) FROM `eye` WHERE `referal`=1) AND `gender`=2");
	
	while($r = mysqli_fetch_row($sth)) {
	    $rows['nFemale'] = $r[0];
	}


	// compute total number of children with Colour Vision
	$sth =  mysqli_query($bd, "SELECT COUNT(DISTINCT `child_id`) FROM `eye` where `cv_r`=1 OR `cv_l`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['ColourVision'] = $r[0];
	}

	// compute total number of children Bitot's spots
	$sth =  mysqli_query($bd, "SELECT COUNT(DISTINCT `child_id`) FROM `eye` where `bs_r`=1 OR `bs_l`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['BitotSpots'] = $r[0];
	}

	// compute total number of children AllergicConjunctivitis
	$sth =  mysqli_query($bd, "SELECT COUNT(DISTINCT `child_id`) FROM `eye` where `ac_r`=1 OR `ac_l`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['AllergicConjunctivitis'] = $r[0];
	}

	// compute total number of children Night Blindness
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `eye` where `nb`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['NightBlindness'] = $r[0];
	}

	// compute total number of children Congenital ptosis
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `eye` where `cp_r`=1 OR `cp_l`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['CongenitalPtosis'] = $r[0];
	}

	// compute total number of children CongenitalDevelopmentalCararact
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `eye` where `cdc_r`=1 OR `cdc_l`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['CongenitalDevelopmentalCararact'] = $r[0];
	}

	// compute total number of children Amblyopia
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `eye` where `am_r`=1 OR `am_l`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['Amblyopia'] = $r[0];
	}

	// compute total number of children Nystagmus
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `eye` where `ny_r`=1 OR `ny_l`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['Nystagmus'] = $r[0];
	}

	// compute total number of children Fundus examination
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `eye` where `fe_r`=1 OR `fe_l`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['FundusExamination'] = $r[0];
	}
	print json_encode($rows);
?>