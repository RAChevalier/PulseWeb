<?php

include("connection.php");

$fname= $_REQUEST["fname"];

$sname= $_REQUEST["sname"];

$email= $_REQUEST["email"];

$dob= $_REQUEST["dob"];

$gender= $_REQUEST["gender"];

$mobile= ($_REQUEST["mobile"]));

$address= $_REQUEST["address"];

$suburb= $_REQUEST["suburb"];

$state= $_REQUEST["state"];

$country= $_REQUEST["country"];

$postcode= $_REQUEST["postcode"];

$emergencyContact= $_REQUEST["emergencyContact"];

$emergencyNumber= $_REQUEST["emergencyNumber"];

//$picture = $_REQUEST["picture"];
//$realpasscode = $_REQUEST["realpasscode"];
//$altpasscode = $_REQUEST["altpasscode"];
//$subscriptionstart = $_REQUEST["subscriptionstart"];
//$subscriptionend = $_REQUEST["subscriptionend"];

$sql = "update pulseuser set firstname='$fname', lastname='$sname', email='$email', gender='$gender', dob='$dob', mobile='$mobile', address='$address', suburb='$suburb', state='$state', country='$country', postcode='$postcode', emergencyContact='$emergencyContact', emergencyNumber='$emergencyNumber'";


if (!mysqli_query($con,$sql)) {

  die('Error: ' . mysqli_error($con));

}

mysqli_close($con);

?>	