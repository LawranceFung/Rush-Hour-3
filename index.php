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
		    	var address = document.getElementById("address").value;		    	
		    	var jurisdictionString = "Court with jurisdiction over violations at: ";
		    	document.getElementById('violationAddress').innerHTML = jurisdictionString.concat(address);
		    	
		    	// Cohere API call
				var apiKey = 'AIzaSyC0GUd7gFoVVt03p9-hR1dLfsjmrUm9pTM';
				var apiBase = 'https://maps.googleapis.com/maps/api/geocode/json?address=';				
				var baseAddress = apiBase.concat(slugify(address));
				var baseKey = baseAddress.concat("&key=").concat(apiKey);
				var data;
				$.getJSON(baseKey, function(data) {				    				    
				    var xy = {"x": JSON.stringify(data['results'][0]['geometry']['location']['lat']), "y":JSON.stringify(data['results'][0]['geometry']['location']['lng'])};
				    
					var destUrl = 'http://www.ayeke.me:3000/municipal/';
					var sendXYUrl = destUrl.concat(JSON.stringify(data['results'][0]['geometry']['location']['lat'])).concat("/").concat(JSON.stringify(data['results'][0]['geometry']['location']['lng']));
					// $.get(sendXYUrl);
					var data2;
					$.ajax({
				        url : "http://hayageektest.appspot.com/cross-domain-cors/jsonp.php",
				        dataType:"jsonp",
				        jsonp:"mycallback",
				        success:function(data2)
				        {				            
				       		document.getElementById('temp').innerHTML = JSON.stringify(data2);     
				        }
				    });
					// document.getElementById('temp').innerHTML = sendXYUrl;
					// var xmlHttp = new XMLHttpRequest();
				 //    xmlHttp.onreadystatechange = function() { 
				 //        if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
				 //            var temp = callback(xmlHttp.responseText);
				 //            document.getElementById('temp').innerHTML = temp;
				 //            // Put the JSON data into the page
				 //        }
				 //    }
				 //    xmlHttp.open("GET", sendXYUrl, true); // true for asynchronous 
				 //    console.log();
				 //    xmlHttp.send(null);
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
			Where did you get your ticket? <br>
			<input type="text" name="address" id="address">	  
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

		<script src="index.js"></script>
	</body>
</html>