<?php
/**deleteagent.php
statistics of pulse web portal
will display total numbers of users on database and total agents numbers and numbers of online users and server status of web server and database server.
version v.1
**/
include 'connect.php';

	$result_set;
	$query;
	//$rows_effected;
	$sql;
	
	
	$total_user = get_total_users(); //get total user numbers
	$total_emergency = get_total_emergency(); //get total emergency logs
	$total_agent = get_total_agent(); // get total agent numbers
	$total_female = get_total_female_user($total_user);//get total female users
	$total_male = 100 - $total_female;
	$average_emergency = get_average_emergency(); // get average emergency per day
	$average_emergency_user = get_average_emergency_user();//get average emergency per user
	//print results
	
	//total user block
	echo "<div style='width:150px;height:100px;border:none;background-color:#06C;position:absolute;left:20px;top:50px;'><span style='font-size:11px;color:white;text-align:center;width:100%;height:30px;display:block;'>Total Users</span>";
	echo "<span style='font-size:26px;font-family:Serif;color:white;text-align:center;width:100%;display:block;'>" . $total_user . "</span></div>";
	//total emergency block
	echo "<div style='width:150px;height:100px;border:none;background-color:#06C; position:absolute;top:50px;left:220px;'><span style='font-size:11px;color:white;text-align:center;width:100%;height:30px;display:block;'>Number of Emergencies</span>";
	echo "<span style='font-size:26px;font-family:Serif;color:white;text-align:center;width:100%;display:block; '>" . $total_emergency . "</span></div>";
	//Average emergency per day block
	echo "<div style='width:150px;height:100px;border:none;background-color:#06C;position:absolute;top:50px;left:420px;'><span style='font-size:11px;color:white;text-align:center;width:100%;height:30px;display:block;'>Average Emergency per Day</span>";
	echo "<span style='font-size:26px;font-family:Serif;color:white;text-align:center;width:100%;display:block; '>" . $average_emergency . "</span></div>";
	//Total Agent block
	echo "<div style='width:150px;height:100px;border:none;background-color:#06C;position:absolute;top:180px;left:20px;'><span style='font-size:11px;color:white;text-align:center;width:100%;height:30px;display:block;'>Number of Agents</span>";
	echo "<span style='font-size:26px;font-family:Serif;color:white;text-align:center;width:100%;display:block; '>" . $total_agent . "</span></div>";
	//Total Female Users Percentage block
	echo "<div style='width:150px;height:100px;border:none;background-color:#06C;position:absolute;top:180px;left:220px;'><span style='font-size:11px;color:white;text-align:center;width:100%;height:30px;display:block;'>Female Users</span>";
	echo "<span style='font-size:26px;font-family:Serif;color:white;text-align:center;width:100%;display:block; '>" . $total_female . " % </span></div>";
	//Total Male Users Percentage block
	echo "<div style='width:150px;height:100px;border:none;background-color:#06C;position:absolute;top:180px;left:420px;'><span style='font-size:11px;color:white;text-align:center;width:100%;height:30px;display:block;'>Male Users</span>";
	echo "<span style='font-size:26px;font-family:Serif;color:white;text-align:center;width:100%;display:block; '>" . $total_male . " % </span></div>";
	//Average Emergency per user
	echo "<div style='width:150px;height:100px;border:none;background-color:#06C;position:absolute;top:310px;left:20px;'><span style='font-size:11px;color:white;text-align:center;width:100%;height:30px;display:block;'>Average Emergency per User</span>";
	echo "<span style='font-size:26px;font-family:Serif;color:white;text-align:center;width:100%;display:block; '>" . $average_emergency_user . "</span></div>";
	//Recent 7 days numbers of emergencies
	echo "<div style='width:auto;height:auto;border:none;background-color:#06C;position:absolute;top:310px;left:220px;'><span style='font-size:11px;color:white;text-align:center;width:300px;height:5px;display:block;'>Number of emergencies in the past 7 days</span>";
	
	get_last_emergency();
	echo "</div>";
	//function that returns total numbers of users registered in database
	function get_total_users(){
		$sql = "select * from pulseuser";
		$result_set = mysql_query($sql) or die (mysql_error);
	//$rows_affected = mysql_affected_rows($conn);
	$total_user = mysql_num_rows($result_set);
	return $total_user;
	}
	//functions that returns total emergency logs 
	function get_total_emergency(){
		$sql = "select * from pulseemergency";
		$result_set = mysql_query($sql) or die (mysql_error);
		$total_emergency = mysql_num_rows($result_set);
		//echo $total_emergency;
		return $total_emergency;
		}
	
	//function that returns total agent registered
	function get_total_agent(){
		$sql = "select * from pulseadmin";
		$result_set = mysql_query($sql) or die (mysql_error);
		$total_agent = mysql_num_rows($result_set);
		return $total_agent;
		}
	//function that return total average numbers of emergency in a day
	function get_average_emergency(){
		$num = 0;
		$count = 0;
		$average;
		$sql = "select date(activatedtime) as Listdate , count(*) as count from pulseemergency  group by Listdate";
		$result_set = mysql_query($sql) or die (mysql_error);
		while($row = mysql_fetch_array($result_set)){
			$num = $num + $row['count'];
			$count = $count + 1;
		}
		if($count != 0){
		$average = $num / $count;
		$average = round($average,2);
		//echo $average;
		return $average;
		}
	}
	//function that display numbers of emegercy for last 7 days 
	function get_last_emergency(){
		$sql = "select date(activatedtime) as Listdate , count(*) as count from pulseemergency where date(activatedtime) >= DATE_SUB(CURDATE(), interval 7 day) group by Listdate order by Listdate DESC";
		$result_set = mysql_query($sql) or die (mysql_error);
		echo "<table style='border-spacing:10px; margin: auto; left:0; right:0'><tr><th><span style='color:white;'>Date</span></th><th><span style='color:white;'>No. of emergencies</span></th></tr>";
		while($row = mysql_fetch_array($result_set)){
		echo "<tr><td style='color:white;'>" . $row['Listdate'] . "</td>";
		echo "<td style='color:white;text-align:center;'>" . $row['count'] . "</td></tr>";
		
		}
		echo "</table>";
		}
		//function that return percentage of female users
	function get_total_female_user($total_agent){
		$sql = "select * from pulseuser where gender = 'F'";
		$result_set = mysql_query($sql) or die (mysql_error);
		$total_female = mysql_num_rows($result_set);
		$total_female = ($total_female * 100) / $total_agent;
		$total_female = round($total_female,2);
		return $total_female;
		}
		//function that return total average numbers of emergency per user
	function get_average_emergency_user(){
		$num = 0;
		$count = 0;
		$average;
		$sql = "select count(*) as count from pulseemergency  group by email";
		$result_set = mysql_query($sql) or die (mysql_error);
		while($row = mysql_fetch_array($result_set)){
			$num = $num + $row['count'];
			$count = $count + 1;
		}
		if($count != 0){
		$average = $num / $count;
		$average = round($average,2);
		//echo $average;
		return $average;
		}
	}
		mysql_close($conn);

?>