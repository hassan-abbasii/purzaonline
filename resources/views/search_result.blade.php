<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<title>Result</title>
	<link rel="stylesheet" type="text/css" href="(asset('css/bootstrap/css/bootstrap.css')">

	<link rel="stylesheet" type="text/css" href="{{asset('css/homepage.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <!-- Google Fonts -->
 
 

  <link href="{{asset('css/main.css')}}" rel="stylesheet">


</head>
<body>
	<div>
@if(session()->has('loginId'))
    @include('header_session')
@else
    @include('header')
@endif
</div>
 
<div class="container-fluid header-change "  >
	<div class="row map mt-0">
     
    <div class="col-md-4 item " style="padding:0px; height :580px; overflow-y: auto; ">
  <div>
    <h6>Searched Results...</h6><br>
   
  </div>
  @foreach($shops as $shop)
  <div class="searchview">
    <img src="{{$shop->image}}" alt="logo"> 
    <div class="info">
    <h3><a href="{{route('shop_details',['id' => $shop->id])}}">{{$shop->name}}</a></h3>
    <div class="global-flexx" style="font-size:15px;">
    {{$shop->type}}
    @if($shop->type == 'Mechanic' || $shop->type == 'Dealer*')
        <i class="bi bi-patch-check-fill" style="color: blue; vertical-align: middle;"></i>
    @endif
</div>
<br>

    <p> 5.0&nbsp;   <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>&nbsp; (20)</p>
     
            </p>
    </div>
  </div>
   @endforeach
  
  
  
</div>

<div class="col-md-8 map1" id="mapview" style="height :580px;">
  
</div>
  </div>
</div>
<br><br>
 
	<br>
	<div> 
	<div style="padding: none; " class="p-0 m-0 ml-0 mb-0">
	
@include('footer')
	 
</div>
</div>
 

 


 
 
<script type="text/javascript">
	function showDiv(divId) {
  const div1 = document.getElementById('div1');
  const div2 = document.getElementById('div2');
  
  if (divId === 'div1') {
    div1.style.display = 'block';
    div2.style.display = 'none';
  } else {
    div1.style.display = 'none';
    div2.style.display = 'block';
  }
}
</script>
<script>
  // Assuming the 'shops' variable is passed from the controller using compact
  const shops = {!! json_encode($shops) !!};
</script>
<script src="https://kit.fontawesome.com/ad31ba8bf1.js" crossorigin="anonymous"></script>
<script  >
	function initMap() {
  const start = { lat: 33.627214, lng: 72.972060 };
  const end = { lat: 33.665359, lng: 73.059715 };

  const mapOptions = {
    zoom: 10,
    center: { lat: 33.619314, lng: 72.982060 },
    mapTypeControl: true,
  };

   const map = new google.maps.Map(document.getElementById('mapview'), mapOptions);
  // Loop through the shop objects and place markers on the map
 for (const shop of shops) {
  const { latitude, longitude, name } = shop;

  const marker = new google.maps.Marker({
    position: { lat: latitude, lng: longitude },
    map: map,
    title: name,
    label: {
      text: name,
      color: 'black',
      fontSize: '12px',
      fontWeight: 'bold',
    },
    icon: {
      path: google.maps.SymbolPath.STAR,
      fillColor: 'red',
      fillOpacity: 1,
      strokeWeight: 0,
      scale: 15,
    },
  });
}



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

 
<script src="{{ asset('js/alert.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>
</html>