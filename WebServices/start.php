<?php

include("connection.php");

$logid= $_REQUEST["logid"];

$lng= $_REQUEST["lng"];

$lat= $_REQUEST["lat"];

$time= date('Y/m/d h:i:s',strtotime($_REQUEST["time"]));

$sql = "update pulseemergency set startlocation='$lat,$lng', starttime='$time' where logid='$logid'";



if (!mysqli_query($con,$sql)) {

  die('Error: ' . mysqli_error($con));

}



mysqli_close($con);

?>	