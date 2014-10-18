<?php

/**deleteagent.php

delete agent or admin from database

will accept username parameter to be  delete account but only admin account can delete. will require admin 

password to edit or delete account

version v.1

**/

include 'connect.php';

if(isset($_GET["uname"])){

	$username = $_GET["uname"];

	//echo $username;

	

	$result_set;

	$query;

	$row_effected;

	$sql = "update pulseadmin set status = 0 where username = '$username'";

	//echo $sql;

	$result_set = mysql_query($sql) or die (mysql_error);

	$rows_affected = mysql_affected_rows($conn);

	//$sql = "select password from pulseadmin where username = 'admin'";

	

	

	mysql_close($conn);

   // print("<script type='text/javascript'>alert('Agent has been successfully deleted');</script>" );

	header('Location: home.html?delete');

	

}



?>