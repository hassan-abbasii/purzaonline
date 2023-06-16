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
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css”/> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="{{asset('css/mechanic/shop_info.css')}}" rel="stylesheet">

    
    <title>Edit Shop</title> 
</head>
<body>
   <div class="container-fluid">
 <div>
@include('dealer.header', ['shop' => $shop])
 </div>
<div>
@include('dealer.sidebar', ['shop' => $shop])
  <div class="home">
    <div class="container-fluid">
   <div class="global-flex-col">
              <div class="d-sm-flex align-items-center justify-content-between mb-4 align-items-baseline">
                        <h1 class="h3 mb-0 text-gray-800 head1 "><i class="bi bi-shop"></i>Edit Shop Profile</h1>
                         
                    </div>
                    <p class="text-secondary ">(Edit Your Shop Details To Update Your Information)</p>
                  </div>
                  <div class="row justify-content-center">
                     <div class=" col-md-6 col-sm-6 col-lg-6 shop-info   my-md-5 my-2">
            <h1>Edit Your Shop Info <i class="bi bi-shop"></i></h1>
            <div class="d-flex justify-content-center">
                @if(Session::has('success'))
               <div id="successAlert" class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div id="failAlert" class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
            </div>
            
            <form  action="{{route('dealer-shop-update')}}" id="shopForm" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-control my-2 justify-content-between">
                <label >Edit Shop Name</label>
                <input class="w-50" type="text" name="name" placeholder="Enter Your shop name"  value="{{ $shop->name }}"></div>
                <div class="form-control my-2">
                <label>Edit Shop Image</label>
                <input class="w-50" type="file" id="imageInput" name="image" required>
                <img class="imginform" src="{{ asset($shop->image) }}"   id="previewImage">   </div>
                <div class="form-control my-2">
                <label>Edit Your Shop Location</label>
                <p>Move the Red Marker to your exact location</p>
                <button id="live_map" class="btn btn-primary btn-sm"> Get Your Live Location <i class="bi bi-geo"></i></button>
                <div id="shop_map" style="height: 150px;">
                    
                </div>
                </div>
                <div class="form-control my-2 justify-content-between">
                    <input type="hidden" name="latitude" id="latitude" value="{{$shop->latitude}}">
<input type="hidden" name="longitude" id="longitude"  value="{{$shop->longitude}}">
                <label>Choose Open Days</label> 
                 @php
    $selectedDays = unserialize($shop->days);
@endphp
                <p>You can choose multiple days</p>
                    <div class="global-flex" id="daysContainer">
               <div>Mon <input type="checkbox" name="days[]" value="Monday" {{ in_array('Monday', $selectedDays) ? 'checked' : '' }}></div> 
    &nbsp;&nbsp;<div>Tue <input type="checkbox" name="days[]" value="Tuesday" {{ in_array('Tuesday', $selectedDays) ? 'checked' : '' }}></div>
    &nbsp;&nbsp;<div>Wed <input type="checkbox" name="days[]" value="Wednesday" {{ in_array('Wednesday', $selectedDays) ? 'checked' : '' }}></div>
    &nbsp;&nbsp;<div>Thu <input type="checkbox" name="days[]" value="Thursday" {{ in_array('Thursday', $selectedDays) ? 'checked' : '' }}></div>
    &nbsp;&nbsp;<div>Fri <input type="checkbox" name="days[]" value="Friday" {{ in_array('Friday', $selectedDays) ? 'checked' : '' }}></div>
    &nbsp;&nbsp;<div>Sat <input type="checkbox" name="days[]" value="Saturday" {{ in_array('Saturday', $selectedDays) ? 'checked' : '' }}></div>
    &nbsp;&nbsp;<div>Sun <input type="checkbox" name="days[]" value="Sunday" {{ in_array('Sunday', $selectedDays) ? 'checked' : '' }}></div>
            </div></div>
                <div class="form-control my-2"><label>Select Opening Time</label>
                    <input type="time" id="openingTime" name="open" required value="{{$shop->openTime}}">
               </div>
                <div class="form-control my-2"><label>Select Closing Time</label>
                    <input class="" id="closingTime" type="time" name="close" required value="{{$shop->closeTime}}">
                </div>
                
                
                <button class="btn btn-primary" style="float: right;">Update</button>
            </form>
            <div id="errorContainer" style="color: red; "></div>
        </div>
                  </div>
</div>
</div>
 
  <!-- Bootstrap JavaScript -->
 </div>

 <script src="{{ asset('js/alert.js') }}"></script>
<script src="{{ asset('js/mechanic/shop.js') }}"></script>
<script src="{{ asset('js/mechanic/editMap.js') }}"></script>
   <!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6n3NfBs_1T2W1weU6fbm_SulGiBweJnI&callback=initMap" >
// Initialize and add the map
/*
var map=L.map('mapview').setView([33.738045, 73.084488], 23);
    var countries=L.geoJson(country).addTo(map);
    map.fitBounds(countries.getBounds());
    */
</script>
<script type="text/javascript">
  const imageInput = document.getElementById('imageInput');
const previewImage = document.getElementById('previewImage');

imageInput.addEventListener('change', function(event) {
  const file = event.target.files[0];
  const reader = new FileReader();

  reader.onload = function(e) {
    previewImage.src = e.target.result;
  };

  reader.readAsDataURL(file);
});
</script>
<script type="text/javascript">
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
 
</body>
</html>
