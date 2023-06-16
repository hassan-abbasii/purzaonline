<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<title>Dealer Shop Details</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('css/mechanic_detail.css')}}">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


</head>
<body>
	<div>
@if(session()->has('loginId'))
    @include('header_session')
@else
    @include('header')
@endif
</div>
<div class="container-fluid mechanic">
	<div class="row mechanic_detail">
		<div class="col-md-4  mechanic_detail1">
			 
				<img src="{{ asset($shop->image) }}" alt="store picture">
				<div class="global-flex-col  mechanic-top">
				<h2>{{$shop->name}}</h2>
				<p>Spare Part Dealer&nbsp; @if($shop->type == 'Mechanic' || $shop->type == 'Dealer*')
        <i class="bi bi-patch-check-fill" style="color: blue; vertical-align: middle;"></i>
    @endif</p>
			</div>
			<div class="d-flex   justify-content-center">
				 @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
           </div> 
				<div class="global-flex mt-2 justify-content-center RC">
					<p>{{$averageRating}}&nbsp; @php
    $rating = intval($averageRating);
@endphp

@for ($i = 1; $i <= 5; $i++)
    @if ($i <= $rating)
        <i class="fa fa-star" style="color: gold;"></i>
    @else
        <i class="fa fa-star" style="color: grey;"></i>
    @endif
@endfor&nbsp;({{$reviewCount}})</p> 
			</div>
			<div class="aboutdiv-heading-borderr"></div>
			<div>
				 
			</div>
	 <div class="global-flex">
				@if($timeSlots == 1)
    <p class="open">Open Today</p>
@endif
@if($timeSlots == 0)
    <p class="close">Closed Today</p>
@endif
			</div>
			<div class="global-flex ">
				<p class="btnb1"><i class="bi bi-clock"></i>&nbsp;{{$shop->openTime}} - {{$shop->closeTime}}</p>
			</div>
			
			<div class="global-flex">
				@if($favorite1 == 1)
				<a href="{{route('addtofavorite',['id'=> $shop->id])}}"><button class=" my-2 btnb">Add to Favorite <i class="bi bi-heart-fill"></i></button></a>
			
			@else
			<a href="{{route('removefromfavorite',['id'=> $shop->id])}}"><button class=" my-2 btnb">Remove From Favorite <i class="bi bi-heart-fill"></i></button></a>
		
		@endif<br>
			</div>
			<div class="global-flex">
				<a href="{{route('getdirection',['id' => $shop->id])}}"><button class="btn btn-primary">Get Directions <i class="bi bi-sign-turn-slight-left-fill"></i></button></a>
			</div>
			<p class="pca mt-2">Confirm Product Availability...</p>
			<div class="global-flex justify-content-center">

				 @if($shop->type == "Dealer")
     <a href="{{route('sendquery',['id' => $shop->id])}}"><button  class="btn btn-outline-primary " >Send Product Query</button> </a>
     @else
  <a href="{{route('browsecatalog',['id'=>$shop->id])}}"><button  class="btn btn-outline-primary " >Browse Catalog</button> </a>
@endif
			</div>
			 
				 
				 	 
				 
		 <p class="pca mt-4">Share your Experience with Public...</p>
			<div class="global-flex justify-content-around align-items-baseline">
			<button class="btn btn-primary  btn-sm " id="replyrp" @if(!session()->has('name')) disabled @endif>Write a Review&nbsp;<i class="bi bi-chat"></i></button>
			 
		</div><br><br>
			<div class="aboutdiv-heading-border1"></div>
			<div class="r-head">
			<h2>All Reviews</h2>
			<div class="global-flex justify-content-center sortr align-items-center">
				<label>Sort By</label> 
				<select id="sort" class="mx-2 form-control w-25">
					 
					<option>New</option>
					<option>Old</option>
					<option>Lowest Rated</option>
					<option>Highest Rated</option>
				</select>
				<br><br><br>
			</div>


		<div id="reviews">
			@forelse($review as $rev)
			<div class="media mt-3" >

	<div class="global-flex">
	<img src="{{asset($rev->users->profile_image)}}" alt="profile" class="mr-3">
	 <div class="global-flex-col mx-2">
	<h5>{{$rev->users->name}}</h5> 
	<div class="global-flex"> 
	<p >&nbsp; @php
    $rating = $rev->rating;
@endphp

