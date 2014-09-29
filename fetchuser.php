<?PHP
	include 'connect.php';
	
	$q = $_GET['q'];
	if($q == "agent"){
		$query = mysql_query("select firstname, lastname, mobile, address, suburb, postcode, subscriptionstart, dob, gender from pulseuser", $conn) or die (mysql_error());
		$result = "";
		while($row = mysql_fetch_assoc($query)){
			$fname = $row['firstname'];
			$lname = $row['lastname'];
			$mobile = $row['mobile'];
			$address = $row['address'];
			$suburb = $row['suburb'];
			$postcode = $row['postcode'];
			$dateJoin = $row['subscriptionstart'];
			$age = date("Y")-substr($row['dob'],0,4);
			$gender = $row['gender'];

			$result .= "<tr><td>$fname</td><td>$lname</td><td>$mobile</td><td>$address</td><td>$suburb</td><td>$postcode</td><td>$dateJoin</td><td>$age</td><td>$gender</td></tr>";
		}
		echo $result;
	}
?>