<?php
	include('connect.php');

	$rows = array();

	// compute total number of male students affected by ent 
	$sth = mysqli_query($bd,  "SELECT COUNT(DISTINCT(`child_id`)) FROM `child` WHERE `child_id` IN (SELECT DISTINCT(`child_id`) FROM `ent` WHERE `referal`=1) AND `gender`=1");
	
	while($r = mysqli_fetch_row($sth)) {
	    $rows['nMale'] = $r[0];
	}

	// compute total number of female students affected by ent 
	$sth = mysqli_query($bd,  "SELECT COUNT(DISTINCT(`child_id`)) FROM `child` WHERE `child_id` IN (SELECT DISTINCT(`child_id`) FROM `ent` WHERE `referal`=1) AND `gender`=2");
	
	while($r = mysqli_fetch_row($sth)) {
	    $rows['nFemale'] = $r[0];
	}


	// compute total number of children with Otitis Externa
	$sth =  mysqli_query($bd, "SELECT COUNT(DISTINCT `child_id`) FROM `ent` where `oe_r`=1 OR `oe_l`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['OtitisExterna'] = $r[0];
	}

	// compute total number of children ASOM
	$sth =  mysqli_query($bd, "SELECT COUNT(DISTINCT `child_id`) FROM `ent` where `as_r`=1 OR `as_l`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['ASOM'] = $r[0];
	}

	// compute total number of children CSOM
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `ent` where `cs_r`=1 OR `cs_l`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['CSOM'] = $r[0];
	}

	// compute total number of children Impacted Waxp
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `ent` where `iw_r`=1 OR `iw_l`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['ImpactedWax'] = $r[0];
	}

	// compute total number of children Impaired Hearing
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `ent` where `ih_r`=1 OR `ih_l`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['ImpairedHearing'] = $r[0];
	}

	// compute total number of children Epistaxis
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `ent` where `ep`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['Epistaxis'] = $r[0];
	}

	// compute total number of children Adenotonsilitis
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `ent` where `ad`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['Adenotonsilitis'] = $r[0];
	}

	// compute total number of children Pharyngitis
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `ent` where `ph`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['Pharyngitis'] = $r[0];
	}
	// compute total number of children Allergic Rhinitis
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `ent` where `ar`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['AllergicRhinitis'] = $r[0];
	}
	// compute total number of children Speech Defects
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `ent` where `sd`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['SpeechDefects'] = $r[0];
	}

	// compute total number of children URTI
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `ent` where `urti`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['URTI'] = $r[0];
	}
	// compute total number of children Cleft
	$sth =  mysqli_query($bd,"SELECT COUNT(DISTINCT `child_id`) FROM `ent` where `cleft`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['Cleft'] = $r[0];
	}

	print json_encode($rows);
?>