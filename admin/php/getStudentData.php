<?php
	include('connect.php');
	
	$info = array();
	$mandals = ["Kuppam","Gudupalli","Shanthipuram","Ramakuppam","Vkota"];
	$panch = ["kup_panch","gud_panch","sha_panch","ram_panch","vk_panch"];

	$std_id = $_POST["s"];
	//$std_id = 20102003001;
	$mandal_id = substr($std_id,0,1);
	$m_id = $mandal_id-1;
	$mandal_name = $mandals[$m_id];

	$panch_id=substr($std_id,1,2);

	$vill_id=substr($std_id,3,2);

	$query1 = "SELECT `name` from school where `school_id`=substr($std_id,1,8)";
	$query2 = "SELECT `name` from child where `child_id`=$std_id";
	$result2 = mysqli_query($bd,$query1);
	$result1 = mysqli_query($bd,$query2);
	$stud = mysqli_fetch_row($result2);
	$school = mysqli_fetch_row($result1);

	$query3="SELECT `panch_name`,`vill_name` from ".$panch[$m_id]." where `panch_id`=".$panch_id." and `vill_id`=".$vill_id."";
	$result3=mysqli_query($bd,$query3);
	$row=mysqli_fetch_assoc($result3);
	$p_name=$row["panch_name"];
	$v_name=$row["vill_name"];

	$info["mandal"]=$mandal_name;
	$info["panch"]=$p_name;
	$info["vill"]=$v_name;
	$info["sch"]=$school;
	$info["stud"]=$stud;
	$info=json_encode($info);
	print_r($info);
?>