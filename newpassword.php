<?PHP
	include 'connect.php';
	session_start();
	$user = $_SESSION["newpassword"][0];
	$first = $_SESSION["newpassword"][1];
	$last = $_SESSION["newpassword"][2];
	$level = $_SESSION["newpassword"][3];
	$newpass = md5($_POST["newpass"]);
	if($_POST['newpass'] == ""){
		header('Location: newpassword.html?blank');
	} elseif($newpass == "2ef5d6ca5b950ad5fab171378daba805") {
		header('Location: newpassword.html?default');
	} else {
		mysql_query("update pulseadmin set password='".$newpass."' where username='".$user."'", $conn) or die(mysql_error());
		$_SESSION['user'] = array($user, $first, $last, $level);
				mysql_query("insert into pulselogin (username, logintime) values('".$user."', '".$date."')", $conn) or die (mysql_error());
				mysql_query("update pulseadmin set lastlogin='".$date."' where username='".$user."'", $conn) or die (mysql_error());
				if($level == 0){
					header("Location: home.html");
				} else {
					header('Location: agent.html');
				}
	}
?>