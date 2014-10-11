<?PHP
	include ('connect.php');
	session_start();
if(isset($_SESSION['user']) && $_SESSION['user'][3] == 0){
	//echo $_SESSION['user'][0].",".$_SESSION['user'][1].",".$_SESSION['user'][2].",".$_SESSION['user'][3];
} else {
	echo "unauthorized access!! Please log in as Admin again <input type='button' value = 'log in' onclick =\"location.href='login.html'\" />" ;
	exit;
}
	
	
	
	
?>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<style>
body{
	font-family:'Open Sans';
	background-color:#222;
}
table{
	background-color:#555;
	position:relative;
	margin:auto;
	top:0;
	bottom:0;
	left:0;
	right:0;
}
.label{
	color:#09C;
	text-align:right;
}
.err{
	color:#C00;
}
</style>
</head>
<body>
<?php 

//echo $_SESSION['user'][0] . $_SESSION['user'][3] ;
$addedby = $_SESSION['user'][0];

$username_err = $role_err = $fname_err = $lname_err = $dob_err = $gender_err = $mobile_err = $email_err = $suburb_err = $state_err = $country_err = $address_err = $postcode_err = $username = $role = $first_name = $last_name = $dob = $gender = $email = $mobile = $address = $suburb = $state = $postcode = $country = $length ="";
$result_set;
$query;
$rows_affected;
$password = md5("pulse123");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$check=true;

	
	//checking first name
	if(empty($_POST["txt_first_name"])){
	$fname_err = "First name is required";
	$check = false;
	}else{
	if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) { // only letters and whitespace is allowed in first name
	$fname_err = "Only letters and white space allowed"; 
	} else {
	$first_name = ucfirst($_POST["txt_first_name"]);
	}
	}
	//checking last name
	if(empty($_POST["txt_last_name"])){
	$lname_err = "Last name is required";
	$check = false;
	}
	else{
	if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) { // only letters and whitespace is allowed in last name
	$lname_err = "Only letters and white space allowed";
	$check = false;
	}
	$last_name = ucfirst($_POST["txt_last_name"]);
	$username = substr($first_name,0,1);
	$username = strtolower($username.$last_name);
	//$lname_err = $username;
	}
	//checking roles
	if($_POST["level"] == ""){
	$role_err = "Please pick a role";
	$check = false;
	}
	else{
	$role = $_POST["level"];
	}
	
	//checking date of birth is empty or not
	if(empty($_POST["txt_dob"])){
	$dob_err = "Date of birth is required";
	$check = false;
	}
	elseif (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])/(0[1-9]|1[0-2])/[0-9]{4})$/",$date)){
		$dob_err = "Invalid date format";
	} else{
	list($d, $m, $y) = split("/", $_POST["txt_dob"]);
	$dob = $y."-".$m."-".$d;
	}
	//checking gender is chosen or not
	if($_POST["gender"] == ""){
	$gender_err = "Please pick a gender";
	$check = false;
	}
	else{
	$gender = $_POST["gender"];
	}
	 
	//checking mobile number is filled or not
	if($_POST["txt_mobile"] == ""){
	$mobile_err = "Mobile number is required";
	$check = false;
	}
	else{
	$mobile = $_POST["txt_mobile"];
	$length = strlen((string)$mobile);
		if(!preg_match("/^[0-9]*$/",$mobile)) { // only numbers are allowed in mobile number field
			$mobile_err = "Only numbers are allowed"; 
			$check = false;
			}
		if($length != 10){
		$mobile_err = "Invalid length";
		}
	}
	
	//checking email address is filled or not
	if($_POST["txt_email"] == ""){
	$email_err = "E-mail address is required";
	$check = false;
	}
	else{
	$email = $_POST["txt_email"];
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //check if valid email or not
      $email_err = "Invalid email format"; 
	  $check = false;
    }
	}
	//validating home address
	if($_POST["txt_address"] == ""){
	$address_err = "Home address is required";
	$check = false;
	}
	else{
	$address = $_POST["txt_address"];
	}
	//validating suburb
	if($_POST["txt_suburb"] == ""){
	$suburb_err = "Suburb is required";
	$check = false;
	}
	else {
	$suburb = $_POST["txt_suburb"];
	if (!preg_match("/^[a-zA-Z ]*$/",$suburb)) { // only letters and whitespace is allowed in first name
			$suburb_err = "Only letters are allowed"; 
			$check = false;
			}
	}
	//validating state of address
	if($_POST["txt_state"] == ""){
	$state_err = "State is required";
	$check = false;
	}
	else{
	$state = $_POST["txt_state"];
	}
	
	//validing postcode
	if($_POST["txt_postcode"] == ""){
	$postcode_err = "Postcode is required";
	$check = false;
	}
	else{
	$postcode = $_POST["txt_postcode"];
	if(!preg_match("/^[0-9]*$/",$postcode)) { // only numbers are allowed in mobile number field
			$postcode_err = "Only numbers are allowed"; 
			$check = false;
			}
	}
	
	//validating country
	if($_POST["txt_country"] == ""){
	$country_err = "Country is required";
	$check = false;
	}
	else{
	$country = $_POST["txt_country"];
	}
	
	/**username validation
	$sql = "select * from pulseadmin where username = '" . $username . "'";
	$result = mysql_query($sql) or die (mysql_error());
	if($result){
		echo "<div class='containter'> Duplicate username!! your name is already registered on database. Please Try again<input type='button' value = 'Go back' onclick =\"window.history.back()\" /></div>";
		exit();
		}
	else{
	$check=1;
	}**/
	if($check){
	$sql = "insert into pulseadmin(username,password,firstname,lastname,dob,gender,mobile,email,address,suburb,state,country,postcode,addedby,level)";
    $sql .= "values ('$username','$password','$first_name','$last_name','$dob','$gender','$mobile','$email','$address','$suburb','$state','$country','$postcode','$addedby','$role')";
    
    $result = mysql_query($sql) or die (mysql_error() . "<div class='containter'> Duplicated username. Please alter name.<input type='button' value = 'Go back' onclick =\"window.history.back()\" /></div>");
    
    $rows_affected = mysql_affected_rows($conn);
    
    mysql_close($conn);
    print($rows_affected );
    /*print("<div class='container'> agent row has been added to the pulseagent table");
    print(" (username $username) <input type='button' value = 'Add new agent' onclick =\"location.href='newagent.php'\" /> or <input type='button' value = 'Home page' onclick =\"location.href='home.html'\" /> \n</div>");*/
	echo "<script type='text/javascript'>alert('Agent has been successfully added');</script>";
	$username_err = $role_err = $fname_err = $lname_err = $dob_err = $gender_err = $mobile_err = $email_err = $suburb_err = $state_err = $country_err = $address_err = $postcode_err = $username = $role = $first_name = $last_name = $dob = $gender = $email = $mobile = $address = $suburb = $state = $postcode = $country = $length ="";
	}
	}
	
	
	?>
