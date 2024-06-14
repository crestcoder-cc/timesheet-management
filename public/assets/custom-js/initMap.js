var marker;
var map;
var infowindow;
var address = ''

function initMap() {
    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById('map-canvas'), {
        center: {lat: 29.3117, lng: 47.4818},
        zoom: 8
    });
    //var card = document.getElementById('pac-card');
    var input = document.getElementById('location');
    // map.controls[google.maps.ControlPosition.TOP_CENTER].push(card);

    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.bindTo('bounds', map);

    // Set the data fields to return when the user selects a place.
    autocomplete.setFields(
        ['address_components', 'geometry', 'icon', 'name']);

    infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');
    infowindow.setContent(infowindowContent);
    marker = new google.maps.Marker({
        map: map,
        draggable: true,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function () {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {

            map.fitBounds(place.geometry.viewport);
        } else {

            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        address = '';
        country = '';
        country_code = '';
        city = '';
        if (place.address_components) {


            address = [
                (place.address_components[0] && place.address_components[0].long_name || ''),
                (place.address_components[1] && place.address_components[1].long_name || ''),
                (place.address_components[2] && place.address_components[2].long_name || ''),
                (place.address_components[3] && place.address_components[3].long_name || ''),
                (place.address_components[4] && place.address_components[4].long_name || ''),
                (place.address_components[5] && place.address_components[5].long_name || ''),
                (place.address_components[6] && place.address_components[6].long_name || ''),
                (place.address_components[7] && place.address_components[7].long_name || ''),
                (place.address_components[8] && place.address_components[8].long_name || '')
            ].join(' ');
        }



        google.maps.event.addListener(marker, 'click', function () {
            geocodePosition(marker.getPosition());
            $("#latitude").val(marker.getPosition().lat());
            $("#longitude").val(marker.getPosition().lng());
            //displayLocation(marker.getPosition().lat(),marker.getPosition().lng());
            infowindow.open(map, marker);
        });

        google.maps.event.trigger(marker, 'click');


        google.maps.event.addListener(marker, 'dragend',
            function () {
                geocodePosition(marker.getPosition());
                //console.log(marker.getPosition().toUrlValue(6));
                $("#latitude").val(marker.getPosition().lat());
                $("#longitude").val(marker.getPosition().lng());

                infowindow.open(map, marker);
            }
        );
    });
}

function geocodePosition(pos) {
    geocoder.geocode({
        latLng: pos
    }, function(responses) {
        if (responses && responses.length > 0) {
            marker.formatted_address = responses[0].formatted_address;
        } else {
            marker.formatted_address = 'Cannot determine address at this location.';
        }
        infowindow.setContent(marker.formatted_address + "<br>coordinates: " + marker.getPosition().toUrlValue(6));
        $("#location").val(marker.formatted_address);
        get_city_name(responses);
        infowindow.open(map, marker);
    });
}

function get_city_name(place){
    for (var i = 0; i < place[0].address_components.length; i++) {
        if (place[0].address_components[i].types[0] === 'country') {
            country = place[0].address_components[i].long_name;
            country_code = place[0].address_components[i].short_name;

        }
        if (place[0].address_components[i].types[0] === 'locality') {
            city = place[0].address_components[i].long_name;
        }
    }

    $("#city").val(city);
}


function displayLocation(latitude,longitude){
    var geocoder;
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(latitude, longitude);

    geocoder.geocode(
        {'latLng': latlng},
        function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var add= results[0].formatted_address ;
                    var  value=add.split(",");

                    count=value.length;
                    country=value[count-1];
                    state=value[count-2];
                    city=value[count-3];
                    //x.innerHTML = "city name is: " + city;
                    $("#city").val(city);
                }
                else  {
                    x.innerHTML = "address not found";
                }
            }
            else {
                x.innerHTML = "Geocoder failed due to: " + status;
            }
        }
    );
}

$('#location').keydown(function (e) {
    if (e.which === 13 && $('.pac-container:visible').length) return false;
});

function addMarker(lat, long, location) {
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, long),
        draggable: true,
        animation: google.maps.Animation.DROP,
        map: map
    });
    map.setCenter(new google.maps.LatLng(lat, long));
    map.setZoom(17);

    google.maps.event.addListener(marker, 'click', function () {
        //infowindow.setContent(location);
        infowindow.setContent(location + "<br>coordinates: " + marker.getPosition().toUrlValue(6));
        infowindow.open(map, marker);
    });



    google.maps.event.addListener(marker, 'select', function () {
        infowindow.setContent(location);
        infowindow.open(map, marker);
    });
    google.maps.event.trigger(marker, 'click');

    google.maps.event.addListener(marker, 'dragend',
        function () {
            geocodePosition(marker.getPosition());
            console.log(marker.getPosition().toUrlValue(6));
            if (marker.formatted_address) {
                infowindow.setContent(marker.formatted_address + "<br>coordinates: " + marker.getPosition().toUrlValue(6));
                $("#location").val(marker.formatted_address);
                $("#pac-input").val(marker.formatted_address);

            } else {
                console.log(marker.getPosition().toUrlValue(6));
                infowindow.setContent(location + "<br>coordinates: " + marker.getPosition().toUrlValue(6));
                $("#location").val(location);
                $("#pac-input").val(location);
            }
            $("#latitude").val(marker.getPosition().lat());
            $("#longitude").val(marker.getPosition().lng());

            infowindow.open(map, marker);
        }
    );
}
