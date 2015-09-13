<!-- <!DOCTYPE html> -->
<html>

<head>
	<style>    
	body {padding-top: 50px;}
	.day {padding-left: 100px;}
	.hours {padding-left: 100px;}
	.title {font-style: bold;}
	.hide {visibility: hidden;}
	</style>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>        
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
		function slugify(text) {
			return text.toString().toLowerCase()
				.replace(/\s+/g, '-') // Replace spaces with -
				.replace(/[^\w\-]+/g, '') // Remove all non-word chars
				.replace(/\-\-+/g, '-') // Replace multiple - with single -
				.replace(/^-+/, '') // Trim - from start of text
				.replace(/-+$/, ''); // Trim - from end of text
		}	
		// REsponse to clicking the submit button
		$(document).ready(function(){
			$("#submit").click(function(event){	   
		    	//Cohere address	    	
		    	var address = document.getElementById("number").value.concat(" ", document.getElementById("street1").value, ", Saint Louis MO");		    	
		    	var jurisdictionString = "Court with jurisdiction over violations in: ";
		    	document.getElementById('violationAddress').innerHTML = jurisdictionString.concat(address);

		    	// Get x and y coordinates from address	
		    	// geocoder = new google.maps.Geocoder();
		    	// var geocoder;
		    	// var map;

				// Google Maps API key:  AIzaSyDibtIRA06cMRn7uk3k2cY1gY_A67bAkpM 
				// Client id:  727206825951-vemqbij0ubldshd671g7o26qi2rvpn83.apps.googleusercontent.com 
				// client secret:  BLcTBVrwricyBmB4oElBXNa8 
				// var clientId = '727206825951';
				var apiKey = 'AIzaSyC0GUd7gFoVVt03p9-hR1dLfsjmrUm9pTM';
				var apiBase = 'https://maps.googleapis.com/maps/api/geocode/json?address=';
				// %s,%s&key=%s
				var baseAddress = apiBase.concat(slugify(address));
				var baseKey = baseAddress.concat("&key=").concat(apiKey);
				var data;
				$.getJSON(baseKey, function(data) {				    				    
				    var xy = {"x": JSON.stringify(data['results'][0]['geometry']['location']['lat']), "y":JSON.stringify(data['results'][0]['geometry']['location']['lng'])};
				    // var latLng = JSON.stringify(data['results'][0]['geometry']['location']);
					// document.getElementById('temp').innerHTML = JSON.stringify(xy);
					// ayeke.me:3000/municipal/{lattitude}/{longitude}
					var destUrl = ayeke.me:3000/municipal/;
					var sendXYUrl = destUrl.concat(JSON.stringify(data['results'][0]['geometry']['location']['lat'], "/", JSON.stringify(data['results'][0]['geometry']['location']['lng'])
					var xmlHttp = new XMLHttpRequest();
				    xmlHttp.onreadystatechange = function() { 
				        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
				            callback(xmlHttp.responseText);
				    }
				    xmlHttp.open("GET", sendXYUrl, true); // true for asynchronous 
				    xmlHttp.send(null);
				});

		    	// Display the located court
		    	document.getElementById('popup').style.visibility = 'visible';
		    	event.preventDefault();
		    });
});		
</script>
Live in Saint Louis County?  Find where to challenge a ticket
<!-- Input Form -->
<form method="POST">
	Street Number (If not at intersection):<br>
	<input type="number" name="number" id="number">
	<br>	  
	Street Name 1 (include type, eg road, boulevard, etc.)<br>
	<input type="text" name="street1" id="street1">	  
	<br>
	Street Name 2 (If at intersection) (include type, eg road, boulevard, etc.)<br>
	<input type="text" name="street2">
	<br>
	City:<br>
	<input type="text" name="city">
	<br>	  
	Zip Code:<br>
	<input type="number" name="zip">
	<br>
	<input type="submit" id="submit" value="Submit">
</form>

<!-- Popup that shows processed data -->
<div class="hide" id="popup">						
	<b id="violationAddress"></b>
	<br>
	<div id="courtInfo"></div>
	<br>
	<b>Directions</b>
	<br>
	<div id="directionsText"></div>
	<div id="directionsMap"></div>
	<br>
	<b>Legal Services</b>
	<br>
	We recommend <a href="http://www.lsem.org/">Legal Services of Eastern Missouri</a>
	<br>
	If you cannot afford a lawyer, they may be able to find a volunteer
	<br>
	<a href="tel:+1-800-444-0514">1-800-444-0514</a>
	<br>
	Hours:&nbsp;&nbsp;Monday-Thursday&nbsp;&nbsp;&nbsp;8:30 AM-3:30 PM
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fridays&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1:30 PM-3:30 PM
	<br>
	Please note if emergency
</div>




<div id="temp"></div>



	<!-- <form method="post">
		<input type="submit" value="Start Over">
	</form> -->

	<script src="index.js"></script>
</body>
</html>