<?PHP
/*
	$conn = mysql_connect('mysql.ict.swin.edu.au', 's4944623', '300193') or die ('Could not connect: '.mysql_error());
	mysql_select_db('s4944623_db') or die('Could not select database');
*/
	$conn = mysql_connect('sql201.byethost5.com', 'b5_15320225', 'pulsepulse') or die ('Could not connect: '.mysql_error());
	mysql_select_db('b5_15320225_pulse') or die('Could not select database');
	date_default_timezone_set("Australia/Melbourne");
	$date = date('Y-m-d H:i:s');
	session_start();
?>