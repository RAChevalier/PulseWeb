var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange=function(){
	if(xhttp.readyState==4&&xhttp.status==200)
	{
		if(xhttp.responseText == "unauthorized"){
			window.location = "login.html?unauthorized";
		}else{
			var data = xhttp.responseText.split(",");
			document.getElementById("welcome").innerHTML= data[1] + " " + data[2];
		}
	}
}
xhttp.open("POST", "getsession.php", true);
xhttp.send();

function fill(option){
	if(option == 'status'){
		document.getElementById('main').innerHTML="System Status";
		document.getElementById('header').innerHTML = "";
	} else if(option == 'users'){
		document.getElementById('header').innerHTML = "";
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange=function(){
			if(xhttp.readyState==4&&xhttp.status==200)
			{
				var content = "";
				content += "<table cellpadding='10'><tr class='tableheader'><td>First Name</td><td>Surname</td><td>Mobile</td><td>Address</td><td>Suburb</td><td>Postcode</td><td>Date Joined</td><td>Age</td><td>Gender</td><td>Usage</td></tr>";
				content += xhttp.responseText;
				content += "</table>";
				document.getElementById('main').innerHTML=content;
			}
		}
		xhttp.open("GET", "fetchdata.php?q=user", true);
		xhttp.send();
	} else if(option == 'agents'){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange=function(){
			if(xhttp.readyState==4&&xhttp.status==200)
			{
				var content = "";
				content += "<table cellpadding='10'><tr class='tableheader'><td>Name</td><td>Username</td><td>Added By</td><td>Level</td><td>Last Logged</td><td></td><td></td></tr>";
				content += xhttp.responseText;
				content += "</table>";
				document.getElementById('main').innerHTML=content;
			}
		}
		xhttp.open("GET", "fetchdata.php?q=agent", true);
		xhttp.send();
		var header = "";
		header += "<div class='headeropt' onClick='newAgent()'>NEW AGENT</div>";
		header += "<div class='search'>";
		header += "<select id='category'><option value='all'>All</option><option value='name'>Name</option><option value='username'>Username</option><option value='addedby'>Added By</option><option value='level'>Level</option></select>";
		header += "<input type='text' id='keyword' placeholder='Search...' onkeypress='return searchAgent(event)'/></div>";
		document.getElementById('header').innerHTML = header;
	} else if(option == 'statistics'){
		document.getElementById('main').innerHTML="Statistics";
		document.getElementById('header').innerHTML = "";
	} else {
		document.getElementById('main').innerHTML="Emergency Notification";
		document.getElementById('header').innerHTML = "";
	}
}

function viewLog(user){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange=function(){
		if(xhttp.readyState==4&&xhttp.status==200)
		{
			var content = "";
			content += "<table cellpadding='10'><tr class='tableheader'><td>No.</td><td>Date and Time</td></tr>";
			content += xhttp.responseText;
			content += "</table>";
			document.getElementById('main').innerHTML=content;
		}
	}
	xhttp.open("GET", "fetchdata.php?q=log&user="+user, true);
	xhttp.send();
}

function newAgent(){
	var tab = window.open('newagent.php', '_blank');
	tab.focus();
}

function searchAgent(e){
	if(e.keyCode == 13){
		var keyword = document.getElementById('keyword').value;
		var category = document.getElementById('category').value;
		var content = "";
		xhttp.onreadystatechange=function(){
			if(xhttp.readyState==4&&xhttp.status==200)
			{
				var result = xhttp.responseText;
				result = result.split("|");
				if(result[0] > 0){
					content += "<div class='numrow'>" + result[0] + " matching row(s) found</div>";
					content += "<table cellpadding='10'><tr class='tableheader'><td>Name</td><td>Username</td><td>Added By</td><td>Level</td><td>Last Logged</td><td></td><td></td></tr>";
					content += result[1];
					content += "</table>";
				} else {
					content = "<div class='numrow'>" + result + "</div>";
				}
				document.getElementById('main').innerHTML=content;
			}
		}
		xhttp.open("GET", "fetchdata.php?q=search&type=agent&category=" + category + "&keyword=" + keyword, true);
		xhttp.send();
		document.getElementById('main').innerHTML = content;
		return false;
	}
}