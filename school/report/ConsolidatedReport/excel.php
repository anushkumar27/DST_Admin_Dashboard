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


if(mysqli_num_rows($result1)>0)
{
	$output .='<table colspan="8">
				<td rowspan="3"><img id="pesit-logo" src="C:/xampp/htdocs/ConsolidatedReport/img/pesit-LOGO.jpg" style="float: right"></img></td>
				<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				<td rowspan="3"><img id="pesimsr-logo" src="pesimsr.png" style="float: left"></img></td>
				</table>
		<table class="table" border= "1">
		<tr style="font-size:20px"><center><b>School Name:</b>'.$srow["name"].'&nbsp;&nbsp;&nbsp; <b>Mandal:</b>'.$mandal[substr($sch_id,0,1)-1].'&nbsp;&nbsp;&nbsp; <b>No.Of Students:</b>'.mysqli_num_rows($result1).'</center></tr>
			<th><center>Student Id</center></th>
			<th><center>Name</center></th>
			<th><center>Gender</center></th>
			<th>Age</th>
			<th><center>DoE</center></th>
			<th><center>Diagnosis</center></th>
			<th><center>Referal</center></th>
			<th><center>Treatment</center></th>
			<th><center>Next Follow Up</center></th>	
	';
	while($row=mysqli_fetch_array($result1))
	{
		$ref=array();
		$stud_id=$row["child_id"];
		$followDoe=mysqli_query($connect,"SELECT DATE_FORMAT(date(`timestamp`),'%d-%m-%Y') FROM `follow_up` WHERE child_id='".$stud_id."'");
			$followResult=mysqli_query($connect,"SELECT DATE_FORMAT(date(`next_follow_up`),'%d-%m-%Y') FROM `follow_up` WHERE `child_id`='$stud_id' and `next_follow_up` > NOW() order by `next_follow_up` asc");
			$followDate=mysqli_fetch_assoc($followResult);
			$dates=mysqli_fetch_array($followDoe);

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
				<td  style="vertical-align:center">'.$row["name"].'</td>
				<td  style="vertical-align:center"><center>'.$gender.'</center></td>	
		';

		$row=mysqli_query($connect,"SELECT EXTRACT(YEAR FROM dob) AS Y, EXTRACT(MONTH FROM dob) AS M, EXTRACT(DAY FROM dob) AS D FROM `child` WHERE `child_id`='".$stud_id."'");
		$bday=mysqli_fetch_assoc($row);
		$age=getAge($bday["D"],$bday["M"],$bday["Y"]); 
		$output .='<td><center>'.$age.'</center></td>';
		$output .='<td><center>'.$doe.'</center></td>';

		$row_string='';
		$Dname='';
		for($i=0;$i<sizeof($tableName);$i++)
		{			
			if($tableName[$i]=="health1")
			{
				$oral_result=mysqli_query($connect,"SELECT * FROM `health1` WHERE child_id='".$stud_id."'");
				$oral_row=mysqli_fetch_assoc($oral_result);
				if(sizeof($oral_row)>0)
				{
					if(sizeof(array_keys($oral_row)))
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
						$row_string .='<center> '.$organName[$i].'</center><br>';
					}
				}
				else
				{
					$Dname .='<center>'.$organName[$i].':No data</center><br>';
				}
			}
			else if($tableName[$i]=="health2")
			{
				$result2=mysqli_query($connect,"SELECT * FROM `health2` WHERE child_id='".$stud_id."'");
				$h_row=mysqli_fetch_assoc($result2);
				$health_ele=getGeneral($stud_id);
				if($health_ele['check']==1 && sizeof($health_ele['data'])!=0)
					$Dname .='<b> '.$organName[$i].'</b> :'.implode('<br><b>'.$organName[$i].'</b> :',$health_ele['data']).'<br>';
				else if($health_ele['check']==0)
				{
					$Dname .='<center>'.$organName[$i].':No data</center><br>';
				}		
				if($health_ele['referal']==1)
				{
						if($h_row['others']!="")
						{
							//echo $h_row['others'];
							$Dname .='<b>General</b> : '.$h_row['others'].'<br>';
						}
					$row_string .='<center> '.$organName[$i].'</center><br>';
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
						$row_string .='<center>'.$organName[$i].'</center><br>';
					}
				}
				else
				{
					$Dname .='<center>'.$organName[$i].':No data</center><br>';
				}
			}	
		}
		if(strlen($Dname)==0)
		{
			$Dname .='<center>Normal</center>';
		}
		$output .='<td>'.$Dname.'</td>
		<td>'.$row_string.'</td>';

		$treatRow='';
		$j=1;
		for($i=0;$i<sizeof($treatTable);$i++)
		{
			$treatRes=mysqli_query($connect,"SELECT `treatment` FROM ".$treatTable[$i]." WHERE child_id='".$stud_id."'");
			$row=mysqli_fetch_assoc($treatRes);
			if($row["treatment"]!="null" && $row["treatment"]!="")
			{
				$treatment= explode("$",$row["treatment"]);
				$treatData= explode("@",$treatment[0]);
				$treatRow .=''.$j.')'.$treatData[1].'-'.$treatData[2].'-'.$treatData[3].'<br>';
				$j++;
			}				
		}

		$output .='<td>'.$treatRow.'</td>';

		if($followDate["DATE_FORMAT(date(`next_follow_up`),'%d-%m-%Y')"]!="")
			{
				$output .='<td ><center>'.$followDate["DATE_FORMAT(date(`next_follow_up`),'%d-%m-%Y')"].'</center></td></tr>';	
			}
			else
			{
				$output .='<td><center>-----</center></td></tr>';
			}	
		
	}
	$output .='</table>';
	header("Content-Type: application/xls");
	header("Content-Disposition:attachment; filename=".$sch_id.":".$srow["name"].".xls");
	echo $output;
}

else
{
	echo "<script type='text/javascript'>alert('No data available for ".$sch_id."');</script>";	
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