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
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
		    $("#submit").click(function(event){	   
		    	// Get x and y coordinates from address
		    	// var address = document.getElementById("number").value + ", " document.getElementById("street1").value + ", Saint Louis, MO";

		    	// geocoder = new google.maps.Geocoder();
		    	// geocoder.geocode({'address':address})
		    	// var coordinates = {"x": , "y":}

		    	//Send coordinates to back end

		    	//Set local variables

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
	  <input type="number" name="number">
	  <br>	  
	  Street Name 1 (include type, eg road, boulevard, etc.)<br>
	  <input type="text" name="street1">	  
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
		<b>Court</b>
		<br>
		<b>Directions</b>
		<br>
		<b>Legal Services</b>
		<br>
		We recommend <a href="http://www.lsem.org/">Legal Services of Eastern Missouri</a>
		<br>
		<a href="tel:+1-800-444-0514">1-800-444-0514</a>
		<br>
		Hours:&nbsp;&nbsp;Monday-Thursday&nbsp;&nbsp;&nbsp;8:30 AM-3:30 PM
		<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fridays&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1:30 PM-3:30 PM
		<br>
		Please note if emergency
	</div>


	
	

	<!-- <form method="post">
		<input type="submit" value="Start Over">
	</form> -->

	<script src="index.js"></script>
  </body>
</html>