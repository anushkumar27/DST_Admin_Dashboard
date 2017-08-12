<?php
include 'connect.php';
$Oname=['skin','oral','eye','ent ','general'];
$sid=$_POST['s'];

$follow_query=mysqli_query($bd,"SELECT max(`follow_cnt`) from `follow_up_data` where `child_id`='".$sid."' ");
$row=mysqli_fetch_array($follow_query);
$count=$row[0];
//echo $count;


for($i=0;$i<sizeof($Oname);$i++){
$Dname=mysqli_query($bd,"SELECT `disease_name` from follow_up_data where `o_name`='".$Oname[$i]."' and `observation`='0' and `child_id`='".$sid."' and `follow_cnt`='".$count."'");
if(mysqli_num_rows($Dname)>0){
while($row=mysqli_fetch_assoc($Dname))
	$output[]=$row['disease_name'];
	$name[$i]=$output;
	$output="";
}
else
$name[$i]="";
}

for($i=0;$i<sizeof($Oname);$i++){
//$Dname=mysqli_query($bd,"SELECT distinct `disease_name` from follow_up_data where `o_name`='".$Oname[$i]."' and `observation`!='0' and `child_id`='".$sid."'");
$Dname=mysqli_query($bd,"SELECT `disease_name` from follow_up_data where `o_name`='".$Oname[$i]."' and `observation`>0 and `child_id`='".$sid."' and `follow_cnt`='".$count."'");	
if(mysqli_num_rows($Dname)>0){
while($row=mysqli_fetch_assoc($Dname))
	$output[]=$row['disease_name'];
	$name1[$i]=$output;
	$output="";
}
else
$name1[$i]="";
}
$out=array();
array_push($out,$name);
array_push($out,$name1);
array_push($out,$count);
echo json_encode($out);
?>