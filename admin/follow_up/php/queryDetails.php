<?php
	require_once('connect.php');
	
	//Sanitize the POST values
	$sid = $_POST['s'];
	$i=1;
	$result=array();
	//$sid = '20602021066';
	//$sid = '20102003001';
	$data=array();
	$data['sch_name']="";
	$data['sch_mob']="";
	$data['name']="";
	$data['father_name']="";
	$data['mother_name']="";
	$data['guard_name']="";
	$data['gender']="";
	$data['dob']="";
	$data['mobile']="";
	$data['height']="";
	$data['weight']="";
	$data['doe']="";
	$data['follow']="";
	
	$pdetails=mysqli_query($bd,"SELECT DISTINCT `name`,`father_name`, `mother_name`, `guardian_name`,`gender`, `dob` FROM `child` WHERE `child_id`='$sid'");
	$sdetails=mysqli_query($bd,"SELECT distinct`name`,`mobile` FROM `school` WHERE `school_id`=(SELECT DISTINCT `school_id` FROM `child` WHERE `child_id`='$sid')");
	$sociodetails=mysqli_query($bd,"SELECT distinct `mobile` FROM `socio_demographic` WHERE `child_id`='$sid'");
	$hdetails=mysqli_query($bd,"SELECT distinct `height`,`weight`, DATE_FORMAT(date(`timestamp`),'%d-%m-%Y') FROM `health1` WHERE `child_id`='$sid'");
	$followUp=mysqli_query($bd,"SELECT distinct `follow_cnt` from `follow_up` where `child_id`='$sid' order by `timestamp` desc");
	
	while ($row = mysqli_fetch_assoc($sdetails)) {
		//$result1 = $row['name'] . "$" . $row['mobile'] . "$";
		//array_push($result,$row['name'],$row['mobile']);
		$data['sch_name']=$row['name'];
		$data['sch_mob']=$row['mobile'];
	}
	
	//Output data of each row
	while ($row = mysqli_fetch_assoc($pdetails)) {
		//$result2 = $row['name'] . "$" . $row['father_name'] . "$" . $row['mother_name'] . "$" . $row['guardian_name'].'$' . $row['gender'] . "$" . $row['dob'] . "$";
		//array_push($result,$row['name'],$row['father_name'],$row['mother_name'],$row['guardian_name'],$row['gender'],$row['dob']);
		$data['name']=$row['name'];
		$data['father_name']=$row['father_name'];
		$data['mother_name']=$row['mother_name'];
		$data['guard_name']=$row['guardian_name'];
		$data['gender']=$row['gender'];
		$data['dob']=$row['dob'];
	}

	while ($row = mysqli_fetch_assoc($sociodetails)) {
		//$result3 = $row['mobile'] . "$";
		/*if(mysqli_num_rows($sociodetails)<0)
		{
			array_push($result,"0");
		}
		else
		array_push($result,$row['mobile']);*/
		$data['mobile']=$row['mobile'];
	}
	while ($row = mysqli_fetch_assoc($hdetails)) {
		//$result4 = $row['height'] . "$" . $row['weight'] . "$" . $row['DATE_FORMAT(date(`timestamp`),\'%d-%m-%Y\')'] . "$";
		//array_push($result,$row['height'],$row['weight'],$row['DATE_FORMAT(date(`timestamp`),\'%d-%m-%Y\')']);
		$data['height']=$row['height'];
		$data['weight']=$row['weight'];
		$data['doe']=$row['DATE_FORMAT(date(`timestamp`),\'%d-%m-%Y\')'];
	}
	if(mysqli_num_rows($followUp)<0){
		//$result5=$i."$";
		//array_push($result,$i);
		$data['follow']=$i;
	}
	else{
		$row=mysqli_fetch_assoc($followUp);
		$i=$row['follow_cnt']+1;
		//array_push($result,$i);
		$data['follow']=$i;
	}

	//$temp=implode('$',$result);
	//echo $result1.$result2.$result3.$result4.$result5;
	echo implode('$', $data);
	exit();
 ?>
