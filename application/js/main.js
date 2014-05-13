var map;
var markers = [];

window.onload = function() {
    $("#plotTweets").click(plotTweets);
    initialize();
}

function plotTweets() {
    deleteMarkers();
    $.getJSON('/index.php/twitter/get_timeline').done(
        function (response){
            response.forEach( function (tweet) {
                if (tweet.coordinates) {
                    addMapMarker(tweet);
                }
            });
            console.log(response);
            showMarkers();
        });
}

// Add a marker to the map and push to the array.
function addMapMarker(tweet) {
    var coordinates = tweet.coordinates.coordinates;
    var myLatlng = new google.maps.LatLng(coordinates[1], coordinates[0]);
    var marker = new google.maps.Marker({
        position: myLatlng,
        title: tweet.user.name,
        map: map,
        icon: tweet.user.profile_image_url
    });
    marker.setAnimation(google.maps.Animation.DROP);
    markers.push(marker);
}

// Sets the map on all markers in the array.
function setAllMap(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

// Removes the markers from the map, but keeps them in the array.
function clearAllMarkers() {
    setAllMap(null);
}

// Shows any markers currently in the array.
function showMarkers() {
    setAllMap(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
    clearAllMarkers();
    markers = [];
}

function initialize() {
    var mapOptions = {
      center: new google.maps.LatLng(0, 0),
      zoom: 2
    };
    map = new google.maps.Map(document.getElementById("map-canvas"),
        mapOptions);
  }
