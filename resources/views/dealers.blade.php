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
        <div class="row py-3  searchbox justify-content-center " id="div1" >
      <div class="col ">
        <div>
        <h2>Search  your  Desired  Auto  Part  Dealer  Shops</h2>
        <form method="post" action="{{route('search-dealer')}}" id="dealer">
          @csrf
        <div class="global-flex1 align-item-baseline justify-content-around">
        <select name="product" >
        <option value="" disabled selected hidden>Select Product</option>
         @foreach($product as $service)
        <option value="{{ $service->id}}">{{ $service->name }}</option>
    @endforeach
      </select>
      <select name="make" id="makeSelect" required>
        <option value="" disabled selected hidden>Select Make</option>
        @foreach($car->unique('make') as $service)
        <option value="{{ $service->make }}">{{ $service->make }}</option>
    @endforeach
      </select> 
       <select name="model" id="modelSelect" required>
        <option value="" disabled selected hidden>Select Model</option>
         
      </select>
      <select name="variant" id="variantSelect" required>
        <option value="" disabled selected hidden>Select Variant</option>
         
      </select>
      <input type="hidden" name="latitude1" id="latitude1">
       <input type="hidden" name="longitude1" id="longitude1">
      <select name="location1" required>
        <option value="" disabled selected hidden>Select Location</option>
        <option>Near By</option>
        <option>All</option>
      </select>

      <button class="maps btn btn-primary" type="submit">Search&nbsp;<i class="fa fa-search"></i></button>
      
    </div>
  </form>
  </div>
