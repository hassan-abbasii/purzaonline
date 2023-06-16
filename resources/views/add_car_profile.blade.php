 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
   

    <!----======== CSS ======== -->
 
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    
     
 
 <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">

    
    <title>Car Profile</title> 
</head>
<body>
   
 <div>

  @if(session()->has('loginId'))
    @include('header_session')
@else
    @include('header')
@endif
 </div>
<div>
@include('sidebar')
  <div class="home ">
 <div class="container-fluid">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="global-flex-new1">
                        <h1 class="h3 mb-0 text-gray-800 head1"><i class="bi bi-person-fill-gear"></i> Add New Car Profile </h1>
                         <p style="color: #adb5bd;">(Provide Relevant Details To Add New)</p>
                       </div>
                       <div>
                        <a href="{{route('carprofile')}}" class=" d-sm-inline-block btn mt-2 btn-primary shadow-sm"><i
                                class="bi bi-person-fill-gear"></i> View All Record </a>
</div>
        
                    </div>
<div class="aboutdiv-heading-border4"></div>

                    <div class="row justify-content-center">
<div class="col-md-4 mt-2 mx-2">
  <div class="car-form">
   
  <h2>Add New Record</h2>
  <div class="aboutdiv-heading-border4"></div>
  <form method="post" action="{{ route('add-carprofile')}}" id="input-form">
     @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
   @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif

               @csrf
   
  <div class="form-group">
    <label>Select Date</label>
    <input type="date" name="date1"    class="form-control w-75" id="alphabetInput" required > 
  </div>
  <div class="form-group">
    <label>Select Service</label>
    <select name="service_id" class="form-control w-75">
    @foreach($services as $car)
        <option value="{{ $car->id }}">{{ $car->name }}</option>
    @endforeach
</select>
  </div>
  <div class="form-group">
    <label>Enter Current Mileage</label>
    <input type="number" name="mileage" id="mileage"   class="form-control w-75" id="alphabetInput" required > 
  </div>
  <div class="form-group">
    <label>Enter Service Cost</label>
    <input type="number" name="cost" id="cost"   class="form-control w-75" id="alphabetInput" required > 
  </div>
  <div class="form-group">
    <label>Select Date</label>
    <input type="date" name="date2"   class="form-control w-75" id="date2" required > 
  </div>

   
  
  <div class="global-flex1 justify-content-end mt-5">
    <div class="  mt-2"></div>
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
 <script src="{{asset('js/admin/form0.js')}}"></script>
<script>
function restrictInput(event) {
  let input = event.target;
  input.value = input.value.replace(/[^A-Za-z]/g, '');
}
</script>
<script>
  // Get the current date
  var today = new Date().toISOString().split("T")[0];

  // Get the date input element
  var dateInput = document.getElementById("date2");

  // Set the min attribute of the date input to today's date
  dateInput.min = today;
</script>

<script>
  // Get the mileage and cost input elements
  var mileageInput = document.getElementById("mileage");
  var costInput = document.getElementById("cost");

  // Add an event listener for input change on mileage field
  mileageInput.addEventListener("input", function() {
    var value = this.value;

    // Check if value is not a positive number
    if (!(/^\d*\.?\d+$/.test(value) && parseFloat(value) > 0)) {
      // Clear the input value
      this.value = "";
      // Show an alert
      alert("Please enter a valid positive number for mileage.");
    }
  });

  // Add an event listener for input change on cost field
  costInput.addEventListener("input", function() {
    var value = this.value;

    // Check if value is not a positive number
    if (!(/^\d*\.?\d+$/.test(value) && parseFloat(value) > 0)) {
      // Clear the input value
      this.value = "";
      // Show an alert
      alert("Please enter a valid positive number for cost.");
    }
  });
</script>

</body>
</html>
