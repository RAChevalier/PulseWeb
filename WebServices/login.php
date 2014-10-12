<?php

include("connection.php");

$email = $_REQUEST["email"];

$password = md5($_REQUEST["password"]);

$result = mysqli_query($con,"select email,realpasscode from pulseuser where email='$email'and password='$password'");

$row = mysqli_fetch_array($result);

/*if (!$result) {

    printf("Error: %s\n", mysqli_error($con));

    exit();

}*/

$data = $row[0];

if($data){

	echo $row[1];

}else{

        echo "FALSE";

}

mysqli_close($con);

?>	