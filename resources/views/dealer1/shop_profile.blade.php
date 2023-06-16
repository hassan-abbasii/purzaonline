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
 <link href="{{asset('css/mechanic/mechanic_profile.css')}}" rel="stylesheet">

    
    <title>Shop Profile</title> 
</head>
<body>
   <div class="container-fluid">
 <div>
@include('dealer1.header', ['shop' => $shop])
 </div>
<div>
@include('dealer1.sidebar', ['shop' => $shop])
  <div class="home">
    <div class="container-fluid">
      <div class="global-flex-col">
              <div class="d-sm-flex align-items-center justify-content-between mb-4 align-items-baseline">
                        <h1 class="h3 mb-0 text-gray-800 head1 "><i class="bi bi-shop"></i> Shop Profile</h1>
                         
                    </div>
                    <p class="text-secondary ">(You can Edit Your Shop Details To Remain Updated)</p>
                  </div>
                    <div class="d-flex justify-content-center">
                      @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
                    </div>
                    
<div class="row justify-content-center">
                <h2 class="ps1"></h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-5 col-sm-10 m-profile my-md-1 my-2 mx-2">
                    <input type="hidden" id="latitude" value="{{ $shop->latitude }}">
<input type="hidden" id="longitude" value="{{ $shop->longitude }}">

               <h2 class="mt-2">{{ $shop->name }}</h2>
               <div class="justify-content-center global-flex1 my-1 align-items-baseline"><p class="text-secondary mx-3">Ratings/Reviews </p> 5.0 <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i> (2)</div>
           <img src="{{ asset($shop->image) }}" alt="profile picture">
           <h3 class="mt-sm-5">Shop Location</h3>
           <div id="shop_map" style="height: 180px;">
               
           </div>
           <h3 class="mt-sm-5">Shop Days</h3>
           <div class="shop-days">
            <div class="global-flex1">
              @php
    $daysArray = unserialize($shop->days);
@endphp
              @foreach ($daysArray as $day)
    <p class="mx-1">{{ $day }}</p>
@endforeach
                
           </div>
           </div>
           <h3 class="mt-sm-5">Shop Hours</h3>
           <div class="shop-days">
            <div class="global-flex1 justify-content-around">
              <div class="global-flex-col">
                <span class="text-secondary fw-bold">Opening Time</span>
               <p class="mx-1"><i class="bi bi-clock"></i>&nbsp; {{ $shop->openTime}} </p>
</div>
<div class="global-flex-col">
  <span  class="text-secondary fw-bold">Closing Time</span>
      <p class="mx-1"><i class="bi bi-clock"></i>&nbsp; {{ $shop->closeTime}}</p> 
             </div>
           </div>
           </div> 
           <a href="{{ route('edit_dealer_shop1') }}"><button class="btn btn-primary mt-2">Edit Profile <i class="bi bi-pencil-square"></i></button></a>
                </div>




</div>
</div>
</div>
 
  <!-- Bootstrap JavaScript -->
 </div>

 <script src="{{ asset('js/alert.js') }}"></script>
<script src="{{ asset('js/mechanic/shop.js') }}"></script>
   <!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script  >
    function initMap() {
  // Get latitude and longitude values
  var latitude = parseFloat(document.getElementById('latitude').value);
  var longitude = parseFloat(document.getElementById('longitude').value);
  var start = { lat: latitude, lng: longitude };

  var options = {
    zoom: 15,
    center: start,
    mapTypeControl: true
  };

  var map = new google.maps.Map(document.getElementById('shop_map'), options);

  // Add a marker at the starting location
  var marker = new google.maps.Marker({
    position: start,
    map: map
  });
}

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
</body>
</html>
