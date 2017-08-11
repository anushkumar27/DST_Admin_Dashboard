<?php
	include('connect.php');
	$table=["eye","ent","skin","health1","health2"];
	$child_set = array();
	// TODO convert this to a POST request 
	$string = '{"mandals":["0"],"student":["0"],"filterMethod":["1"],"d":{"health1":[],"health2":[],"eye":[],"ent":[],"skin":["xerosis"]}}';
	
	$input = json_decode($string, true);

	if($input['mandals'][0] != 0 && $input['student'][0] != 0) {
		//echo "!= 0 != 0";
		//echo "<br>";
		$sth = mysqli_query($bd, "SELECT DISTINCT(`child_id`) FROM `follow_up_data` WHERE SUBSTR(`child_id`, 1, 1)=".$input['mandals'][0]." AND `gender`=".$input['student'][0]);
		while($r = mysqli_fetch_row($sth)) {
	    	array_push($child_set, $r[0]);
		}
	}else if($input['mandals'][0] != 0 && $input['student'][0] == 0){
		//echo "!= 0 == 0";
		//echo "<br>";
		$sth = mysqli_query($bd, "SELECT DISTINCT(`child_id`) FROM `follow_up_data` WHERE SUBSTR(`child_id`, 1, 1)=".$input['mandals'][0]);
		while($r = mysqli_fetch_row($sth)) {
	    	array_push($child_set, $r[0]);
		}
	}else if($input['mandals'][0] == 0 && $input['student'][0] != 0){
		//echo "== 0 != 0";
		//echo "<br>";
		$sth = mysqli_query($bd, "SELECT DISTINCT(`child_id`) FROM `follow_up_data` WHERE `gender`=".$input['student'][0]);
		while($r = mysqli_fetch_row($sth)) {
	    	array_push($child_set, $r[0]);
		}
	}else{
		//echo "== 0 == 0";
		//echo "<br>";
		$sth = mysqli_query($bd, "SELECT DISTINCT(`child_id`) FROM `follow_up_data`");
		while($r = mysqli_fetch_row($sth)) {
	    	array_push($child_set, $r[0]);
		}
	}

	//$res = array();
	/*for($i = 0; $i < sizeof($table); $i++){
		if($input['d'][$table[$i]]){
			$clause = " ";
			foreach ($input['d'][$table[$i]] as &$value) {
			    $clause .= $value."=1 AND ";
			}
			//$clause = substr($clause , 0, -5);
			for($j = 0; $j < sizeof($child_set); $j++){
				if($child_set[$j]){
					echo "SELECT COUNT(*) FROM ${table[$i]} WHERE " . $clause . " `child_id`=${child_set[$j]}"."<br>";
					$sth = mysqli_query($bd, "SELECT COUNT(*) FROM ${table[$i]} WHERE " . $clause . " `child_id`=${child_set[$j]}");
					while($r = mysqli_fetch_row($sth)) {
				    	if($r[0] == 0){
				    		$child_set[$j] = null;
				    	}
					}
				}
			}
		}
	}*/

	
	
	print_r($child_set);
?>