@for ($i = 1; $i <= 5; $i++)
    @if ($i <= $rating)
        <i class="fa fa-star" style="color: gold;"></i>
    @else
        <i class="fa fa-star" style="color: grey;"></i>
    @endif
@endfor </p><p>&nbsp;(<span class="rateee">{{$rev->rating}}</span>-star)</p>
</div>
 </div>
</div>
<p class="pd  dateee">{{$rev->date}}</p>
	<div class="media-body">
		
		<p class="pnew2">{{$rev->comment}}</p>
		@if ( $rev->reply !== "")
<!-- reply-->
<span style="color: grey;" class="mx-3">Owner Reply</span>
<div class="media mt-3 mx-4" >
	<div class="global-flex align-items-center">
	<img src="{{asset($rev->shop->image)}}" alt="profile" class="mr-3">
	 <div class="global-flex-col">
	<h5 class="mx-2">{{$rev->shop->name}}</h5> 
	 
 </div>
</div>
<p class="pd">{{$rev->reply_date}}</p>
	<div class="media-body">
		
		<p class="pnew1 mx-2"> {{$rev->reply}}</p>


	</div>

</div>
@endif
<!--  close-->

	</div>

</div>
@empty
<p class="pnew">Yet No Ratings/Reviews</p>
@endforelse
</div>
</div>

		</div>
		<div class="col-md-8" id="mechanic_map" style="height: 580px;">
			 
		</div>
	</div>
	<div>
		 
@include('footer')
		 
	</div>
</div>
  <div class="popuprp">
        <div class="popuprp-content">
           <img src="{{asset('images/close.png')}}" class="closerp" alt="close">
            <h1> Reviewing to {{$shop->name}} </h1>
             <form onsubmit="return validateForm()" method="post" action="{{route('addreview',['id' => $shop->id])}}">
             	@csrf
             	   <h1 style="font-weight: bold;">{{session()->get('name')}}</h1>
             	   <br>
             	<label>Rating</label>
             	<br><br>
            <input type="checkbox" name="rating" value="1" onclick="updateRating(this)">
    <input type="checkbox" name="rating" value="2" onclick="updateRating(this)">
    <input type="checkbox" name="rating" value="3" onclick="updateRating(this)">
    <input type="checkbox" name="rating" value="4" onclick="updateRating(this)">
    <input type="checkbox" name="rating" value="5" onclick="updateRating(this)">
    <br>
 
         
            <label>Review</label><br>
           
            <textarea name="comment"  required></textarea>
            <p style="font-size:10px; color:grey;"><i class="bi bi-info-circle"></i> Your review would be public immediately.</p>
            <button type="submit" class="btn btn-primary">Review</button>
        </form>

        </div>
    </div>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   // Retrieve the review container element
var reviewContainer = document.getElementById('reviews');

// Retrieve the sort select element
var sortSelect = document.getElementById('sort');

// Add event listener to the sort select element
sortSelect.addEventListener('change', sortReviews);

// Initial sorting
sortReviews();

function sortReviews() {
  var sortOption = sortSelect.value;
  var reviews = Array.from(reviewContainer.children);

  switch (sortOption) {
    case 'All':
      // Display all reviews (default order)
      reviews.forEach(function(review) {
        review.style.display = 'block';
      });
      break;
    case 'New':
      // Sort by date (newest first)
      reviews.sort(function(a, b) {
        var dateA = new Date(a.querySelector('.dateee').textContent);
        var dateB = new Date(b.querySelector('.dateee').textContent);
        return dateB - dateA;
      });
      arrangeReviews(reviews);
      break;
    case 'Old':
      // Sort by date (oldest first)
      reviews.sort(function(a, b) {
        var dateA = new Date(a.querySelector('.dateee').textContent);
        var dateB = new Date(b.querySelector('.dateee').textContent);
        return dateA - dateB;
      });
      arrangeReviews(reviews);
      break;
    case 'Lowest Rated':
      // Sort by rating (lowest first)
      reviews.sort(function(a, b) {
        var ratingA = parseInt(a.querySelector('.rateee').textContent);
        var ratingB = parseInt(b.querySelector('.rateee').textContent);
        return ratingA - ratingB;
      });
      arrangeReviews(reviews);
      break;
    case 'Highest Rated':
      // Sort by rating (highest first)
      reviews.sort(function(a, b) {
        var ratingA = parseInt(a.querySelector('.rateee').textContent);
        var ratingB = parseInt(b.querySelector('.rateee').textContent);
        return ratingB - ratingA;
      });
      arrangeReviews(reviews);
      break;
    default:
      // Display all reviews (default order)
      reviews.forEach(function(review) {
        review.style.display = 'block';
      });
      break;
  }
}

