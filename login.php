<?PHP
session_start();
$u = $_POST['user'];
$p = md5($_POST['pass']);

$conn = mysql_connect('mysql.ict.swin.edu.au', 's4944623', '300193') or die ('Could not connect: '.mysql_error());
mysql_select_db('s4944623_db') or die('Could not select database');

$result = mysql_query("select * from pulseadmin");

if(mysql_num_rows($result) == 0){
	//header("Location: login.html?$result");
} else {
	header('Location: home.html');
}
?>