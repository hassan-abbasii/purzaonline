<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<title>Mechanic Appointment</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('css/mechanic_detail.css')}}">
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
			<div class="row mt-1">
				<div class="col">
					<div class="browse-top1 ">
				<div class="global-flex">
				<img src="{{asset($shop->image)}}" alt="store">
				<div class="global-flex align-items-baseline">
				<h2>{{ $shop->name}}</h2>
				 
				<p class="pm">Spare Part Dealer <i class="bi bi-patch-check-fill"></i></p>
				<p>{{$averageRating}}&nbsp; @php
    $rating = intval($averageRating);
@endphp

@for ($i = 1; $i <= 5; $i++)
    @if ($i <= $rating)
        <i class="fa fa-star" style="color: gold;"></i>
    @else
        <i class="fa fa-star" style="color: grey;"></i>
    @endif
@endfor&nbsp;({{$reviewCount}})</p>
			</div>
 
			</div>

			</div>
		</div>
				</div>
				<div class="row mechanic_detail justify-content-center">
					<div class="d-flex w-75 justify-content-center"> @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif</div>
					<div class="col-md-4 mt-2" id="" >
             <div class="send-border">
            <div class="send-query">
                <img src="{{asset('images/query.png')}}" alt="picture">
                <h2>Sending Query For Product Availability</h2>
                <p class="p1"><i class="bi bi-info-circle"></i> Below only those products will be shown, this dealer deals in.</p>
                <div>
                    <form action="{{route('send-query',['id' => $shop->id])}}" method="post" >
                        @csrf
                        <div class="form-group">
                            <label>Select Product</label>
                           <select name="product" class="form-control w-100" required>
                <option value="" disabled selected hidden>Select Product</option>
                 @foreach($product as $service)
        <option value="{{ $service->id}}">{{ $service->name }}</option>
    @endforeach
            </select>
                        </div><br>
                        <div class="form-group">
                            <label>Select Make</label>
                            <select name="make" id="makeSelect" class="form-control w-100" required>
                <option value="" disabled selected hidden>Select Make</option>
                @foreach($car->unique('make') as $service)
        <option value="{{ $service->make }}">{{ $service->make }}</option>
    @endforeach
            </select>
                        </div><br>
                        <div class="form-group    ">
                            <label>Select Model</label>
                            <select class="form-control w-100" name="model" id="modelSelect" required>
                <option value="" disabled selected hidden>Select Model</option>
                 
            </select>
            
                        </div><br>
                        <div class="form-group">
                            <label>Select Variant</label>
                           <select class="form-control w-100" name="variant" id="variantSelect" required>
                <option value="" disabled selected hidden>Select Variant</option>
                 
            </select>
                        </div><br>
                        <div class="form-group">
                            <label>Short Description</label>
                            <textarea name="description" placeholder="(Optional)" class="form-control w-100" maxlength="50" >
                                
                            </textarea>
                            <div class="d-flex justify-content-end" ><p>(Maximum 0/50)</p></div>
                            
                        </div><br>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-lg btn-primary w-75">Send Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
				</div>
				<br>
				<div>
				@include('footer')
			</div>
			</div>
			
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