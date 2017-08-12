<?php
include 'connect.php';
$conect=$bd;
$data=array();

$autofill=mysqli_query($conect,"SELECT `name` FROM `school`");
while($row=mysqli_fetch_assoc($autofill))
{
	array_push($data,$row['name']);
}
echo json_encode($data);

?>