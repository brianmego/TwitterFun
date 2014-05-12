var map;

window.onload = function() {
    $("#getFriends").click(getFriends);
    $("#getTimeline").click(getTimeline);
    initialize();
}

function getFriends() {
    $.getJSON('/index.php/twitter/get_friends').done(

        function (data){
            console.log(data);
        });
}

function getTimeline() {
    $.getJSON('/index.php/twitter/get_timeline').done(
        function (response){
            response.forEach( function (tweet) {
                if (tweet.coordinates) {
                    addMapMarker(tweet);
                }
            });
        });
}

function addMapMarker(tweet) {
    var coordinates = tweet.coordinates.coordinates;
    var myLatlng = new google.maps.LatLng(coordinates[1], coordinates[0]);
    var marker = new google.maps.Marker({
        position: myLatlng,
        title: tweet.user.name
    });
    marker.setAnimation(google.maps.Animation.DROP);
    marker.setMap(map);
}

function initialize() {
    var mapOptions = {
      center: new google.maps.LatLng(0, 0),
      zoom: 2
    };
    map = new google.maps.Map(document.getElementById("map-canvas"),
        mapOptions);
  }
