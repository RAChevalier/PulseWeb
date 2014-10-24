<?php

include("connection.php");

$fname= $_REQUEST["fname"];

$sname= $_REQUEST["sname"];

$email= $_REQUEST["email"];

$gender= $_REQUEST["gender"];

$dob= $_REQUEST["dob"];

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

$sql = "insert into pulseuser (firstname, lastname, email, gender, dob, mobile, address, suburb, state, country, postcode, emergencyContact, emergencyNumber) VALUES ('$fname', '$sname', '$email', '$gender', '$dob', '$mobile', '$address', '$suburb', '$state', '$country', '$postcode', '$emergencyContact', '$emergencyNumber'";



if (!mysqli_query($con,$sql)) {

  die('Error: ' . mysqli_error($con));

}

mysqli_close($con);

?>	