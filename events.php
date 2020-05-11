<?php
include 'header.php';
require_once __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Datastore\DatastoreClient;
?>

<div class="w3-container" style="max-width: 1400px; margin-top: 80px"></div>
<!-- Page Container -->
<div class="w3-container w3-content"
	style="max-width: 1400px; margin-top: 80px">
	<style>#map
{
    position: relative !important; 
    height: 60% !important;
    width: 50% !important;
}</style>
	<div id="map"></div>
    <script>
   
      function initMap() {
		 map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 16
        });
        infoWindow = new google.maps.InfoWindow;
	var geocoder = new google.maps.Geocoder;
	var lat;
	var lng;
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
geocodeLatLng(position.coords.latitude, position.coords.longitude,geocoder, map, infoWindow);
            infoWindow.setPosition(pos);
            infoWindow.setContent('Found location');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
		 
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      
      }
 function geocodeLatLng(lat,lng,geocoder, map, infowindow) {
        var latlng = {lat: lat, lng: lng};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              map.setZoom(11);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }
    </script>
     
    </script>
  <script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDV9rJOa04UDSijwkBn-7bMPxthnCko5RM&callback=initMap">
</script>
	<!-- The Grid -->
	<div class="w3-row">
		<!-- Left Column -->
		<div class="w3-col m3">

<?php

if (! isset($_SESSION['user_name'])) {
    echo '<div class="w3-container" style="max-width: 1400px; margin-top: 80px">
	<div class="w3-panel w3-red w3-margin-top">
		<h3>Error</h3>
		<p>
			You need to be logged into facebook first.<a href=\'/index.php\'> Go
				back </a>
		</p>
	</div>
</div>';
}

?>
					 


			<!-- End Page Container -->
		</div>
		<br>
	</div>
</div>


<?php include 'footer.php'; ?>