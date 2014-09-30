<?PHP
	include 'connect.php';
	
	$q = $_GET['q'];
	if($q == "agent"){
		$query = mysql_query("select firstname, lastname, username, addedby, level, lastlogin from pulseadmin where status = 1", $conn) or die (mysql_error());
		$result = "";
		while($row = mysql_fetch_assoc($query)){
			$name = $row['firstname']." ".$row['lastname'];
			$uname = $row['username'];
			$addedby = $row['addedby'];
			if($row['level'] == 0){
				$level = 'Admin';
			} else {
				$level = 'Agent';
			}
			$lastlogin = date("D, d/m/Y H:i:s", strtotime($row['lastlogin']));
			$viewlog = "<a href=javascript:viewLog('".$uname."')> View Log </a>";
			$delete = "<a href='delete.php?uname=".$uname."'> Delete </a>";
			$result .= "<tr><td>$name</td><td>$uname</td><td>$addedby</td><td>$level</td><td>$lastlogin</td><td>$viewlog</td><td>$delete</td></tr>";
		}
		echo $result;
	}
	if($q == "log"){
		$user = $_GET["user"];
		$query = mysql_query("select time from pulselogin where username = '".$user."' order by time desc limit 10", $conn) or die (mysql_error());
		$result = "";
		$i = 0;
		while($row = mysql_fetch_row($query)){
			$i++;
			$date = date("D, d/m/Y H:i:s", strtotime($row[0]));
			$result .= "<tr><td>$i</td><td>$date</td></tr>";
		}
		echo $result;
	}
	if($q == "user"){
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