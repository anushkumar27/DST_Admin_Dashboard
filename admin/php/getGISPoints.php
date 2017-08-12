<?php
	include('connect.php');

	$data = array();

	$table=["eye","ent","skin","health1","health2"];

	
	 //$string = '{"mandals":["0"],"student":["0"],"filterMethod":["1"],"d":{"health1":[],"health2":[],"eye":[],"ent":["iw_r#iw_l"],"skin":[]}}';
	
	$string = $_POST['ip'];
	if(!$string){
		echo "End Of Script";
		exit();
	}
	$input = json_decode($string, true);

	if($input['mandals'][0] != 0 && $input['student'][0] != 0) {
		//echo "!= 0 != 0";
		//echo "<br>";
		$mandalAndGender ="(SELECT DISTINCT(`child_id`) FROM `child` WHERE SUBSTR(`child_id`, 1, 1)=".$input['mandals'][0]." AND `gender`=".$input['student'][0].")";

	}else if($input['mandals'][0] != 0 && $input['student'][0] == 0){
		//echo "!= 0 == 0";
		//echo "<br>";
		$mandalAndGender ="(SELECT DISTINCT(`child_id`) FROM `child` WHERE SUBSTR(`child_id`, 1, 1)=".$input['mandals'][0].")";
	}else if($input['mandals'][0] == 0 && $input['student'][0] != 0){
		//echo "== 0 != 0";
		//echo "<br>";
		$mandalAndGender = "(SELECT DISTINCT(`child_id`) FROM `child` WHERE `gender`=".$input['student'][0].")";
	}else{
		//echo "== 0 == 0";
		//echo "<br>";
		$mandalAndGender = "(SELECT DISTINCT(`child_id`) FROM `child`)";
	}

	$tableQuery = "";
	$temp1="";
	$tableWhereQuery =  array(); 
	foreach ($table as $key => $tableName) {
		// check if cols exist in the table
		if($input['d'][$tableName]){

			//array_push ($tableQuery, "(SELECT DISTINCT(`child_id`) FROM `".$tableName."`  WHERE `child_id` IN ");
			$tableQuery .=  "(SELECT DISTINCT(`child_id`) FROM `".$tableName."`  WHERE `child_id` IN ";
		 	foreach ($input['d'][$tableName] as $key => $disease) {
				// check for left and right attr
				if(sizeof(explode("#",$disease)) > 1){
					// the OR condition
					$temp = explode("#",$disease);
					$temp1 .= " AND (".$temp[0]."=1 OR ".$temp[1]. "=1)";
				}else{
					// the normal AND condition
					$temp1 .= " AND ".$disease."=1";
				}
			}
				$temp1.=")";
				array_push($tableWhereQuery, $temp1);
				$temp1="";

		}
	}

		$res = $tableQuery.$mandalAndGender;
		for($i = sizeof($tableWhereQuery)-1; $i >= 0; $i--){
			$res .=  $tableWhereQuery[$i];
		}

	$res = "SELECT `lat`, `lon` FROM `loc` WHERE `child_id` IN ".$res;
	//echo $res;
	$points = array();
	$sql = mysqli_query($bd,$res);
	while($r = mysqli_fetch_row($sql)){
		$LatLon = array(
			"lat" => $r[0],
			"lon" => $r[1]
		);
		array_push($points, $LatLon);
	}
	array_push($data, $points);

	// loop for the followup
	for($k = 1; $k < 4; $k++){
		$tableQuery = "";
		$temp1 = "";
		$tableWhereQuery =  array();
		$res = "";
		foreach ($table as $key => $tableName) {
			// check if cols exist in the table
			if($input['d'][$tableName]){
				$tableQuery .=  "(SELECT DISTINCT(`child_id`) FROM `follow_up_data`  WHERE `child_id` IN ";
			 	foreach ($input['d'][$tableName] as $key => $disease) {
					// check for left and right attr
					if(sizeof(explode("#",$disease)) > 1){
						// the OR condition
						$temp = explode("#",$disease);
						//echo 'SELECT `m_name` FROM `report` WHERE `c_name`="'.$temp[0].'"';
						//echo '<br>';
						$sql1 = mysqli_query($bd,'SELECT `m_name` FROM `report` WHERE `c_name`="'.$temp[0].'"');
						$r1 = mysqli_fetch_row($sql1)[0];
						$sql1 = mysqli_query($bd,'SELECT `m_name` FROM `report` WHERE `c_name`="'.$temp[1].'"');
						$r2 = mysqli_fetch_row($sql1)[0];
						$temp1 .= ' AND ( INSTR(disease_name, "'.$r1.'") OR INSTR(disease_name, "'.$r2.'"))';
					}else{
						// the normal AND condition
						$sql1 = mysqli_query($bd,'SELECT `m_name` FROM `report` WHERE `c_name`="'.$disease.'"');
						$r1 = mysqli_fetch_row($sql1)[0];
						$temp1 .= ' AND INSTR(disease_name, "'.$r1.'")';
					}
				}
					$temp1.=" AND `observation`>0 AND `follow_cnt`=".$k." )";
					array_push($tableWhereQuery, $temp1);
					$temp1="";

			}
		}
		$res = $tableQuery.$mandalAndGender;
		for($i = sizeof($tableWhereQuery)-1; $i >= 0; $i--){
			$res .=  $tableWhereQuery[$i];
		}
		//echo '<br>';
		$res = "SELECT `lat`, `lon` FROM `loc` WHERE `child_id` IN ".$res;
		//echo $res;
		//echo '<br>';
		$points = array();
		$sql = mysqli_query($bd,$res);
		while($r = mysqli_fetch_row($sql)){
			$LatLon = array(
				"lat" => $r[0],
				"lon" => $r[1]
			);
			array_push($points, $LatLon);
		}
		array_push($data, $points);
	}

	echo json_encode($data);
		
?>