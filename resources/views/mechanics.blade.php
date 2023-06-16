<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <title>Mechanic Appointment</title>
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('css/mechanic_detail.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/mechanics.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('css/homepage.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/products.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/mechanic_appointment.css')}}">


</head>
<body>
    <div>
      @if(session()->has('loginId'))
    @include('header_session')
@else
    @include('header')
@endif
    </div>  
    <div class="container-fluid browse">
       <div class="row py-3  searchbox justify-content-center " id="div2" style="display: block;">
      <div class="col ">
        <div>
        <h2>Search  your  Desired  Auto  Mechanic  Shops</h2>
        
        <div class="d-flex row align-item-baseline justify-content-center">
          <form method="post" action="{{route('search-mechanic')}}" id="mech">
          
          @csrf
        <select name="car_cc" required class="">
        <option value="" disabled selected hidden>Select Car</option>
        @foreach($cc as $option)
        <option value="{{ $option->id }}">{{ $option->name }}</option>
    @endforeach
      </select>
      <select name="service" id="service" required>
    <option value="" disabled selected hidden>Select Service</option>
    @foreach($mec->unique('service') as $item)
        <option value="{{ $item->service }}">{{ $item->service }}</option>
    @endforeach
</select>

<select name="service_category" id="service_category" disabled required>
    <option value="" disabled selected hidden>Service Category</option>
</select>
       <input type="hidden" name="latitude" id="latitude">
       <input type="hidden" name="longitude" id="longitude">
      <select name="location2" required>
        <option value="" disabled selected hidden>Select Location</option>
        <option>Near By</option>
        <option>All</option>
      </select>

      <button type="submit" class="maps mapsmm btn btn-primary" >Search&nbsp;<i class="fa fa-search"></i></button>
      </form>
    </div>
  
  </div>
</div>
  </div>
  <div class="row mt-2 mx-2 ">
    @forelse($shop as $rec)
    <div class="col-md-3  mt-1">
      <div class="card-shop">
        <img src="{{asset($rec->image)}}" alt="profile">
        <h3>{{$rec->name}}</h3>
         
        <p class="name">Mechanic <i class="bi bi-patch-check-fill"></i></p>
         
       
        <div class="global-flex justify-content-center">
          <a href="{{route('shop_details',['id'=>$rec->id])}}"><button class="btn btn-primary ">View Details</button></a>
        </div>
      </div>
    </div>
    @empty
    <div>Yet No Mechanics Registered</div>
    @endforelse
  </div>
         
        <br>
        <div>
        @include('footer')
      </div>
      </div>
      
  <script src="{{ asset('js/alert.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
  <script type="text/javascript" >
  const latitudeInput = document.getElementById('latitude');
  const longitudeInput = document.getElementById('longitude');
// Get the form element
document.getElementById('mech').addEventListener('submit', function(event) {
  var carCC = document.getElementsByName('car_cc')[0].value;
  var service = document.getElementsByName('service')[0].value;
  var location2 = document.getElementsByName('location2')[0].value;

  if (carCC === '' || service === '' || location2 === '') {
    event.preventDefault(); // Prevent form submission if any field is empty
    alert('Please fill in all fields before submitting.');
  } else if (location2 === 'Near By') {
    event.preventDefault(); // Prevent form submission to modify the "location2" field

    //start
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

         
 
        // Set the latitude and longitude values in the hidden input fields
        latitudeInput.value = lat1;
        longitudeInput.value = lng1;
        console.log('Latitude:', latitudeInput.value);
        document.getElementById('mech').submit();
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
    //end
  }
});

</script>
<script>
    $(document).ready(function() {
        $('#service').change(function() {
            var selectedService = $(this).val();
            var serviceCategories = {!! json_encode($mec->groupBy('service')->toArray(), JSON_HEX_TAG) !!};
            var categories = serviceCategories[selectedService];

            $('#service_category').empty();

            if (categories && categories.length > 0) {
                $('#service_category').prop('disabled', false);

                $.each(categories, function(index, category) {
                    $('#service_category').append($('<option>', {
                        value: category.service_category,
                        text: category.service_category
                    }));
                });
            } else {
                $('#service_category').prop('disabled', true);
                $('#service_category').append($('<option>', {
                    disabled: true,
                    selected: true,
                    hidden: true,
                    text: 'No categories available'
                }));
            }
        });
    });
</script>
</body>
</html>