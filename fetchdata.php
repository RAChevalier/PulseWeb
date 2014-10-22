<?PHP
	include 'connect.php';
	
	$q = $_GET['q'];
	
	/*AGENT*/
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
			$resetpass = "<a href='resetpass.php?uname=".$uname."'> Reset Password </a>";
			$result .= "<tr><td>$name</td><td>$uname</td><td>$addedby</td><td>$level</td><td>$lastlogin</td><td>$viewlog</td><td>$delete</td><td>$resetpass</td></tr>";
		}
		echo $result;
	}
	
	/*EMERGENCY*/
	if($q == "emergency"){
		$query = mysql_query("select u.firstname, u.lastname, e.logid, e.starttime from pulseuser u, pulseemergency e where u.email = e.email and e.status = 1", $conn) or die (mysql_error());
		$result = "INCOMING (".mysql_num_rows($query).")";
		while($row = mysql_fetch_assoc($query)){
			if($row['starttime']){
				$current = new DateTime();
				$starttime = new DateTime($row['starttime']);
				$timediff = $starttime->diff($current);
				$diff = $timediff->format('%h hours %i minutes %s seconds');
				$diff .= ' ago';
			} else {
				$diff = "NULL";
			}
			$result .= "<div class='iemergency' id='".$row['logid']."' onclick='handle(".$row['logid'].")'><span class='name'>".$row['firstname']." ".$row['lastname']."</span><br/><span class='time'>".$diff."</span></div>";
		}
		echo $result;
	}
	
	/*LOG*/
	if($q == "log"){
		$user = $_GET["user"];
		$query = mysql_query("select logintime, logouttime from pulselogin where username = '".$user."' order by logintime desc limit 10", $conn) or die (mysql_error());
		$result = "";
		$i = 0;
		while($row = mysql_fetch_row($query)){
			$i++;
			$login = date("D, d/m/Y H:i:s", strtotime($row[0]));
			if($row[1] != null){
				$logout = date("D, d/m/Y H:i:s", strtotime($row[1]));
			} else {
				$logout = "";
			}
			$result .= "<tr><td>$i</td><td>$login</td><td>$logout</td></tr>";
		}
		echo $result;
	}
	
	/*USER*/
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
	
	/*SEARCH*/
	if($q == "search"){
		$type = $_GET['type'];
		$result = "";
		if($type == "agent"){
			$c = $_GET['category'];
			$k = $_GET['keyword'];
			if($c == "username"){
				$query = mysql_query("select firstname, lastname, username, addedby, level, lastlogin from pulseadmin where status = 1 and username like '%".$k."%'", $conn);
			} elseif ($c == "level"){
				if($k == "admin"){
					$k = 0;
				} elseif ($k == "agent"){
					$k = 1;
				}
				$query = mysql_query("select firstname, lastname, username, addedby, level, lastlogin from pulseadmin where status = 1 and level like '%".$k."%'", $conn);
			} elseif ($c == "addedby"){
				$query = mysql_query("select firstname, lastname, username, addedby, level, lastlogin from pulseadmin where status = 1 and addedby like '%".$k."%'", $conn);
			} elseif ($c == "name"){
				$query = mysql_query("select firstname, lastname, username, addedby, level, lastlogin from pulseadmin where status = 1 and (firstname like '%".$k."%' or lastname like '%".$k."%')", $conn);
			} else {
				$query = mysql_query("select firstname, lastname, username, addedby, level, lastlogin from pulseadmin where status = 1 and (firstname like '%".$k."%' or lastname like '%".$k."%' or username like '%".$k."%' or level like '%".$k."%' or addedby like '%".$k."%')", $conn);
			}
			
			$numrow = mysql_num_rows($query);
			if($numrow == 0){
				echo "No data found";
			} else {
				$result .= $numrow."|";
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
			}
		}
		echo $result;
	}
	
	/*ONGOING*/
	if($q == "ongoing"){
		$agent = $_SESSION['user'][0];
		$query = mysql_query("select u.firstname, u.lastname, e.logid, e.starttime, e.username from pulseuser u, pulseemergency e where u.email = e.email and e.status = 2 and e.username='".$agent."'", $conn) or die (mysql_error());
		$result = "ONGOING (".mysql_num_rows($query).")";
		while($row = mysql_fetch_assoc($query)){
			if($row['starttime']){
				$current = new DateTime();
				$starttime = new DateTime($row['starttime']);
				$timediff = $starttime->diff($current);
				$diff = $timediff->format('%h hours %i minutes %s seconds');
				$diff .= ' ago';
			} else {
				$diff = "NULL";
			}
			$result .= "<div class='iemergency' id='".$row['logid']."' onclick='detail(".$row['logid'].")'><span class='name'>".$row['firstname']." ".$row['lastname']."</span><br/><span class='time'>".$diff."</span></div>";
		}
		echo $result;
	}
	
	/*DETAIL*/
	if($q == "detail"){
	}
?>