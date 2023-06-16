<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{asset('css/mechanic/shop_info.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css”/>	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    
    <title>Add Shop Info</title>
    
</head>
<body>
<div class="container-fluid main-c "  >
    <div class="container">
        <div class="row justify-content-center">
            <div class=" col-md-8 col-sm-8 col-lg-8 shop-info   my-md-5 my-2">
            <h1>Add Your Shop Info <i class="bi bi-shop"></i></h1>
            <div class="d-flex justify-content-center">
                @if(Session::has('success'))
               <div id="successAlert" class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div id="failAlert" class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
            </div>
            <p style="color: grey; text-align: center;">Please Provide All Details to Get Started Your Business</p>
            <form  action="add-shop-info-dealer" id="shopForm"  method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-control my-2 justify-content-between">
                <label >Enter Shop Name</label>
                <input class="w-50" type="text" name="name" placeholder="Enter Your shop name" ></div>
                <div class="form-control my-2">
                <label>Add Shop Image</label>
                <input class="w-50" type="file" name="image" required></div>
                <div class="form-control my-2">
                <label>Select Your Shop Location</label>
                <p>Move the Red Marker to your exact location</p>
                <button id="live_map" class="btn btn-primary btn-sm"> Get Your Live Location <i class="bi bi-geo"></i></button>
                <div id="shop_map" style="height: 150px;">
                    
                </div>
                </div>
                <div class="form-control my-2 justify-content-between">
                    <input type="hidden" name="latitude" id="latitude" value="">
<input type="hidden" name="longitude" id="longitude"  value="">
                <label>Choose Open Days</label> 
                 
                <p>You can choose multiple days</p>
                    <div class="global-flex" id="daysContainer">
                <div >Mon <input  type="checkbox" name="days[]" value="Monday" checked></div> &nbsp;&nbsp;<div> Tue <input type="checkbox" name="days[]" value="Tuesday"></div>&nbsp;&nbsp;<div> Wed <input type="checkbox" name="days[]" value="Wednesday"></div>&nbsp;&nbsp;<div> Thu <input type="checkbox" name="days[]" value="Thursday"></div>&nbsp;&nbsp;<div> Fri <input type="checkbox" name="days[]" value="Friday"></div>&nbsp;&nbsp;<div> Sat <input type="checkbox" name="days[]" value="Saturday"></div>&nbsp;&nbsp;<div> Sun <input type="checkbox" name="days[]" value="Sunday"></div>
            </div></div>
                <div class="form-control my-2"><label>Select Opening Time</label>
                    <input type="time" id="openingTime" name="open" required>
               </div>
                <div class="form-control my-2"><label>Select Closing Time</label>
                    <input class="" type="time" id="closingTime" name="close" required>
                </div>
                
                
                <button class="btn btn-primary" style="float: right;">Submit</button>
            </form>
            <div id="errorContainer" style="color: red; "></div>
        </div>
    </div>
    </div>
</div>
<script src="{{ asset('js/alert.js') }}"></script>
<script src="{{ asset('js/mechanic/shop.js') }}"></script>
   <!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="{{ asset('js/mechanic/addMap.js') }}" >
   
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
<!-- Include custom JavaScript file -->
<script type="text/javascript">
    // Get the closing time input element
var openingTimeInput = document.getElementById('openingTime');
var closingTimeInput = document.getElementById('closingTime');

// Add event listener for input changes
openingTimeInput.addEventListener('input', restrictTimeSelection);
closingTimeInput.addEventListener('input', restrictTimeSelection);

// Function to restrict time selection to 00 or 30 minutes
function restrictTimeSelection(event) {
  var selectedTime = event.target.value;
  var [hours, minutes] = selectedTime.split(':');

  if (minutes !== '00' && minutes !== '30') {
    minutes = minutes < 15 ? '00' : '30';
    event.target.value = hours + ':' + minutes;
  }
}
 
</script>
<script>
  function validateForm() {
    var checkboxes = document.getElementsByName("days[]");
    var checked = false;

    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        checked = true;
        break;
      }
    }

    if (!checked) {
      alert("Please select at least one day.");
      return false;
    }

    // Form validation passed, continue with form submission
    return true;
  }
</script>

</body>
</html>
