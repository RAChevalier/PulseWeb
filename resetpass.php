<?PHP
	include 'connect.php';
	$def = md5('pulse123');
	mysql_query("update pulseadmin set password='".$def."' where username='".$_GET['uname']."'", $conn) or die(mysql_error());
	header('Location: home.html?reset');
?>