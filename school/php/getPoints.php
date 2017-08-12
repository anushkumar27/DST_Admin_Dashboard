<?php
include('connect.php');

$i = 0;
$geoPoints = array();

$query = "SELECT * FROM `special_loc`";
$result = mysqli_query($bd, $query);
while($row = mysqli_fetch_assoc($result)) {
	$temp = array();
	array_push($temp, $row["type"]);
	array_push($temp, $row["name"]);
	array_push($temp, $row["lat"]);
	array_push($temp, $row["lon"]);
	array_push($geoPoints, $temp);
}

echo json_encode($geoPoints);
?>