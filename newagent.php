<?PHP
	include ('connect.php');
	
	
?>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<style>
body{
	font-family:'Open Sans';
	background-color:#333;
}
table{
	background-color:#111;
	position:absolute;
	margin:auto;
	top:0;
	bottom:0;
	left:0;
	right:0;
}
.label{
	color:#36C;
	text-align:right;
}
.err{
	color:#C00;
}
</style>
</head>
<body>
<?php 
$username_err = $role_err = $fname_err = $lname_err = $dob_err = $gender_err = $mobile_err = $email_err = $suburb_err = $state_err = $country_err = $postcode_err = $username = $role = $first_name = $last_name = $dob = $gender = $email = $mobile = $address = $suburb = $state = $postcode = $country = "";
$result_set;
$query;
$rows_affected;
$password;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//checking username
	if(empty($_POST["txt_username"])){
	$username_err = "Username is required!";
	}
	else {
	$username = $_POST["txt_username"];
	}
	//checking roles
	if($_POST["level"] == ""){
	$role_err = "role must be chosen!";
	}
	else{
	$role = $_POST["level"];
	}
	//checking first name
	if(empty($_POST["txt_first_name"])){
	$fname_err = "first name is required!";
	}else{
	$first_name = $_POST["txt_first_name"];
	if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) { // only letters and whitespace is allowed in first name
	$fname_err = "Only letters and white space allowed"; 
	}
	}
	//checking last name
	if(empty($_POST["txt_last_name"])){
	$lname_err = "last name is required!";
	}
	else{
	$last_name = $_POST["txt_last_name"];
	if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) { // only letters and whitespace is allowed in last name
	$lname_err = "Only letters and white space allowed"; 
	}
	}
	//checking date of birth is empty or not
	if(empty($_POST["txt_dob"])){
	$dob_err = "date of birth is required!";
	}
	else{
	$dob = $_POST["txt_dob"];
	}
	//checking gender is chosen or not
	if($_POST["gender"] == ""){
	$gender_err = "Gender is required to choose!";
	}
	else{
	$gender = $_POST["gender"];
	}
	 
	//checking mobile number is filled or not
	if($_POST["txt_mobile"] == ""){
	$mobile_err = "Mobile number is required to fill !";
	}
	else{
	$mobile = $_POST["txt_mobile"];
		if(!preg_match("/^[0-9]*$/",$mobile)) { // only numbers are allowed in mobile number field
			$mobile_err = "Only numbers are allowed"; 
			}
	}
	
	//checking email address is filled or not
	if($_POST["txt_email"] == ""){
	$email_err = "Email address is required !";
	}
	else{
	$email = $_POST["txt_email"];
	}
	//validating home address
	if($_POST["txt_address"] == ""){
	$address_err = "Home address is required !";
	}
	else{
	$address = $_POST["txt_address"];
	}
	//validating suburb
	if($_POST["txt_suburb"] == ""){
	$suburb_err = "Suburb of your address is required !";
	}
	else {
	$suburb = $_POST["txt_suburb"];
	}
	//validating state of address
	if($_POST["txt_state"] == ""){
	$state_err = "State of your address is required !";
	}
	else{
	$state = $_POST["txt_state"];
	}
	
	//validing postcode
	if($_POST["txt_postcode"] == ""){
	$postcode_err = "Postcode field is required !";
	}
	else{
	$postcode = $_POST["txt_postcode"];
	}
	
	//validating country
	if($_POST["txt_country"] == ""){
	$country_err = "Country field is required !";
	}
	else{
	$country = $_POST["txt_country"];
	}
	/*
	$sql = "insert into pulseadmin(username,password,firstname,lastname,dob,gender,mobile,email,address,suburb,state,country,postcode)";
    $sql .= "values ('$username','$password','$first_name','$last_name','$dob','$gender','$mobile','$email','$address','$suburb','$state','$country','$postcode')";
    
    $result = mysql_query($sql) or die (mysql_error());
    
    $rows_affected = mysql_affected_rows($conn);
    
    mysql_close($conn);
    print($rows_affected);
    print("<div class='container'> agent row has been added to the pulseagent table");
    print(" (username $username)\n</div>");
	*/
	}
	?>
<div class='container'>
<form name='reg' method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
<table cellpadding="2px">
<tr><td class='label'>Username :</td><td><input type='text' name='txt_username' value="<?php echo htmlspecialchars($username);?>"/></td><td class='err'><?php echo $username_err ?></td></tr>
<tr><td class='label'>Role :</td><td><select name='level'><option value=''></option><option value='0' <?php if (isset($role) && $role=='0') echo "selected";?> >Admin</option><option value='1' <?php if (isset($role) && $role=='1') echo "selected";?>>Agent</option></select></td><td class='err'><?php echo $role_err ?></td></tr>
<tr><td class='label'>First Name :</td><td><input type='text' name='txt_first_name' value="<?php echo htmlspecialchars($first_name);?>"/></td><td class='err'><?PHP echo $fname_err; ?></td></tr>
<tr><td class='label'>Last Name :</td><td><input type='text' name='txt_last_name' value="<?php echo htmlspecialchars($last_name);?>"/></td><td class='err'><?PHP echo $lname_err; ?></td></tr>
<tr><td class='label'>Date of Birth :</td><td><input type='text' name='txt_dob' placeholder="YYYY-MM-DD" value="<?php echo htmlspecialchars($dob);?>"/></td><td class='err'><?PHP echo $dob_err; ?></td></tr>
<tr><td class='label'>Gender :</td><td><select name='gender'><option value=''></option><option value='M' <?php if (isset($gender) && $gender=='M') echo "selected";?>>Male</option><option value='F' <?php if (isset($gender) && $gender=='F') echo "selected";?>>Female</option></select></td><td class='err'><?PHP echo $gender_err; ?></td></tr>
<tr><td class='label'>Mobile :</td><td><input type='text' name='txt_mobile' value="<?php echo htmlspecialchars($mobile);?>" /></td><td class='err'><?PHP echo $mobile_err; ?></td></tr>
<tr><td class='label'>Email :</td><td><input type='text' name='txt_email' value="<?php echo htmlspecialchars($email);?>" /></td><td class='err'><?PHP echo $email_err; ?></td></tr>
<tr><td class='label'>Address :</td><td><input type='text' name='txt_address' value="<?php echo htmlspecialchars($address);?>" /></td><td class='err'><?PHP echo $address_err; ?></td></tr>
<tr><td class='label'>Suburb :</td><td><input type='text' name='txt_suburb'/></td><td class='err'><?PHP echo $suburb_err; ?></td></tr>
<tr><td class='label'>State :</td><td><input type='text' name='txt_state'/></td><td class='err'><?PHP echo $state_err; ?></td></tr>
<tr><td class='label'>Postcode :</td><td><input type='text' name='txt_postcode'/></td><td class='err'><?PHP echo $postcode_err; ?></td></tr>
<tr><td class='label'>Country :</td><td><input type='text' name='txt_country'/></td><td class='err'><?PHP echo $country_err; ?></td></tr>
<tr><td><input type='submit' name='btn_register' value='Register' /></td><td><input type='button' name='btn_clear' value='clear' /></td></tr>
</table>
</form>
</div>
</body>
</html>