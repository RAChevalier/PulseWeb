<?PHP
	include ('connect.php');
	$fnameerr = $lnameerr = $doberr = $gendererr = $mobileerr = "";
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
<form>
<table cellpadding="2px">
<tr><td class='label'>First Name :</td><td><input type='text' name='fname'/></td></tr>
<tr><td>&nbsp;</td><td class='err'><?PHP echo $fnameerr; ?></td></tr>
<tr><td class='label'>Last Name :</td><td><input type='text' name='lname'/></td></tr>
<tr><td></td><td class='err'><?PHP echo $lnameerr; ?></td></tr>
<tr><td class='label'>Date of Birth :</td><td><input type='text' name='dob' placeholder="dd/mm/yyyy"/></td></tr>
<tr><td></td><td class='err'><?PHP echo $doberr; ?></td></tr>
<tr><td class='label'>Gender :</td><td><select name='gender'><option value=''></option><option value='M'>Male</option><option value='F'>Female</option></select></td></tr>
<tr><td></td><td class='err'><?PHP echo $gendererr; ?></td></tr>
<tr><td class='label'>Mobile :</td><td><input type='text' name='mobile'/></td></tr>
<tr><td></td><td class='err'><?PHP echo $mobileerr; ?></td></tr>
</table>
</form>
</div>
</body>
</html>