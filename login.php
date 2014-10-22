<?PHP
	include 'connect.php';
if($_POST['user'] != ""){
	$u = $_POST['user'];
	$p = md5($_POST['pass']);

	$result = mysql_query("select username, firstname, lastname, level, status from pulseadmin where username='".$u."' and password='".$p."'", $conn) or die (mysql_error());

	if(mysql_num_rows($result) == 0){
		header("Location: login.html?loginfailed");
	} else {
		$row = mysql_fetch_assoc($result);
		if($row['status'] == 0){
			header("Location: login.html?unauthorized");
		} else {
			$user = $row['username'];
			$first = $row['firstname'];
			$last = $row['lastname'];
			$level = $row['level'];
			if($p == md5('pulse123')){
				$_SESSION['newpassword'] = array($user, $first, $last, $level);
				header("Location: newpassword.html");
			} else {
				$_SESSION['user'] = array($user, $first, $last, $level);
				mysql_query("insert into pulselogin (username, logintime) values('".$user."', '".$date."')", $conn) or die (mysql_error());
				mysql_query("update pulseadmin set lastlogin='".$date."' where username='".$user."'", $conn) or die (mysql_error());
				if($row['level'] == 0){
					header("Location: home.html");
				} else {
					header('Location: agent.html');
				}
			}
		}
	}
} else {
	header("Location: login.html?loginfailed");
}
?>