<div class='container'>
<form name='reg' method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
<table cellpadding="2px">


<tr><td class='label'>First Name :</td><td><input type='text' name='txt_first_name' value="<?php echo htmlspecialchars($first_name);?>"/></td><td class='err'><?PHP echo $fname_err; ?></td></tr>
<tr><td class='label'>Last Name :</td><td><input type='text' name='txt_last_name' value="<?php echo htmlspecialchars($last_name);?>"/></td><td class='err'><?PHP echo $lname_err; ?></td></tr>
<tr><td class='label'>Role :</td><td><select name='level'><option value=''></option><option value='0' <?php if (isset($role) && $role=='0') echo "selected";?> >Admin</option><option value='1' <?php if (isset($role) && $role=='1') echo "selected";?>>Agent</option></select></td><td class='err'><?php echo $role_err ?></td></tr>
<tr><td class='label'>Date of Birth :</td><td><input type='text' name='txt_dob' placeholder="DD/MM/YYYY" maxlength="10" value="<?php echo htmlspecialchars($dob);?>"/></td><td class='err'><?PHP echo $dob_err; ?></td></tr>
<tr><td class='label'>Gender :</td><td><select name='gender'><option value=''></option><option value='M' <?php if (isset($gender) && $gender=='M') echo "selected";?>>Male</option><option value='F' <?php if (isset($gender) && $gender=='F') echo "selected";?>>Female</option></select></td><td class='err'><?PHP echo $gender_err; ?></td></tr>
<tr><td class='label'>Mobile :</td><td><input type='text' name='txt_mobile' maxlength="10" value="<?php echo htmlspecialchars($mobile);?>" /></td><td class='err'><?PHP echo $mobile_err; ?></td></tr>
<tr><td class='label'>Email :</td><td><input type='text' name='txt_email' value="<?php echo htmlspecialchars($email);?>" /></td><td class='err'><?PHP echo $email_err; ?></td></tr>
<tr><td class='label'>Address :</td><td><input type='text' name='txt_address' value="<?php echo htmlspecialchars($address);?>" /></td><td class='err'><?PHP echo $address_err; ?></td></tr>
<tr><td class='label'>Suburb :</td><td><input type='text' name='txt_suburb' value="<?php echo htmlspecialchars($suburb);?>" /></td><td class='err'><?PHP echo $suburb_err; ?></td></tr>
<tr><td class='label'>State :</td><td><input type='text' name='txt_state' value="<?php echo htmlspecialchars($state);?>"/></td><td class='err'><?PHP echo $state_err; ?></td></tr>
<tr><td class='label'>Postcode :</td><td><input type='text' name='txt_postcode' value="<?php echo htmlspecialchars($postcode);?>"/></td><td class='err'><?PHP echo $postcode_err; ?></td></tr>
<tr><td class='label'>Country :</td><td><input type='text' name='txt_country' value="<?php echo htmlspecialchars($country);?>"/></td><td class='err'><?PHP echo $country_err; ?></td></tr>
<tr><td></td><td><input type='submit' name='btn_register' value='Register' /></td></tr>
</table>
</form>
</div>
</body>
</html>