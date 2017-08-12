<?php
include 'connect.php';
include 'general.php';
$connect = $bd;
session_start();

$sch_id=$_SESSION['schID'];

$output='';
$stud_id;
$sdetails=mysqli_query($connect,"SELECT `name` FROM `school` WHERE school_id='$sch_id'");
$srow=mysqli_fetch_array($sdetails);
$result1=mysqli_query($connect,"SELECT DISTINCT `child_id`,`name`,`gender` FROM `child` WHERE school_id='$sch_id'");
$tableName=array("skin","ent","health1","health2","eye");
$treatTable=array("skin","ent","health2","eye");
$organName=array("Skin","Ent","Oral","General","Eye");
$mandal=array("kuppam","Gudipalli","Shanthipuram","Ramakuppam","Vkota");
$OraganName=array("Skin","ENT","Oral","General","Eye");
$follow_count=0;
$no_entry=0;
$noData=array();
$refReq=array();


if(mysqli_num_rows($result1)>0) 
{
	$output .='<table class="table table-bordered" id="head_school">
	<div id="head"><center><b>School Name:</b>'.$srow["name"].'&nbsp;&nbsp;&nbsp; <b>Mandal:</b>'.$mandal[substr($sch_id,0,1)-1].'&nbsp;&nbsp;&nbsp; <b>No.Of Students:</b>'.mysqli_num_rows($result1).'</center></div>
		<tr>
			<th><center>Student Id</center></th>
			<th><center>Name</center></th>
			<th><center>Gender</center></th>
			<th>Age</th>
			<th><center>DoE</center></th>
			<th><center>Diagnosis</center></th>
			<th><center>Referal</center></th>
			<th><center>Treatment</center></th>
			<th><center>Next Follow Up</center></th>			
		</tr>	
	';
		while($row=mysqli_fetch_array($result1))
		{
			$noEntry=array();
			$noStudEntry=array();
			$followReq=array();
			$ref=array();
			$camp;
			$stud_id=$row["child_id"];
			$followDoe=mysqli_query($connect,"SELECT DATE_FORMAT(date(`timestamp`),'%d-%m-%Y') FROM `follow_up` WHERE child_id='".$stud_id."'");
			$dates=mysqli_fetch_array($followDoe);
			$followResult=mysqli_query($connect,"SELECT DATE_FORMAT(date(`next_follow_up`),'%d-%m-%Y') FROM `follow_up` WHERE `child_id`='$stud_id' and `next_follow_up` > NOW() order by `next_follow_up` asc");
			$followDate=mysqli_fetch_assoc($followResult);

			for($i=0;$i<sizeof($tableName);$i++)
			{
				$doeRes=mysqli_query($connect,"SELECT DATE_FORMAT(date(`timestamp`),'%d-%m-%Y') FROM ".$tableName[$i]." WHERE child_id='".$stud_id."'");
				$doeResRow=mysqli_fetch_array($doeRes);
				if($doeResRow["DATE_FORMAT(date(`timestamp`),'%d-%m-%Y')"]!="")
				{
					$camp=$doeResRow["DATE_FORMAT(date(`timestamp`),'%d-%m-%Y')"];
				}
				
			}

			$doe=getDoe($dates["DATE_FORMAT(date(`timestamp`),'%d-%m-%Y')"],$camp);
			$gender=getGender($row["gender"]);
			
			$output .='<tr>
					<td  style="vertical-align:center"><center>'.$row["child_id"].'</center></td>
					<td  style="vertical-align:center">'.$row['name'].'</td>
					<td  style="vertical-align:center"><center>'.$gender.'</center></td>	
			';

			$row=mysqli_query($connect,"SELECT EXTRACT(YEAR FROM dob) AS Y, EXTRACT(MONTH FROM dob) AS M, EXTRACT(DAY FROM dob) AS D FROM `child` WHERE `child_id`='".$stud_id."'");
			$bday=mysqli_fetch_assoc($row);
			$age=getAge($bday["D"],$bday["M"],$bday["Y"]); 
			$output .='<td><center>'.$age.'</center></td>';
			$output .='<td>'.$doe.'</td>';

			$ref_string='';
			$Dname='';
			for($i=0;$i<sizeof($tableName);$i++)
			{			
				if($tableName[$i]=="health1")
				{
					$oral_result=mysqli_query($connect,"SELECT * FROM `health1` WHERE child_id='".$stud_id."'");
					$oral_row=mysqli_fetch_assoc($oral_result);
					if(sizeof($oral_row)>0)
					{
						if(array_key_exists("oe_dc",$oral_row))
						{
							foreach ($oral_row as $key => $value) {
								if($value==1 && checkColumnName($key) && strcmp($key,"oe_referal") && strpos($key, 'oe') !== false)
								{
									$columnName=getColumnName($key,$OraganName[$i]);
									$Dname .='<b>'.$organName[$i].'</b> : '.$columnName["m_name"].'<br>';
								}
							}
						}
						
						if($oral_row["oe_referal"]==1)
						{	
							if($oral_row["oe_others"]!="")
							{
								$Dname .='<b>'.$organName[$i].'</b> : '.$oral_row["oe_others"].'<br>';
							}
							$ref_string .='<center> '.$organName[$i].'</center><br>';
							array_push($followReq,$organName[$i]);
						}
							
					}
					else
					{
						array_push($noEntry,$OraganName[$i]);
						$Dname .='<center>'.$organName[$i].':No data</center><br>';
						$no_entry++;
					}
				}
				else if($tableName[$i]=="health2")
				{
					$result2=mysqli_query($connect,"SELECT * FROM `health2` WHERE child_id='".$stud_id."'");
					$h_row=mysqli_fetch_assoc($result2);

					$health_ele=getGeneral($stud_id);
					if($health_ele['check']==1 && sizeof($health_ele['data'])!=0)
					{
						$Dname .='<b> '.$organName[$i].'</b> :'.implode('<br><b>'.$organName[$i].'</b> :',$health_ele['data']).'<br>';
					}
					else if($health_ele['check']==0)
					{
						array_push($noEntry,$OraganName[$i]);
						$Dname .='<center>'.$organName[$i].':No data</center><br>';
						$no_entry++;
					}	

					if($health_ele['referal']==1)
					{	
		
						if($h_row['others']!="")
						{
							
							$Dname .='<b>General</b> : '.$h_row['others'].'<br>';
						}
						$ref_string .='<center> '.$organName[$i].'</center><br>';
						array_push($followReq,$organName[$i]);
					}
				}	
				else 
				{
					$result2=mysqli_query($connect,"SELECT * FROM ".$tableName[$i]." WHERE child_id='".$stud_id."'");
					$n_row=mysqli_fetch_assoc($result2);
					if(sizeof($n_row)>0)
					{
						if($tableName[$i]=="eye")
						{
							foreach ($n_row as $key => $value) {						
								if($value==1 && checkColumnName($key) && strcmp($key,"fe_r") && strcmp($key,"fe_l") && strcmp($key,"cv_r") && strcmp($key,"cv_l"))
								{
									$columnName=getColumnName($key,$OraganName[$i]);
									$Dname .='<b>'.$organName[$i].'</b> : '.$columnName["m_name"].'<br>';
								}
							}
						}
						else
						{
							foreach ($n_row as $key => $value) {						
								if($value==1 && checkColumnName($key))
								{
									$columnName=getColumnName($key,$OraganName[$i]);
									$Dname .='<b>'.$organName[$i].'</b> : '.$columnName["m_name"].'<br>';
								}
							}
						}

						if($n_row["referal"]==1)
						{				
							if($n_row['others']!="")
							{
								$Dname .='<b>'.$organName[$i].'</b> : '.$n_row['others'].'<br>';
							}
							$ref_string .='<center>'.$organName[$i].'</center><br>';
							array_push($followReq,$organName[$i]);
						}
					}
					else
					{
						array_push($noEntry,$OraganName[$i]);
						$Dname .='<center>'.$organName[$i].':No data</center><br>';
						$no_entry++;
					}
				}	
			}
			if(strlen($Dname)==0)
			{
				$Dname .='<center>Normal</center>';
			}
			if(sizeof($noEntry)!=0)
			{
				$noStudEntry['id']=$stud_id;
				$noStudEntry[$stud_id]=$noEntry;
				array_push($noData,$noStudEntry);
			}
			if(sizeof($followReq)!=0)
			{
				$ref[$stud_id]=$followReq;
				array_push($refReq,$ref);
			}

			$output .='<td>'.$Dname.'</td>
			<td>'.$ref_string.'</td>';

			$treatRow='';
			$j=1;
			$degree=array();
			for($i=0;$i<sizeof($treatTable);$i++)
			{
				$treatRes=mysqli_query($connect,"SELECT `treatment` FROM ".$treatTable[$i]." WHERE child_id='".$stud_id."'");
				$row=mysqli_fetch_assoc($treatRes);
				if($row["treatment"]!="null" && $row["treatment"]!="")
				{
					$treatment= explode("$",$row["treatment"]);
					$treatData= explode("@",$treatment[0]);
					$a= strlen($treatData[2]);
					if(htmlspecialchars($treatData[2][$a-1])=="")
					{
						$treatData[2][$a-1]="";
					}
						$treatRow .=''.$j.')'.$treatData[1].'-'.$treatData[2].'-'.$treatData[3].'<br>';
					$j++;
				}				
			}

			$output .='<td>'.$treatRow.'</td>';

			if($followDate["DATE_FORMAT(date(`next_follow_up`),'%d-%m-%Y')"]!="")
			{
				$output .='<td >'.$followDate["DATE_FORMAT(date(`next_follow_up`),'%d-%m-%Y')"].'</td></tr>';	
			}
			else
			{
				$output .='<td >-----</td></tr>';
			}
			
			
		}
	$output .='</table>';
	$returnVal=array();
	$returnVal['table']=$output;
	$returnVal['no']=$no_entry;
	$returnVal['NoData']=$noData;
	$returnVal['follow']=$refReq;
	$output=json_encode($returnVal);
	print_r( $output);
}


else
{
	echo "1";	
}

function getAge($D,$M,$Y)
{
	$todayY = date("Y");
	$todayM = date("m");
	$todayD = date("d");
	$age = $todayY-$Y;
	$mDiff = $todayM-$M;
	if($mDiff<0 || ($mDiff==0 && ($todayD<$D)))
	{
		$age--;
	}
	return $age;
}

function getGender($G)
{
	if($G==1)
	{
		$gender="M";
	}
	else
	{
		$gender="F";
	}
	return $gender;
}

function getDoe($follDate,$campDate)
{
	if($follDate=="")
	{
		$doe=$campDate;
	}
	else
	{
		$doe=$follDate.":(followUp)";
	}
	return $doe;
}
?>