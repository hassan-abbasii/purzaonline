<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <title>All Products</title>
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  
    <link rel="stylesheet" type="text/css" href="{{asset('css/products.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
<style type="text/css">
  select{
    background-color: #e5e5e5;
    width: 80%;
    height: 40px;
    border-radius: 20px;
}
</style>

</head>
<body>
    <div>
      @if(session()->has('loginId'))
    @include('header_session')
@else
    @include('header')
@endif
    </div>  
    <div class="container-fluid header-change"   >
  <div class="row">
  <div class="col my-2">
    <div class="product-query">
      <p>Find your car part below, if you don't find. Try to search dealers that are not managing inventory may you find and get product availability confirmed.</p>
      <div class="d-flex justify-content-center"><a href="{{route('homepage-dealer')}}"><button class="btn  btn-primary">Dealers <i class="bi bi-cart-fill"></i></button></a></div>
       <div class="global-flex-new justify-content-center w-50">
     
     @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
  </div>
    </div>
  </div>
  
  </div>
  <div class="container">
  <div class="row">
    <div class="col search-part">
    <h2>Search your Desired Auto Part</h2>
       
          <form action="{{route('allproductsearch')}}" method="post">
 <div class="new-flexx align-items-baseline justify-content-around">
            @csrf
        <select name="product" required="" class="mx-2">
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
       <select name="model" id="modelSelect" required class="mx-2">
        <option value="" disabled selected hidden>Select Model</option>
         
      </select>
      <select name="variant" id="variantSelect" required>
        <option value="" disabled selected hidden>Select Variant</option>
         
      </select>
       

      <button class=" btn btn-primary mx-2 " type="submit" >Search&nbsp;<i class="b"></i></button>
      </div>
      </form>
    
    </div>
  </div>
   
  </div>

<div class="row mt-2 mx-2 ">
@forelse($record as $part)
  <div class="col-md-2 col-sm-2   mt-1">
    <div class="product-card">
      <img src="{{asset($part->image)}}" alt="product">
      <h6>{{$part->name}}</h6>
      <h5>Rs. {{$part->sellingPrice}}</h5>
      <div class="global-flex justify-content-around">
      <p class="p2">{{$part->brand}}</p>
      <p class="p2">{{$part->condition}}</p>
    </div>
      <div class="aboutdiv-heading-border4"></div>

      <a href="{{route('productdetailhomepage',['id'=>$part->id])}}"><div class="d-flex justify-content-center"><button class="btn btn-sm btn-outline-primary">View Detail</button></div></a>
    </div>
  </div>
  @empty
  <div>
    No Products To Show
    @endforelse
  </div>
   
    
  <div class="mt-5">
  @include('footer')
</div>
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