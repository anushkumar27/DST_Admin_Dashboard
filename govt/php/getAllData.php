<?php
	include('connect.php');

	$table=["eye","ent","skin","health1","health2"];

	// compute total number of schools 
	$sth = mysqli_query($bd,  "SELECT COUNT( DISTINCT `school_id`) FROM `school`");
	$rows = array();
	while($r = mysqli_fetch_row($sth)) {
	    $rows['nSchools'] = $r[0];
	}

	// compute total number of male children
	$sth =  mysqli_query($bd, "SELECT COUNT(DISTINCT `child_id`) FROM `child` WHERE `gender`=1");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['nMale'] = $r[0];
	}

	// compute total number of female children
	$sth =  mysqli_query($bd, "SELECT COUNT(DISTINCT `child_id`) FROM `child` WHERE `gender`= 2");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['nFemale'] = $r[0];
	}

	// compute total number of reports generated
	$sth =  mysqli_query($bd, "SELECT COUNT(DISTINCT `child_id`) FROM `report_tracker`");
	while($r = mysqli_fetch_row($sth)) {
	    $rows['nReport'] = $r[0];
	}

	// compute total referal count
	$sum = 0;
	$count  = array();
	$output = array();
	for($i = 0; $i < sizeof($table); $i++) {
		if($i!=3) {
			$query = "SELECT count(distinct `child_id`) FROM ".$table[$i]." where `referal`=1;";
			$result = mysqli_query($bd,$query);
			$count[$i] = mysqli_fetch_row($result)[0];
			$sum = $sum+$count[$i];
		}
		else {
			$query="SELECT count(distinct `child_id`) FROM ".$table[$i]." where `oe_referal`=1";
			$result=mysqli_query($bd,$query);
			$count[$i]=mysqli_fetch_row($result)[0];
			$sum=$sum+$count[$i];
		}	
	}
	$rows['nReferel']=$sum;
	// for the graph
	$rows['referralDoughnut']= $count;

	// compute total referral among mandals (for the graph)
	for($i = 1; $i < 6; $i++) {
		$sum = 0;
		for($j = 0; $j < sizeof($table); $j++) {
			if($j != 3) {
				$query = "SELECT count(distinct `child_id`) FROM `".$table[$j]."` where `referal`=1 AND substr(`child_id`,1,1)=".$i." ";
				$result = mysqli_query($bd,$query);
				$count[$j] = mysqli_fetch_row($result);
				$sum = $sum+$count[$j][0];
			}
			else {
				$query = "SELECT count(distinct `child_id`) FROM ".$table[$j]." where `oe_referal`=1 AND substr(`child_id`,1,1)=".$i."";
				$result = mysqli_query($bd,$query);
				$count[$j] = mysqli_fetch_row($result);
				$sum = $sum+$count[$j][0];	
			}	
		}
	$ref_sum[$i-1]=$sum;
	}
	$rows['mandalDoughnut'] = $ref_sum;


	print json_encode($rows);
?>