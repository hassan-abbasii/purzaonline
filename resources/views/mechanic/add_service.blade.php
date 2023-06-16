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

    
    <title>Add Service</title> 
</head>
<body>
   
 <div>
@include('mechanic.header', ['shop' => $shop])
 </div>
<div>
@include('mechanic.sidebar', ['shop' => $shop])
  <div class="home ">
 <div class="container-fluid">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="global-flex-new1">
                        <h1 class="h3 mb-0 text-gray-800 head1"><i class="bi bi-tools"></i> Add New Service</h1>
                         <p style="color: #adb5bd;">(Enter Service Details To Add New)</p>
                       </div>
                       <div>
                        <a href="{{route('service')}}" class=" d-sm-inline-block btn mt-2 btn-primary shadow-sm"><i
                                class="bi bi-tools"></i> View All Services</a>
</div>
        
                    </div>
<div class="aboutdiv-heading-border4"></div>

                    <div class="row justify-content-center">
<div class="col-md-4 mt-2 mx-2">
  <div class="car-form">
   
  <h2>Add New Service</h2>
  <div class="aboutdiv-heading-border4"></div>
  <form method="post" action="{{route('add-service')}}" id="input-form">
   @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif

               @csrf
    @error('hour')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
  <div class="form-group">
    <label>Select Car Engine</label>
     <select name="car_cc_id" class="form-control w-75">
    @foreach($cars as $car)
        <option value="{{ $car->id }}">{{ $car->name }}</option>
    @endforeach
</select>
  </div>
  
<div class="form-group">
    <label>Select Service</label>
     <select name="name" id="name" class="form-control w-75">
    @foreach($services as $service)
        <option value="{{ $service->service }}">{{ $service->service }}</option>
    @endforeach
</select>
  </div>
  <div class="form-group">
    <label>Select Service Category</label>
     <select name="category" id="category" class="form-control w-75">
    <!-- Options will be dynamically populated based on the selected name -->
</select>
  </div>
  <div class="form-group">
    <label>Enter Service Price </label>
    <input type="number" name="price" id="price" class="form-control w-75" pattern="^[1-9][0-9]*$" required  > 
  </div>
   <div class="form-group">
    <label class="mt-2">Enter Service Slots </label>
    <p style="color: grey; font-size: 10px;">Slots are of 30 Minutes Enter Your Number Accordingly, E.g 2=1-hour</p>
    <input type="number" name="hour" id="hour" pattern="^[1-9][0-9]*$" class="form-control w-75"  required  > 
  </div>
   <div class="form-group">
    <label>Select Mechanic</label>
     <select name="mechanic" id="mechanic" class="form-control w-75">
    @foreach($mechanics as $mechanic)
        <option value="{{ $mechanic->id }}">{{ $mechanic->name }}</option>
    @endforeach
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
<script type="text/javascript">
    document.getElementById('input-form').addEventListener('submit', function(event) {
  var priceInput = document.getElementById('price');
  var hourInput = document.getElementById('hour');

  // Check if the inputs are zero or less than zero
  if (priceInput.value <= 0 || hourInput.value <= 0) {
    event.preventDefault(); // Prevent form submission
    var alertMessage = document.createElement('div');
    alertMessage.innerHTML = 'Please enter values greater than zero in Hour/Price.';
    alertMessage.classList.add('alert', 'alert-danger');
    alertMessage.style.width = '50%';
    alertMessage.style.margin = '0 auto';
    document.body.appendChild(alertMessage);

    // Remove the alert message after 2 seconds
    setTimeout(function() {
      alertMessage.remove();
    }, 3000);
  }
});

</script>
<script > 
 $(document).ready(function() {
  var servicesData = {!! $services->toJson() !!};

  $('#name').on('change', function() {
    var selectedName = $(this).val();

    // Clear previous category options
    $('#category').empty();

    // Filter services based on the selected name
    var filteredServices = servicesData.filter(service => service.service === selectedName);

    // Get unique categories for the selected name
    var uniqueCategories = [...new Set(filteredServices.map(service => service.service_category))];

    // Add category options to the select input
    $.each(uniqueCategories, function(index, category) {
      var option = $('<option></option>').val(category).text(category);

      // Store the service_category value as a data attribute
      option.attr('data-service-category', category);

      $('#category').append(option);
    });
  });

  // Set the first service and its category as the default option on page load
  var initialService = servicesData[0].service;
  var initialCategory = servicesData.find(service => service.service === initialService).service_category;
  $('#name').val(initialService);

  $.each(servicesData, function(index, service) {
    if (service.service === initialService) {
      $('#category').append($('<option></option>').val(service.service_category).text(service.service_category));
    }
  });

  // Trigger the change event to show the relevant service_category
  $('#name').trigger('change');

  // Update category name based on selected service_category
  $('#category').on('change', function() {
    var selectedCategory = $(this).val();
    var categoryName = $(this).find('option:selected').data('service-category');
    $('#category_name').val(categoryName);
  });
});

</script>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
