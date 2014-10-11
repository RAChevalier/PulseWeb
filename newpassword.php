<?PHP
	include 'connect.php';
	session_start();
	$user = $_SESSION["user"][0];
	$level = $_SESSION["user"][3];
	$newpass = md5($_POST["pass"]);
	if($newpass != ""){
		mysql_query("update pulseadmin set password='".$newpass."' where username='".$user."'", $conn) or die(mysql_error());
	}
	echo $level;
?>