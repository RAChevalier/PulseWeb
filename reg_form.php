<?php
//reg_form.php for register.php
//author: Zwe Aung Myint Tun
$first_name = $_POST["txt_first_name"];
$last_name = $_POST["txt_last_name"];
$dob = $_POST["txt_dob"];
$gender = $_POST["gender"];
$username = $_POST["txt_username"];
$password = $_POST["txt_password"];
$email = $_POST["txt_email"];
$mobile = $_POST["txt_mobile"];
$address = $_POST["txt_address"];
$result_set;
$query;
$rows_affected;
//$rowarray;

include 'connect.php';
/*$connection = @mysql_connect("localhost ","admin","admin")
		or die (mysql_error());
mysql_select_db("b5_15320225_pulse") or die (mysql_error());
$sql = "select max(username) + 1 from pulseadmin";
    
    $result = mysql_query($sql) or die (mysql_error());
    
    $rowarray = mysql_fetch_row($result);
    
    $username = $rowarray[0];*/
    
    $sql = "insert into pulseadmin(username,password,firstname,lastname,dob,gender,mobile,email,address)";
    $sql .= "values ('$username','$password','$first_name','$last_name','$dob','$gender','$mobile','$email','$address')";
    
    $result = mysql_query($sql) or die (mysql_error());
    
    $rows_affected = mysql_affected_rows($conn);
    
    mysql_close($conn);
    print($rows_affected);
    print(" agent row has been added to the pulseagent table");
    print(" (username $username)\n");



?>