<?php
/**systemstatus.php
system status of pulse web portal
will display server status of web server and database server.
version v.1
**/
echo "<table>";
$server = get_server_status('localhost',80); // get boolean value of server is online or not
if($server == 1){
echo "<tr><td>Server status </td><td> : <span style='color:#01DF01;'>Online</span></td></tr>";
}
else{
echo "<tr><td>Server status </td><td> : <span style='color:red;'>Offline</span></td></tr>";
}
$sqlserver = mysql_connect('sql201.byethost5.com', 'b5_15320225', 'pulsepulse');//get boolean value of sql server is online or not
if($sqlserver){
echo "<tr><td>Database Server status </td><td> : <span style='color:#01DF01;'>Online</span></td></tr>";
}
else{
die("<tr><td>Database status </td><td> : <span style='color:red;'>Offline</span></td></tr>");
}
$num;
echo "<tr><td>User online </td><td> : <span style='color:green;'>" . $num . "</span></td></tr></table>";
//function that return server according to port is online or not
function get_server_status($host,$port){
	
	 $fsock = fsockopen($host, $port, $errno, $errstr, $timeout);
        if ( ! $fsock )
        {
                return 0;
        }
        else
        {
                return 1;
        }
	
}
    mysql_close($sqlserver);

?>
