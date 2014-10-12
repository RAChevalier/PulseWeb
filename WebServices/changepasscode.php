<?php

include("connection.php");

$email = $_REQUEST["email"];

$new = $_REQUEST["new"];

$sql = "update pulseuser set realpasscode='$new' where email='$email'";



if (!mysqli_query($con,$sql)) {

  die('Error: ' . mysqli_error($con));

}



mysqli_close($con);

?>	