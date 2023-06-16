<!DOCTYPE html>
<html>
<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Direction</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('css/direction.css')}}">
</head>
<body>
	<div>
		@if(session()->has('loginId'))
    @include('header_session')
@else
    @include('header')
@endif
	</div>
<div class="container-fluid header-change">
	<div class="container-fluid direction"  >
		<div id="mapview" class="mapid" data-latitude="{{ $shop->latitude }}" data-longitude="{{ $shop->longitude }}"></div>
		<div class="global-flex justify-content-center">
			<div class=" direction1">
				<h2 class=" my-2">Navigating Towards {{$shop->name}} <i class="bi bi-shop"></i></h2>
				<div class="d-flex justify-content-center">
				<button class="btn btn-sm btn-primary" id="getLiveLocation">Get Live Location <i class="bi bi-geo-alt"></i></button>
<button class="btn btn-sm btn-primary mx-2 global-flex align-items-baseline" id="startNavigation">Start <i class="material-icons">directions_car</i></button>
			</div>
			<h3 class="mt-2">You Can Drag The Red Marker To Set Starting Point</h3>
			</div>
			
		</div> 
		</div> 
	  
	 
</div>
 <script>
        var start = { lat: {{$shop->latitude}}, lng: {{$shop->longitude}} };
        var end = { lat: {{$shop->latitude}}, lng: {{$shop->longitude}} };
        var marker;
        var directionsService;
        var directionsRenderer;

        function initMap() {
            var options = {
                zoom: 15,
                center: start,
                mapTypeControl: true,
            };

            var map = new google.maps.Map(document.getElementById('mapview'), options);

            marker = new google.maps.Marker({
                position: start,
                map: map,
                draggable: true,
            });

            google.maps.event.addListener(marker, 'dragend', function() {
                var newLocation = marker.getPosition();
                map.panTo(newLocation);
                console.log('Marker moved to: ' + newLocation.lat() + ', ' + newLocation.lng());
            });

            google.maps.event.addListener(map, 'click', function(event) {
                marker.setPosition(event.latLng);
            });

            document.getElementById('getLiveLocation').addEventListener('click', function(event) {
                event.preventDefault();
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var lat = position.coords.latitude;
                        var lng = position.coords.longitude;

                        // Update the map's center and marker position
                        map.setCenter({ lat: lat, lng: lng });
                        marker.setPosition({ lat: lat, lng: lng });
                        map.panTo({ lat: lat, lng: lng });
                    }, function(error) {
                        console.log('Error getting current location:', error);
                    });
                } else {
                    console.log('Geolocation is not supported by this browser.');
                }
            });

            document.getElementById('startNavigation').addEventListener('click', function(event) {
                event.preventDefault();
                calculateAndDisplayRoute(directionsService, directionsRenderer);
            });

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);
        }

        function calculateAndDisplayRoute(directionsService, directionsRenderer) {
            directionsService.route(
                {
                    origin: marker.getPosition(),
                    destination: end,
                    travelMode: google.maps.TravelMode.DRIVING,
                },
                function(response, status) {
                    if (status === 'OK') {
                        directionsRenderer.setDirections(response);
                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                }
            );
        }
    </script>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6n3NfBs_1T2W1weU6fbm_SulGiBweJnI&callback=initMap" >
// Initialize and add the map
/*
var map=L.map('mapview').setView([33.738045, 73.084488], 23);
	var countries=L.geoJson(country).addTo(map);
	map.fitBounds(countries.getBounds());
	*/
</script>
</body>
</html>