<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<title>Mechanic Appointment</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('css/mechanic_appointment.css')}}">
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
				 
				<p class="pm">Mechanic <i class="bi bi-patch-check-fill"></i></p>
				<p>(2)&nbsp;<i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i>&nbsp;4.0</p>
			</div>
 
			</div>

			</div>
		</div>
				</div>
				<div class="row justify-content-center">
					<div class="d-flex w-75 justify-content-center"> @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif</div>
					<div class="col-md-5 mechanic-appointment mt-2 mx-2 justify-content-center">
						 <form method="post" action="{{route('confirmappointment',['id' => $shop->id])}}">
						 	@csrf
							<h2> Book Appointment &nbsp;<i class="bi bi-calendar2-check"></i></h2>
							<div class="aboutdiv-heading-border4"></div>
							<label class="mt">Select Your Car Engine</label><br>
							<select name="cc_id" class="w-75 form-control">
								@foreach($carCcs as $carCc)
        <option value="{{ $carCc->id }}">{{ $carCc->name }}</option>
    @endforeach
							</select>
							<label class="mt">Select Appointment Date</label><br>
							<input type="date" class="w-75 form-control" name="date" id="date" required><br>
							<label class="mt">Select Service</label><br>
							<select name="service" id="service" class="form-control w-75">
    @foreach($mechanicServices as $mechanicService)
        <option value="{{ $mechanicService->service }}">{{ $mechanicService->service }}</option>
    @endforeach
</select>
							<br><label class="mt">Select service Type</label><br>
							<select name="service_category" id="service_category" class="form-control w-75">
    <!-- Options will be dynamically populated using JavaScript -->
</select><br>
							 
							<h2></h2>
							<p class="mt">Check Time Slots Against This And See Price! </p>
							 <br>
						<div  class="global-flex justify-content-center"><button type="submit" class="btn btn-primary">Check Time Slots</button> </div>
</form>
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
    $(document).ready(function() {
        var servicesData = {!! $mechanicServices->toJson() !!};

        $('#service').on('change', function() {
            var selectedService = $(this).val();

            // Clear previous category options
            $('#service_category').empty();

            // Filter services based on the selected service
            var filteredServices = servicesData.filter(function(service) {
                return service.service === selectedService;
            });

            // Get unique categories for the selected service
            var uniqueCategories = [...new Set(filteredServices.map(function(service) {
                return service.service_category;
            }))];

            // Add category options to the select input
            $.each(uniqueCategories, function(index, category) {
                var option = $('<option></option>').val(category).text(category);
                $('#service_category').append(option);
            });
        });

        // Set the first service as the default option on page load
        var initialService = servicesData[0].service;
        $('#service').val(initialService);

        // Trigger the change event to show the relevant service categories
        $('#service').trigger('change');
    });
</script>

<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("date").setAttribute("min", today);
</script>



<script>
    var mechanicServices = @json($mechanicServices);
    var services = @json($service);

    // Function to update the price based on the selected cc_id, service name, and service_category
    function updatePrice() {
        var selectedCcId = $('#cc_id').val();
        var selectedService = $('#service').val();
        var selectedServiceCategory = $('#service_category').val();

        var matchingService = services.find(function (service) {
            return service.cc_id === selectedCcId &&
                service.service === selectedService &&
                service.service_category === selectedServiceCategory;
        });

        // Update the price element
        if (matchingService) {
            $('#price').text(matchingService.price + ' pkr');
        } else {
            $('#price').text('');
        }
    }

    // Bind the function to the change event of the select elements
    $('#cc_id, #service, #service_category').on('change', updatePrice);
</script>	 
</body>
</html>