function arrangeReviews(reviews) {
  reviews.forEach(function(review) {
    reviewContainer.appendChild(review);
  });
}

</script> 
<script>
    let rating = 0; // Variable to store the rating value

    function updateRating(checkbox) {
        const checkboxes = document.getElementsByName('rating');
        const selectedRating = parseInt(checkbox.value);

        for (let i = 0; i < checkboxes.length; i++) {
            if (parseInt(checkboxes[i].value) <= selectedRating) {
                checkboxes[i].checked = true;
                rating = selectedRating;
            } else {
                checkboxes[i].checked = false;
            }
        }

        console.log('Selected rating:', rating);
    }

    function validateForm() {
        if (rating === 0) {
            alert("Please select a rating before submitting.");
            return false; // Prevent form submission
        }
        // Other form validation and processing logic
        return true; // Allow form submission
    }
</script>
 

  <script type="text/javascript">
    document.getElementById("replyrp").addEventListener("click", function() {
        if ({{ session()->has('name') ? 'true' : 'false' }}) {
            document.querySelector(".popuprp").style.display = "flex";
        }
    });

    document.querySelector(".closerp").addEventListener("click", function() {
        document.querySelector(".popuprp").style.display = "none";
    });
</script>
 <script>
function initMap() {
  const latitude = {{ $shop->latitude }};
  const longitude = {{ $shop->longitude }} ;
  const shopName = "{{ $shop->name }}";

  const mapOptions = {
    zoom: 17,
    center: { lat: latitude, lng: longitude },
    mapTypeControl: true,
  };

  const map = new google.maps.Map(document.getElementById('mechanic_map'), mapOptions);

  const marker = new google.maps.Marker({
    position: { lat: latitude, lng: longitude },
    map: map,
    title: shopName,
    label: {
      text: shopName,
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
 <script>
   // Retrieve the review container element
var reviewContainer = document.getElementById('reviews');

// Retrieve the sort select element
var sortSelect = document.getElementById('sort');

// Add event listener to the sort select element
sortSelect.addEventListener('change', sortReviews);

// Initial sorting
sortReviews();

function sortReviews() {
  var sortOption = sortSelect.value;
  var reviews = Array.from(reviewContainer.children);

  switch (sortOption) {
    case 'All':
      // Display all reviews (default order)
      reviews.forEach(function(review) {
        review.style.display = 'block';
      });
      break;
    case 'New':
      // Sort by date (newest first)
      reviews.sort(function(a, b) {
        var dateA = new Date(a.querySelector('.dateee').textContent);
        var dateB = new Date(b.querySelector('.dateee').textContent);
        return dateB - dateA;
      });
      arrangeReviews(reviews);
      break;
    case 'Old':
      // Sort by date (oldest first)
      reviews.sort(function(a, b) {
        var dateA = new Date(a.querySelector('.dateee').textContent);
        var dateB = new Date(b.querySelector('.dateee').textContent);
        return dateA - dateB;
      });
      arrangeReviews(reviews);
      break;
    case 'Lowest Rated':
      // Sort by rating (lowest first)
      reviews.sort(function(a, b) {
        var ratingA = parseInt(a.querySelector('.rateee').textContent);
        var ratingB = parseInt(b.querySelector('.rateee').textContent);
        return ratingA - ratingB;
      });
      arrangeReviews(reviews);
      break;
    case 'Highest Rated':
      // Sort by rating (highest first)
      reviews.sort(function(a, b) {
        var ratingA = parseInt(a.querySelector('.rateee').textContent);
        var ratingB = parseInt(b.querySelector('.rateee').textContent);
        return ratingB - ratingA;
      });
      arrangeReviews(reviews);
      break;
    default:
      // Display all reviews (default order)
      reviews.forEach(function(review) {
        review.style.display = 'block';
      });
      break;
  }
}

function arrangeReviews(reviews) {
  reviews.forEach(function(review) {
    reviewContainer.appendChild(review);
  });
}

</script>
</body>
</html>