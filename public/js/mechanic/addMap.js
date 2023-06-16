function initMap() {
  const latitudeInput = document.getElementById('latitude');
  const longitudeInput = document.getElementById('longitude');

  var start = { lat: 33.627214, lng: 72.972060 };
  var end = { lat: 33.665359, lng: 73.059715 };
latitudeInput.value =start.lat ;
    longitudeInput.value = start.lng;
  var options = {
    zoom: 15,
    center: start,
    mapTypeControl: true,
  }

  var map = new google.maps.Map(document.getElementById('shop_map'), options);

  // Add a marker at the starting location
  var marker = new google.maps.Marker({
    position: start,
    map: map,
    draggable: true
  });

  google.maps.event.addListener(marker, 'dragend', function () {
    var newLocation = marker.getPosition();
    map.panTo(newLocation);
    console.log('Marker moved to: ' + newLocation.lat() + ', ' + newLocation.lng());
     
    // Set the latitude and longitude values in the hidden input fields
  localStorage.setItem('latitude', newLocation.lat());
localStorage.setItem('longitude', newLocation.lng());
    console.log('Latitude:', latitudeInput.value);
  });

  document.getElementById('live_map').addEventListener('click', function (event) {
    event.preventDefault();

    if (navigator.geolocation) {
      // Prompt the user to allow location access
      var confirmation = confirm("This site would like to access your location. Allow?");

      if (confirmation === true) {
        // User allowed location access
        navigator.geolocation.getCurrentPosition(success, error);
      } else {
        // User denied location access
        // Handle accordingly
        console.log("Location access denied by the user.");
      }
    } else {
      console.log("Geolocation is not supported by this browser.");
    }

    function success(position) {
      // Code to handle successful retrieval of user's location
      navigator.geolocation.getCurrentPosition(function (position) {
        var lat1 = position.coords.latitude;
        var lng1 = position.coords.longitude;

        // Update the map's center and marker position
        map.setCenter({ lat: lat1, lng: lng1 });
        marker.setPosition({ lat: lat1, lng: lng1 });
        map.panTo({ lat: lat1, lng: lng1 });
 
        // Set the latitude and longitude values in the hidden input fields
        latitudeInput.value = lat1;
        longitudeInput.value = lng1;
        console.log('Latitude:', latitudeInput.value);
      });
      // For example, you can access latitude and longitude using position.coords.latitude and position.coords.longitude
    }

    function error(error) {
      switch (error.code) {
        case error.PERMISSION_DENIED:
          alert("Please enable location services to use this feature.");
          break;
        case error.POSITION_UNAVAILABLE:
          alert("Location information is unavailable.");
          break;
        case error.TIMEOUT:
          alert("The request to get user location timed out.");
          break;
        case error.UNKNOWN_ERROR:
          alert("An unknown error occurred.");
          break;
      }
    }
  });

  google.maps.event.addListener(map, 'click', function (event) {
    marker.setPosition(event.latLng);
    position = marker.getPosition();
    // Set the latitude and longitude values in the hidden input fields
    latitudeInput.value = position.lat();
    longitudeInput.value = position.lng();
    console.log('Latitude:', latitudeInput.value);
  });

  // Set the initial latitude and longitude values
   
  //console.log('Latitude:', latitudeInput.value);
}
