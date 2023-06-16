<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<title>Homepage</title>
	<link rel="stylesheet" type="text/css" href="(asset('css/bootstrap/css/bootstrap.css')">

	<link rel="stylesheet" type="text/css" href="{{asset('css/homepage.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <!-- Google Fonts -->
 
 

  <link href="{{asset('css/main.css')}}" rel="stylesheet">


</head>
<body>
	<div>
@if(session()->has('loginId'))
    @include('header_session')
@else
    @include('header')
@endif
</div>
 
<div class="container-fluid header-change "  >
	

	<div class="container ">
		 
</div>

<div class="container-fluid  ">
	<div class="w-50">
	<div class="row mt-5 d-flex justify-content-center top-row  ">
			<label class="s1"></label>
			<div class="d-flex w-50 justify-content-center">
				 @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
           </div>
       </div>
		<div class="col global-flex w-50 justify-content-center d-flex flex-row nowrap">
		<div class="form-group w-50 align-item-baseline global-flex">
        <input type="radio" name="search" class="w-25 "  onclick="showDiv('div2')" checked><label>Mechanic</label>
      
    </div>
			<div class="form-group w-50 align-item-baseline ">
			
			<input type="radio" name="search" class="w-25  "  onclick="showDiv('div1')" >	<label>Dealer</label>
		</div>
			
		
		</div>
		
	</div>
</div>
	<div class="row py-3  searchbox justify-content-center " id="div1" style="display: none;">
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
	<div class="row map mt-0">
		 
		

<div class="col map1" id="mapview">
	
</div>
	</div>
</div>
<br><br>
<br><br><br><br><br><br>
<!-- Services section-->
 <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container">

        <div class="row ">

          <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up">
            <div class="icon flex-shrink-0"><i class="fa-solid fa-person-dots-from-line"></i></div>
            <div>
              <h4 class="title">Spare Part Dealers</h4>
              <p class="description">Find a dealer from list and confirm product availability by either sending a query or reserving the product.</p>
              <a href="{{route('homepage-dealer')}}" class="readmore stretched-link"><span>View All</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <!-- End Service Item -->

          <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="icon flex-shrink-0"><i class="fa-solid fa-cart-shopping"></i></div>
            <div>
              <h4 class="title">Products</h4>
              <p class="description">Find your car parts from the list, get them reserved online or send query to dealers for product availability. </p>
              <a href="products.php" class="readmore stretched-link"><span>View All</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="icon flex-shrink-0"><i class="fa-solid fa-person"></i></div>
            <div>
              <h4 class="title">Mechanics</h4>
              <p class="description">Find the best mechanic in your area and book appointment online from available slots according to your car service.</p>
              <a href="{{route('homepage-mechanic')}}" class="readmore stretched-link"><span>View All</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>
    </section><!-- End Featured Services Section -->


<br><br><br><br><br><br>
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about pt-0">
      <div class="container" data-aos="fade-up">

        <div class="row ">
          <div class="col-lg-6 position-relative align-self-start order-lg-last order-first">
            <img src="images/riphah.jpg" class="img-fluid" alt="">
            
          </div>
          <div class="col-lg-6 content order-last  order-lg-first">
            <h3>About Us</h3>
            <p>
              Purza Online connects car-owner, spare part dealer and mechanics on one platform where they can connect with each other to fulfill their needs.
            </p>
            <ul>
              <li data-aos="fade-up" data-aos-delay="100">
                <i class="bi bi-diagram-3"></i>
                <div>
                  <h5>Search Part Categorically</h5>
                  <p style="color: black;">Search the desired part for your car by selecting the categories and get it from your desired location.</p>
                </div>
              </li>
              <li data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-person"></i>
                <div>
                  <h5>Book Mechanic Online</h5>
                  <p style="color: black;">Get mechanic appointment online by searchning it according to your car and service.</p>
                </div>
              </li>
              <li data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-broadcast"></i>
                <div>
                  <h5>Register Shops</h5>
                  <p style="color: black;">Register your shop as a mechanic or spare part dealer and get connected with more customers.</p>
                </div>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->
<!-- Services section-->
<br><br><br><br>
<!-- ======= Services Section ======= -->
    <section id="service" class="services pt-0">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <span>Our Services</span>
          <h2>Our Services</h2>

        </div>

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
              <div class="card-img">
                <img src="images/car-owner.webp" alt="" class="img-fluid">
              </div>
              <h3 class="stretched-link">Car Owner</h3>
              <p>Register Now as a car-owner and maintain your car profiles, book mechanic appointments online and get your desired product reserved or send query to the dealer for confirmation of product.</p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="card">
              <div class="card-img">
                <img src="images/dealer1.jpg" alt="" class="img-fluid">
              </div>
              <h3 class="stretched-link">Spare-part Dealer</h3>
              <p>Register Now as a spare part dealer and get more customers from purza online. You can either manage your shop here and get connected with more customers.</p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="card">
              <div class="card-img">
                <img src="images/mechanic1.jpg" alt="" class="img-fluid">
              </div>
              <h3 class="stretched-link">Mechanics</h3>
              <p>Register Now as a mechanic and cash your services by getting online appointments. Manage your time slots according to your choice. Manage your services.</p>
            </div>
          </div><!-- End Card Item -->
 

        </div>

      </div>
    </section><!-- End Services Section -->
	<br>
	<div> 
	<div style="padding: none; " class="p-0 m-0 ml-0 mb-0">
	
@include('footer')
	 
</div>
</div>
</div>

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

 
 
<script type="text/javascript">
	function showDiv(divId) {
  const div1 = document.getElementById('div1');
  const div2 = document.getElementById('div2');
  
  if (divId === 'div2') {
     div1.style.display = 'none';
    div2.style.display = 'block';
  } else {
    div1.style.display = 'block';
    div2.style.display = 'none';
   
  }
}
</script>
<script>
  // Assuming the 'shops' variable is passed from the controller using compact
  const shops = {!! json_encode($shop) !!};
</script>
<script src="https://kit.fontawesome.com/ad31ba8bf1.js" crossorigin="anonymous"></script>
<script  >
	function initMap() {
  const start = { lat: 33.627214, lng: 72.972060 };
  const end = { lat: 33.665359, lng: 73.059715 };

  const mapOptions = {
    zoom: 10,
    center: { lat: 33.619314, lng: 72.982060 },
    mapTypeControl: true,
  };

   const map = new google.maps.Map(document.getElementById('mapview'), mapOptions);
  // Loop through the shop objects and place markers on the map
 for (const shop of shops) {
  const { latitude, longitude, name } = shop;

  const marker = new google.maps.Marker({
    position: { lat: latitude, lng: longitude },
    map: map,
    title: name,
    label: {
      text: name,
      color: 'black',
      fontSize: '12px',
      fontWeight: 'bold',
    },
    icon: {
      path: google.maps.SymbolPath.STAR,
      fillColor: 'red',
      fillOpacity: 1,
      strokeWeight: 0,
      scale: 15,
    },
  });
}



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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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



<script src="{{ asset('js/alert.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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