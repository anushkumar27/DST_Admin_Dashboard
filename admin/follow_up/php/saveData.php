<?php
include 'connect.php';
$conn = $bd;

$first = false;
$second = false;

$dataReceived = $_POST['s'];

$data = json_decode($dataReceived,true);

$sid = $data["child_id"];
$phone = $data["phone"];
$date = $data["treat_date"];
$count = $data["count"];

$query = "UPDATE `socio_demographic` SET `mobile`='$phone' WHERE `child_id`= '$sid'";
$result = mysqli_query($conn,$query);

$data = json_decode($data["data"],true);

foreach($data as $tableName => $entries)
{
    if(strcmp($tableName,"treatment") != 0 )
    {
        $f_date = $entries["followUpDate"];
        $dData = $entries["data"];

        $query = "INSERT into `follow_up`(`child_id`, `o_name`, `next_follow_up` , `treat_date` ,`follow_cnt`) VALUES ('".$sid."','".$tableName."','".$f_date."','".$date."','".$count."') ON DUPLICATE KEY UPDATE `next_follow_up`='".$f_date."'";    
        if($result = mysqli_query($conn,$query))
        {    
            foreach($dData as $entry)
            {
                /*
                "disease" : disease,
                "complaint" : complaint,
                "observation" : observation,
                "comment" : comment
                */
                $query = "INSERT into `follow_up_data`(`child_id`, `disease_name`, `complaint`, `observation`, `comment`, `o_name`,`follow_cnt`) VALUES ('".$sid."','".$entry['disease']."','".$entry['complaint']."','".$entry['observation']."','".$entry['comment']."','".$tableName."','".$count."') ON DUPLICATE KEY UPDATE `disease_name`='".$entry['disease']."',`complaint`='".$entry['complaint']."', `observation`='".$entry['observation']."', `comment`='".$entry['comment']."'";

                if($result = mysqli_query($conn,$query))
                {
                    $second = true;
                }
                else
                {
                    $second = false;
                    echo "0";
                    break 4;
                }
            }
        }  
    }
    else
    {
        $i=1;
        foreach($entries as $entry)
        {
            /*
            "treat_name" : treat_name,
            "frequency" :  frequency,
            "duration" : duration
            */
            $query = "INSERT into `follow_up_treat`(`child_id`, `treat_id`, `date`, `name`, `frequency`, `duration`,`follow_cnt`) VALUES ('".$sid."','".$i."','".date("Y-m-d")."','".$entry['treat_name']."','".$entry['frequency']."','".$entry['duration']."','".$count."') ON DUPLICATE KEY UPDATE `treat_id`='".$i."',`name`='".$entry['treat_name']."', `frequency`='".$entry['frequency']."', `duration`='".$entry['duration']."'";    
            
            if($result = mysqli_query($conn,$query))
            {
                $first = true;
            }
            else
            {
                $first = false;
                echo "0";
                break 4;
            }
            $i++;
        }
    }
        
}
if($second && $first)
    echo "1";
    
?>