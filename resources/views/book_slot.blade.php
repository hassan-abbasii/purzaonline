<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<title>Book Appointment</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('css/mechanic_appointment.css')}}">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="{{asset('css/mechanic_appointment.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/mechanic/dashboard.css')}}">

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
					 <div class="col-md-6 mt-2 mx-2">
  <div class="car-form">
   
  <h2>Book From Free Slots Available</h2>
  <div class="aboutdiv-heading-border4"></div>
  <form method="post" action="{{route('bookslot',['id' => $shop->id])}}" id="input-form">
  

               @csrf
    @error('hour')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
   <input type="hidden" name="mechanic" value="{{$mechanicid}}">
   <input type="hidden" name="date" value="{{$date}}">
  <input type="hidden" name="slot" value="{{$bookSlot}}">
  <input type="hidden" name="ser" value="{{$mec_id}}">
  <input type="hidden" name="cc" value="{{$ccid}}">
  <p class="text-secondary text-center">Select The Available Slot To Confirm Appointment</p>
  <p class="text-secondary text-center fw-bold">Date: {{ $date}}</p>
  <p class="text-secondary text-center">Service Price: {{$mechanicSlot->price}}</p>
  <p class="text-secondary text-center">Service Time(Select Accordingly To Avoid Inconvenience): {{$mechanicSlot->hour*30}} Minutes</p>
  <div class="aboutdiv-heading-border4"></div>
  @foreach ($timeSlots as $timeSlot)
       <div class="form-check d-flex align-items-center ">
    <input class="form-check-input form-check-input-lg" type="checkbox" id="timeSlot{{ $loop->index }}" value="{{ $timeSlot }}">
    <label class="form-check-label ms-5" for="timeSlot{{ $loop->index }}">
        {{ $timeSlot }}
    </label>
</div>
    @endforeach
   
<br>
<input type="hidden" name="selectedSlots" id="selectedSlotsInput">
<div class="aboutdiv-heading-border4"></div>
 
  <div class="global-flex1 justify-content-end">
    <div class="  mt-3"></div>
    <button class="btn btn-outline-primary " type="Submit" id="submit-btn">Book Appointment</button>
  </div>
</form>

<div id="error-message" style="color: red; display: none;"></div>
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
 
<script type="text/javascript">
   // Get the submit button and add a click event listener
// Get the submit button and add a click event listener
// Get all the checkboxes
// Get the submit button
const submitBtn = document.getElementById('submit-btn');
const checkboxes = document.querySelectorAll('input[type="checkbox"]');
const selectedSlotsInput = document.getElementById('selectedSlotsInput');

// Add event listener to checkboxes
checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        // Disable other checkboxes and uncheck them
        checkboxes.forEach(function(otherCheckbox) {
            if (otherCheckbox !== checkbox) {
                otherCheckbox.disabled = checkbox.checked;
                otherCheckbox.checked = false;
            }
        });

        // Set the value of selectedSlotsInput
        const selectedSlots = getSelectedCheckboxes().map(function(selectedCheckbox) {
            return selectedCheckbox.value;
        });
        selectedSlotsInput.value = selectedSlots.join(',');

        // Enable the submit button if at least one checkbox is checked
        submitBtn.disabled = (selectedSlots.length === 0);
    });
});

// Add event listener to submit button
submitBtn.addEventListener('click', function(event) {
    // Prevent form submission if no checkbox is checked
    if (getSelectedCheckboxes().length === 0) {
        event.preventDefault();
        alert('Please select a time slot.');
    }
});

// Function to get selected checkboxes
function getSelectedCheckboxes() {
    return Array.from(checkboxes).filter(function(checkbox) {
        return checkbox.checked;
    });
}



</script>	 
</body>
</html>