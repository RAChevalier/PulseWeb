<?php

include("connection.php");

$logid= $_REQUEST["logid"];

$lng= $_REQUEST["lng"];

$lat= $_REQUEST["lat"];



$sql = "update pulseemergency set endlocation='$lat,$lng' where logid='$logid'";



if (!mysqli_query($con,$sql)) {

  die('Error: ' . mysqli_error($con));

}



mysqli_close($con);

?>	