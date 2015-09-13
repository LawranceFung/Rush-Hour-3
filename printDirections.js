
$(document).ready(function() {
  $('#printDirections').click(function() {
  var printOut;
  data = $.getJSON("https://api.mapbox.com/v4/directions/mapbox.driving/-122.42,37.78;-77.03,38.91.json?access_token=pk.eyJ1IjoiamVyaWNvZGUiLCJhIjoiY2llaTlzcHRnMDBqbHNybTFndDAweno5cyJ9.gPQQaYjYiDgLrkpDQ7YKTA", function(data) {

  });

  jQuery.when(
    jQuery.getJSON('https://api.mapbox.com/v4/directions/mapbox.driving/-122.42,37.78;-77.03,38.91.json?access_token=pk.eyJ1IjoiamVyaWNvZGUiLCJhIjoiY2llaTlzcHRnMDBqbHNybTFndDAweno5cyJ9.gPQQaYjYiDgLrkpDQ7YKTA')
  ).done( function(json) {
    console.log(json.routes[0].steps);
    arrayOfSteps = json.routes[0].steps;
    printOut = "Route from " + json.origin.properties.name + " to " +  json.destination.properties.name + "\n";
    printOut += "Distance: " + (json.routes[0].distance * .00062).toFixed(2) + " miles \n";
    printOut += "Duration: " + (json.routes[0].duration / 60).toFixed(2) + " minutes \n";
    printOut += "Summary: " + json.routes[0].summary + "\n";


    printOut += "From your start destination: \n\n";
    for (i = 0; i < arrayOfSteps.length; i++){
      if (i == arrayOfSteps.length - 1){
        printOut += arrayOfSteps[i].maneuver.instruction;
      }else{
        printOut += arrayOfSteps[i].maneuver.instruction + " for " +
          (arrayOfSteps[i].duration / 60).toFixed(2) + " minutes ---- " +
          (arrayOfSteps[i].distance * .00062).toFixed(2) + " miles \n\n";
      }
    }
    alert(printOut);
  });
});
});

