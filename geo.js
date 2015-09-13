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
                                var destUrl = 'ayeke.me:3000/municipal/';
                                var sendXYUrl = destUrl.concat(JSON.stringify(data['results'][0]['geometry']['location']['lat'])).concat("/").concat(JSON.stringify(data['results'][0]['geometry']['location']['lng']));
                                // document.getElementById('temp').innerHTML = sendXYUrl;
                                console.log(sendXYUrl);
                                var data2;
                                $.ajax({
                                    url: sendXYUrl,
                                    dataType:"json",
                                    json:"mycallback",
                                    success:function(data2)
                                    {
                                        if(data2['id'] != 0){

                                            console.log()
                                            document.getElementById('temp').innerHTML = JSON.stringify(data2);
                                            // Put JSON data into divs
                                            // Court
                                            document.getElementById('courtName').innerHTML = JSON.stringify(data2['city']);
                                            document.getElementById('courtName').setAttribute('href', JSON.stringify(data2['web']));
                                        }else{
                                            // direct to county office
                                            document.getElementById('courtName').innerHTML = "County Jurisdiction / Unincorporated";
                                            document.getElementById('courtAddress').innerHTML = "The location you've given is either not in the county, in St. Louis proper or in an unincorporated area. See the website or call the phone number for additional details.";
                                        }
                                        var plus = "+";
                                        var courtAddress = "Address: "
                                        document.getElementById('courtPhone').innerHTML = courtAddress.concat(JSON.stringify(data2['phone']));
                                        document.getElementById('courtPhone').setAttribute('href', plus.concat(slugify(JSON.stringify(data2['phone']))));
                                        // document.getElementById('temp').innerHTML = JSON.stringify(data2);
                                        myX = slugify(JSON.stringify(data2['x']));
                                        myY = slugify(JSON.stringify(data2['y']));

                                    }
                                });
                            });
                            document.getElementById('popup').style.visibility = 'visible';
                            event.preventDefault();
                        });
                    });

