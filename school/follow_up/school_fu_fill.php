<?php
include '../connect.php';

$schID=$_REQUEST['s'];

$stud_details=array();
$stud_id=array();
$stud_name=array();
$referal=array();
$true_array=array();
$table=array("eye","ent","health1","health2","skin");
$table_name=array("Eye","Ent","Oral","General","Skin");
$j=0;

$total_ids_query=mysqli_query($bd,"SELECT distinct `child_id`,`name` from `child` where substr(`child_id`,1,8)=".$schID."");
while($row=mysqli_fetch_row($total_ids_query))
{
	//$row[0]=20102003014;
	//print_r($row[0]);
	//echo "<br>";
	$k=0;
	for($i=0;$i<5;$i++)
	{	
		$referal_query=mysqli_query($bd,"SELECT * from `".$table[$i]."` where `child_id`=".$row[0]." order by `timestamp` desc");
		$referal_res=mysqli_fetch_assoc($referal_query);
		//print_r($referal_res);
		if($i!=2){
			//echo "Refereal Boleean=".$referal_res['referal'];
			if($referal_res['referal'])
			{
				$true_array[$i]=1;
				$referal[$k]=$table_name[$i];
				$k++;
			}
			else{
				$true_array[$i]=0;
			}
		}
		else
			if($referal_res['oe_referal']==1)	
			{
				$true_array[$i]=1;
				$referal[$k]=$table_name[$i];
				$k++;
			}
			else{
				$true_array[$i]=0;
			}
	}
	//print_r(array_sum($true_array));
		//echo "<br>";
	if(array_sum($true_array)>0)
	{
		$follow_up_query=mysqli_query($bd,"SELECT `follow_cnt`,`timestamp`,`next_follow_up` from `follow_up` where `child_id`=".$row[0]." order by `timestamp` desc");
		$follow_up_row=mysqli_fetch_row($follow_up_query);
		$individual_details=array();
		array_push($individual_details,$row[0],$row[1],$referal,$follow_up_row[2]);		
		$stud_details[$j]=$individual_details;
		unset($referal);
		unset($true_array);
		$j++;
	}
	else
	{
		$stud_details[$j]=0;
		unset($referal);
	}
	//print_r($stud_details);
	//echo "<br>";
	//break;
}
print_r(json_encode($stud_details));

?>