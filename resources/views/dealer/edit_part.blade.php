<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-ZVZl6Fpdn8VaxWkHv2rV9X6+u/Q8fBH5hzkmvE3qgCYN5Q5vdTwgvWxLhJCLp9XmRFGy5hW+d73Jupkq3C1Z3Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!----======== CSS ======== -->
 
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" /> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="{{asset('css/admin/dashboard.css')}}" rel="stylesheet">

    
    <title>Add Spare Part</title> 
</head>
<body>
   
 <div>
@include('dealer.header', ['shop' => $shop])
 </div>
<div>
@include('dealer.sidebar', ['shop' => $shop])
  <div class="home ">
 <div class="container-fluid">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="global-flex-new1">
                        <h1 class="h3 mb-0 text-gray-800 head1"><i class="bi bi-tools"></i> Edit Spare Part</h1>
                         <p style="color: #adb5bd;">(This is general detail you select to add a category of your shop you deal in.)</p>
                       </div>
                       <div>
                        <a href="{{route('allspareparts')}}" class=" d-sm-inline-block btn mt-2 btn-primary shadow-sm"><i
                                class="bi bi-tools"></i> View All Parts</a>
</div>
        
                    </div>
<div class="aboutdiv-heading-border4"></div>

                    <div class="row justify-content-center">
<div class="col-md-4 mt-2 mx-2">
  <div class="car-form">
   
  <h2>Edit Spare Part</h2>
  <div class="aboutdiv-heading-border4"></div>
  <form method="post" action="{{route('update-sparepart',['id' => $product1->id])}}" id="input-form">
   @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif

               @csrf
               @method('PUT')
    @error('part')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
   
  
<div class="form-group">
    <label>Select Spare Part</label>
     <select name="product" id="name" class="form-control w-75">
    @foreach($product as $service)
         <option value="{{ $service->id }}" {{ $service->id == $product1->products->id ? 'selected' : '' }}>
                {{ $service->name }}
            </option>
    @endforeach
</select>
  </div>
  <div class="form-group">
    <label>Edit Car Make</label>
     <select name="make" id="makeSelect" class="form-control w-75">
    @foreach($car as $service)
         <option value="{{ $service->make }}" {{ $service->make == $product1->car->make ? 'selected' : '' }}>
                {{ $service->make }}
            </option>
    @endforeach
</select>
  </div>
  <div class="form-group">
    <label>Edit Car Model</label>
     <select id="modelSelect" name="model" class="form-control w-75">
  <!-- Options for model select box will be dynamically populated -->
</select>
  </div>
  <div class="form-group">
    <label>Edit Car Variant</label>
  <select id="variantSelect" name="variant" class="form-control w-75">
  <!-- Options for variant select box will be dynamically populated -->
</select>
  </div>
   
<br>
<div class="aboutdiv-heading-border4"></div>
 
  <div class="global-flex1 justify-content-end">
    <div class="  mt-3"></div>
    <button class="btn btn-primary " type="Submit">Submit</button>
  </div>
</form>

<div id="error-message" style="color: red; display: none;"></div>
</div>
                    </div>
         </div>


         </div>
</div>
</div>

 <script src="{{ asset('js/admin/find.js') }}"></script>
 <!-- Include custom JavaScript file -->
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
