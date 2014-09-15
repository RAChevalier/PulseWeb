<?PHP
session_start();
if($_POST['user'] != ""){
	$u = $_POST['user'];
	$p = md5($_POST['pass']);

	$conn = mysql_connect('mysql.ict.swin.edu.au', 's4944623', '300193') or die ('Could not connect: '.mysql_error());
	mysql_select_db('s4944623_db') or die('Could not select database');
	
	$result = mysql_query("select username from pulseadmin where username=$u and password=$p") or die (mysql_error());

	if(mysql_num_rows($result) == 0){
		//header("Location: login.html?loginfailed");
	} else {
		$_SESSION['user'] = $u;
		header('Location: home.html');
	}
}
?>