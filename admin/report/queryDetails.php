<?php
	require_once('connect.php');
	
	//Sanitize the POST values
	$sid = $_POST['s'];
	//$sid = '20602021066';
	//$sid = '20102003001';
	$result=array();



	$follup=mysqli_query($bd,"SELECT DATE_FORMAT(date(`next_follow_up`),'%d-%m-%Y') FROM `follow_up` WHERE `child_id`='$sid'");
	$follow_up=array();
	/*while($row=mysqli_fetch_assoc($follup))
	{
		//print_r($row);
		array_push($follow_up,$row['DATE_FORMAT(date(`next_follow_up`),\'%d-%m-%Y\')']);
		print_r($follow_up);
	}*/
	
	$pdetails=mysqli_query($bd,"SELECT DISTINCT `name`,`father_name`, `mother_name`, `guardian_name`,`gender`, `dob` FROM `child` WHERE `child_id`='$sid'");
	$sdetails=mysqli_query($bd,"SELECT `name`,`mobile` FROM `school` WHERE `school_id`=(SELECT DISTINCT `school_id` FROM `child` WHERE `child_id`='$sid')");
	$sociodetails=mysqli_query($bd,"SELECT DISTINCT `mobile` FROM `socio_demographic` WHERE `child_id`='$sid'");
	while ($row = mysqli_fetch_assoc($sdetails)) {
		//$result1 = $row['name'] . "$" . $row['mobile'] . "$";
		array_push($result,$row['name'],$row['mobile']);
	}
	
	//Output data of each row
	while ($row = mysqli_fetch_assoc($pdetails)) {
		//$result2 = $row['name'] . "$" . $row['father_name'] . "$" . $row['mother_name'] . "$" . $row['guardian_name'].'$' . $row['gender'] . "$" . $row['dob'] . "$";
		array_push($result,$row['name'],$row['father_name'],$row['mother_name'],$row['guardian_name'],$row['gender'],$row['dob']);
	}

	while ($row = mysqli_fetch_assoc($sociodetails)) {
		//$result3 = $row['mobile'] . "$";
		array_push($result,$row['mobile']);
	}

	//echo $result1.$result2.$result3;
	$temp=implode('$',$result);
	echo $temp;
	exit();
 ?>
