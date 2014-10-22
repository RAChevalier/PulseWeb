<?PHP
	include 'connect.php';
	$q = $_GET['q'];
	$logid = $_GET['id'];
	$user = $_SESSION['user'][0];
	if($q == 'handle'){
		$query = mysql_query("select u.firstname, u.lastname from pulseuser u, pulseemergency e where e.email=u.email and logid='".$logid."'", $conn) or die(mysql_error());
		$query = mysql_fetch_row($query);
		$name = $query[0]." ".$query[1];
		mysql_query("update pulseemergency set status = 2, username = '".$user."' where logid='".$logid."'", $conn) or die(mysql_error());
		echo "<div class='og' onclick='detail(".$logid.")'> $name </div>";
	}
?>