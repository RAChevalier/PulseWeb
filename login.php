<?PHP
session_start();
if($_POST['user'] != ""){
	$u = $_POST['user'];
	$p = md5($_POST['pass']);

	include 'connect.php';
	
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
			$_SESSION['user'] = array($user, $first, $last, $level);
			mysql_query("insert into pulselogin (username, time) values('".$user."', now())", $conn) or die (mysql_error());
			if($row['level'] == 0){
				header("Location: home.html");
			} else {
				header('Location: agent.html');
			}
		}
	}
} else {
	header("Location: login.html?loginfailed");
}
?>