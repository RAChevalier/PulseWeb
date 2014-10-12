<?php

include("connection.php");

$em= $_REQUEST["em"];

$lng= $_REQUEST["lng"];

$lat= $_REQUEST["lat"];

$time= date('Y/m/d h:i:s',strtotime($_REQUEST["time"]));

$trigger= $_REQUEST["trigger"];



if($trigger=='TOUCH'){

  $trigger=1;

}else if($trigger=='EARPHONE'){

  $trigger=2;

}else{

  $trigger=0;

}



$sql = "insert into pulseemergency(email,activatedtime,activatedlocation,startlocation,endlocation,triggertype,status) values('$em','$time','$lat,$lng','$lat,$lng','$lat,$lng','$trigger',1)";



if (!mysqli_query($con,$sql)) {

  die('Error: ' . mysqli_error($con));

}



$sql = "select max(logid) as m from pulseemergency";

$result = mysqli_query($con,$sql);

$row = mysqli_fetch_array($result);

echo $row["m"];



mysqli_close($con);

?>	