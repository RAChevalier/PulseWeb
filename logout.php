<?PHP
	include('connect.php');
	session_start();
	$u = $_SESSION['user'][0];
	mysql_query("update pulselogin set logouttime=now() where username='".$u."' order by logid desc limit 1") or die (mysql_error());
	
	session_destroy();
	header('Location: login.html?logout');
?>