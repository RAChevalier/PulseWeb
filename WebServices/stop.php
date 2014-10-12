<?php

include("connection.php");

$logid= $_REQUEST["logid"];

$time= date('Y/m/d h:i:s',strtotime($_REQUEST["time"]));

if(isset($_REQUEST["cancel"])){

   $sql = "update pulseemergency set status=0, endtime=null where logid='$logid'";

}else{

   $sql = "update pulseemergency set status=0, endtime='$time' where logid='$logid'";

}



if (!mysqli_query($con,$sql)) {

  die('Error: ' . mysqli_error($con));

}



mysqli_close($con);

?>	