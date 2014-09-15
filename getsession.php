<?PHP
session_start();
if(isset($_SESSION['user'])){
	echo $_SESSION['user'];
} else {
	echo "unauthorized";
}
?>