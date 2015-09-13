console.log("in jquery");
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
                          event.preventDefault();
                            //Cohere address
                            var address = document.getElementById("address").value;

                            var apiKey = 'AIzaSyC0GUd7gFoVVt03p9-hR1dLfsjmrUm9pTM';
                            var apiBase = 'https://maps.googleapis.com/maps/api/geocode/json?address=';
                            var baseAddress = apiBase.concat(slugify(address));
                            var baseKey = baseAddress.concat("&key=").concat(apiKey);
                            var data;
                            console.log('here')
                            $.getJSON(baseKey, function(data) {
                                var xy = {"x": JSON.stringify(data['results'][0]['geometry']['location']['lat']), "y":JSON.stringify(data['results'][0]['geometry']['location']['lng'])};
                                var destUrl = 'http://ayeke.me:3000/municipal/';
                                var sendXYUrl = destUrl.concat(data['results'][0]['geometry']['location']['lng'].toString()+ "/" + data['results'][0]['geometry']['location']['lat'].toString());
                                // document.getElementById('temp').innerHTML = sendXYUrl;
                                console.log(sendXYUrl);
                                var data2;
                                $.get(sendXYUrl, "",function(data2)
                                {
                                  var address = data2["address"];
                                  var apiKey = 'AIzaSyC0GUd7gFoVVt03p9-hR1dLfsjmrUm9pTM';
                                  var apiBase = 'https://maps.googleapis.com/maps/api/geocode/json?address=';
                                  var baseAddress = apiBase.concat(slugify(address));
                                  var baseKey = baseAddress.concat("&key=").concat(apiKey);
                                  $.getJSON(baseKey, function(data) {
                                    initMap_new(data['results'][0]['geometry']['location']['lat'], data['results'][0]['geometry']['location']['lng']);
                                  });
                                  console.log(data2);
                                    if(data2['id'] != 0){
                                        console.log("reached")
                                        $('#courtName').text(data2['city']);
                                        $('#courtPhone').text(data2["address"]);
                                        $("#courtAddress").text(data2["phone"]);
                                        $("#siteLink").attr("href", data2["web"]);
                                    }else{
                                        // direct to county office
                                        $('#courtName').innerHTML = "County Jurisdiction / Unincorporated";
                                        $('#courtAddress').innerHTML = "The location you've given is either not in the county, in St. Louis proper or in an unincorporated area. See the website or call the phone number for additional details.";
                                    }
                                    // document.getElementById('temp').innerHTML = JSON.stringify(data2);
                                    myX = slugify(JSON.stringify(data2['x']));
                                    myY = slugify(JSON.stringify(data2['y']));

                                } );
                            });
                            document.getElementById('popup').style.visibility = 'visible';
                            event.preventDefault();
                        });
                    });