</div>
  </div>
  <div class="row mt-2 mx-2 ">
    @forelse($shop as $rec)
    <div class="col-md-3  mt-1">
      <div class="card-shop">
        <img src="{{asset($rec->image)}}" alt="profile">
        <h3>{{$rec->name}}</h3>
         
        <p class="name">Spare Part Dealer <i class="bi bi-patch-check-fill"></i></p>
         
       
        <div class="global-flex justify-content-center">
          <a href="{{route('shop_details_dealer',['id'=>$rec->id])}}"><button class="btn btn-primary ">View Details</button></a>
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
   <script type="text/javascript">
  const latitudeInput1 = document.getElementById('latitude1');
  const longitudeInput1 = document.getElementById('longitude1');
  const form = document.getElementById('dealer');

  form.addEventListener('submit', function(event) {
    const carCC1 = document.getElementsByName('product')[0].value;
    const service1 = document.getElementsByName('make')[0].value;
    const model = document.getElementsByName('model')[0].value;
    const variant = document.getElementsByName('variant')[0].value;
    const location1 = document.getElementsByName('location1')[0].value;

    if (carCC1 === '' || service1 === '' || location1 === '' || model === '' || variant === '') {
      event.preventDefault();
      alert('Please fill in all fields before submitting.');
    } else if (location1 === 'Near By') {
      event.preventDefault();
      const confirmation = confirm("This site would like to access your location. Allow?");

      if (confirmation === true) {
        navigator.geolocation.getCurrentPosition(success, error);
      } else {
        console.log("Location access denied by the user.");
      }
    }
  });

  function success(position) {
    const lat = position.coords.latitude;
    const lng = position.coords.longitude;

    latitudeInput1.value = lat;
    longitudeInput1.value = lng;

    console.log('Latitude:', latitudeInput1.value);
    form.submit();
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
</script>
<script>
  // Assuming you have the following car data passed from the server as $car variable
  var carData = {!! json_encode($car) !!};

  // Get the initial selected make
  var selectedMake = carData[0].make;

  // Populate the model select box based on the initial selected make
  populateModels(selectedMake);

  // On make selection change, populate the model select box accordingly
  document.getElementById('makeSelect').addEventListener('change', function() {
    var selectedMake = this.value;
    populateModels(selectedMake);
  });

  // On model selection change, populate the variant select box accordingly
  document.getElementById('modelSelect').addEventListener('change', function() {
    var selectedMake = document.getElementById('makeSelect').value;
    var selectedModel = this.value;
    populateVariants(selectedMake, selectedModel);
  });

  // Function to populate the model select box based on the selected make
  function populateModels(make) {
    // Clear existing options in the model select box
    var modelSelect = document.getElementById('modelSelect');
    modelSelect.innerHTML = '';

    // Iterate over the car details and find the matching models for the selected make
    var models = [];
    for (var i = 0; i < carData.length; i++) {
      if (carData[i].make === make) {
        models.push(carData[i].model);
      }
    }

    // Remove duplicates from the models array
    models = Array.from(new Set(models));

    // Populate the model select box with the unique models
    for (var j = 0; j < models.length; j++) {
      var option = document.createElement('option');
      option.value = models[j];
      option.text = models[j];
      modelSelect.appendChild(option);
    }

    // Trigger a change event to populate the variants based on the initial selected model
    modelSelect.dispatchEvent(new Event('change'));
  }

  // Function to populate the variant select box based on the selected make and model
  function populateVariants(make, model) {
    // Clear existing options in the variant select box
    var variantSelect = document.getElementById('variantSelect');
    variantSelect.innerHTML = '';

    // Iterate over the car details and find the matching variants for the selected make and model
    var variants = [];
    for (var i = 0; i < carData.length; i++) {
      if (carData[i].make === make && carData[i].model === model) {
        variants.push(carData[i].variant);
      }
    }

    // Remove duplicates from the variants array
    variants = Array.from(new Set(variants));

    // Populate the variant select box with the unique variants
    for (var j = 0; j < variants.length; j++) {
      var option = document.createElement('option');
      option.value = variants[j];
      option.text = variants[j];
      variantSelect.appendChild(option);
    }
  }
</script><script>
  // Assuming you have the following car data passed from the server as $car variable
  var carData = {!! json_encode($car) !!};

  // Get the initial selected make
  var selectedMake = carData[0].make;

  // Populate the model select box based on the initial selected make
  populateModels(selectedMake);

  // On make selection change, populate the model select box accordingly
  document.getElementById('makeSelect').addEventListener('change', function() {
    var selectedMake = this.value;
    populateModels(selectedMake);
  });

  // On model selection change, populate the variant select box accordingly
  document.getElementById('modelSelect').addEventListener('change', function() {
    var selectedMake = document.getElementById('makeSelect').value;
    var selectedModel = this.value;
    populateVariants(selectedMake, selectedModel);
  });

  // Function to populate the model select box based on the selected make
  function populateModels(make) {
    // Clear existing options in the model select box
    var modelSelect = document.getElementById('modelSelect');
    modelSelect.innerHTML = '';

    // Iterate over the car details and find the matching models for the selected make
    var models = [];
    for (var i = 0; i < carData.length; i++) {
      if (carData[i].make === make) {
        models.push(carData[i].model);
      }
    }

    // Remove duplicates from the models array
    models = Array.from(new Set(models));

    // Populate the model select box with the unique models
    for (var j = 0; j < models.length; j++) {
      var option = document.createElement('option');
      option.value = models[j];
      option.text = models[j];
      modelSelect.appendChild(option);
    }

    // Trigger a change event to populate the variants based on the initial selected model
    modelSelect.dispatchEvent(new Event('change'));
  }

  // Function to populate the variant select box based on the selected make and model
  function populateVariants(make, model) {
    // Clear existing options in the variant select box
    var variantSelect = document.getElementById('variantSelect');
    variantSelect.innerHTML = '';

    // Iterate over the car details and find the matching variants for the selected make and model
    var variants = [];
    for (var i = 0; i < carData.length; i++) {
      if (carData[i].make === make && carData[i].model === model) {
        variants.push(carData[i].variant);
      }
    }

    // Remove duplicates from the variants array
    variants = Array.from(new Set(variants));

    // Populate the variant select box with the unique variants
    for (var j = 0; j < variants.length; j++) {
      var option = document.createElement('option');
      option.value = variants[j];
      option.text = variants[j];
      variantSelect.appendChild(option);
    }
  }
</script>
</body>
</html>