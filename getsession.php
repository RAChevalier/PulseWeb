<?PHP
session_start();
if(isset($_SESSION['user'])){
	echo $_SESSION['user'][0].",".$_SESSION['user'][1].",".$_SESSION['user'][2].",".$_SESSION['user'][3];
} else {
	echo "unauthorized";
}
?>