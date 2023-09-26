/*
   Created By : Urdhva Tech Pvt. Ltd.
   Created date : 12/06/2017
   Contact at : contact@urdhva-tech.com
   Module : Google Address
*/
if(ut_google_key !=''){
        if(typeof  ut_google_map_lib === 'undefined') {
            ut_google_map_lib =true;
            $.getScript("https://maps.googleapis.com/maps/api/js?key="+ut_google_key+"&v=3.exp&libraries=places");
        }
        else {
            if(ut_google_map_lib ==false){
                ut_google_map_lib =true;
                 $.getScript("https://maps.googleapis.com/maps/api/js?key="+ut_google_key+"&v=3.exp&libraries=places");
            }
        }
    }
    else {
        console.log("Google API key is not configured");
    }

(function(){
    displayMap = function(addresskey){
        var div_id= addresskey+'_map_block';
        var address_street = $("#"+addresskey+"_address_street").val();
        var address_city = $("#"+addresskey+"_address_city").val();
        var address_state = $("#"+addresskey+"_address_state").val();
        var address_country = $("#"+addresskey+"_address_country").val();
        var address_postalcode = $("#"+addresskey+"_address_postalcode").val();
        
        if(address_street =='' && address_city =='' && address_state =='' && address_country =='' && address_postalcode ==''){
            return;   
        }
        if(utgoogle_license == 'Ok'){
            $("#"+div_id).toggle();
            var address = encodeURIComponent(address_street+" "+address_city+" "+address_state+" "+address_country+" "+address_postalcode);
            $.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address='+address+'&sensor=false', null, function (data) {
                 if(data.status == 'OK'){
                    var p = data.results[0].geometry.location;
                     var latlng = new google.maps.LatLng(p.lat, p.lng);
                     var mapOptions = {
                        center: latlng,
                        zoom: 12
                      }
                    var map = new google.maps.Map(document.getElementById(div_id), mapOptions);
                    var marker = new google.maps.Marker({
                        position: latlng,
                        url : "https://www.google.com/maps/place/"+address
                    });
                // To add the marker to the map, call setMap();
                    marker.setMap(map);
                    marker.addListener('click',  function() { 
                        window.open(this.url, '_blank');
                    });  
                 }
                 else{
                     alert("Can not find location! Google error code : " + data.status);
                 }     
            });
        }
        else{
            alert("License Error : " + utgoogle_license)
        }
    }
})();