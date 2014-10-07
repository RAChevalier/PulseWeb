<?PHP
	include ('connect.php');
	$fnameerr = $lnameerr = $doberr = $gendererr = $mobileerr = $emailerr = "";
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
<div class='container'>
<form name='reg' method='post' action='reg_form.php'>
<table cellpadding="2px">
<tr><td class='label'>Username :</td><td><input type='text' name='txt_username'/></td></tr>
<tr><td class='label'>Password :</td><td><input type='password' name='txt_password'/></td></tr>
<tr><td class='label'>First Name :</td><td><input type='text' name='txt_first_name'/></td></tr>
<tr><td></td><td class='err'><?PHP echo $fnameerr; ?></td></tr>
<tr><td class='label'>Last Name :</td><td><input type='text' name='txt_last_name'/></td></tr>
<tr><td></td><td class='err'><?PHP echo $lnameerr; ?></td></tr>
<tr><td class='label'>Date of Birth :</td><td><input type='text' name='txt_dob' placeholder="dd/mm/yyyy"/></td></tr>
<tr><td></td><td class='err'><?PHP echo $doberr; ?></td></tr>
<tr><td class='label'>Gender :</td><td><select name='gender'><option value=''></option><option value='M'>Male</option><option value='F'>Female</option></select></td></tr>
<tr><td></td><td class='err'><?PHP echo $gendererr; ?></td></tr>
<tr><td class='label'>Mobile :</td><td><input type='text' name='txt_mobile' /></td></tr>
<tr><td></td><td class='err'><?PHP echo $mobileerr; ?></td></tr>
<tr><td class='label'>Email :</td><td><input type='text' name='txt_email'/></td></tr>
<tr><td></td><td class='err'><?PHP echo $emailerr; ?></td></tr>
<tr><td class='label'>Address :</td><td><input type='text' name='txt_address'/></td></tr>
<tr><td></td><td class='err'><?PHP echo $mobileerr; ?></td></tr>
<tr><td><input type='submit' name='btn_register' value='Register' /></td><td><input type='button' name='btn_clear' value='clear' /></td></tr>
</table>
</form>
</div>
</body>
</html>