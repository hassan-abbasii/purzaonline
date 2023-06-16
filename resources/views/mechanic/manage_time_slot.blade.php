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

    
    <title>Manage Slots</title> 
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
                        <h1 class="h3 mb-0 text-gray-800 head1"><i class="bi bi-clock-history"></i>Manage Slots</h1>
                         <p style="color: #adb5bd;">(Manage Your Available Slots against Current Date)</p>
                       </div>
                       <div>
                        <a href="{{route('timeslot',['id' => $mechanic])}}" class=" d-sm-inline-block btn mt-2 btn-primary shadow-sm"><i
                                class="bi bi-clock-history"></i> View All Record</a>
</div>
        
                    </div>
<div class="aboutdiv-heading-border4"></div>

                    <div class="row justify-content-center">
<div class="col-md-6 mt-2 mx-2">
  <div class="car-form">
   
  <h2>Manage Your Free Slots</h2>
  <div class="aboutdiv-heading-border4"></div>
  <form method="post" action="{{route('slotupdate', ['id' => $mechanic])}}" id="input-form">
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
   
  
  <p class="text-secondary text-center">You can mark a slot to make it busy for customers</p>
  <p class="text-secondary text-center fw-bold">Date: {{ $currentDate}}</p>
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
    <button class="btn btn-outline-primary " type="Submit" id="submit-btn">Mark Busy</button>
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
