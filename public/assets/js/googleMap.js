function initMap() {

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 5,
        center: {lat: 48.8588377, lng: 2.2770199}
    });

    // Create an array of alphabetical characters used to label the markers.
    var labels = '123456789';

    // Add some markers to the map.
    // Note: The code uses the JavaScript Array.prototype.map() method to
    // create an array of markers based on a given "locations" array.
    // The map() method here has nothing to do with the Google Maps API.
    var markers = locations.map(function(location, i) {
        return new google.maps.Marker({
            position: location,
            label: labels[i % labels.length]
        });
    });


    // Add a marker clusterer to manage the markers.
    var markerCluster = new MarkerClusterer(map, markers,
        {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

}
var locations = [];
var xhr = new XMLHttpRequest();

xhr.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200)
    {
        var data = JSON.parse(xhr.responseText);
        for (var i = 0; i < data.length; i++) {
            locations[i] = {lat: Number(data[i]["Latitude"]), lng: Number(data[i]["Longitude"])};
        }
    }
};

xhr.open('GET', "../app/Controller/map.php");
xhr.send(null);
