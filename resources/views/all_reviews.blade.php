<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
   

    <!----======== CSS ======== -->
 
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    
     
 
 <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">

    
    <title>User Reviews</title> 
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
  <div class="home">
 <div class="container-fluid">
  
              <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-baseline"><h1 class="h3 mb-0 text-gray-800 head1"> User Reviews</h1></div>
                        
                     <!-- Content Row -->
                     
                  <div class=" justify-content-center w-50">
     
     @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
  </div> 
                                <!-- Card Header - Dropdown -->
                                
              <div class="review-count mb-1">
            <div class="global-flex-col">
                <p>Total Reviews: {{$totalCount}} </p>
                <p style="color: gold; text-align: center;"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></p>
            </div>
        </div>          
                      
         </div>           
                     <!-- Content Row -->
                   
<div class="aboutdiv-heading-border4"></div>
 <!-- Earnings (Monthly) Card Example -->
                        

 
 

 
                    <div class="row car-record justify-content-center">
                       
                      <h2>Reviews Record</h2>
                      <div class="global-flex-new justify-content-center align-items-center">
                        <input type="text" id="myInput" class="form-control w-50" placeholder="What are you looking for? Search Here.." name="">
                    
                      </div>
                      <div class=" reserve-head1  mt-2">
            <div class="row">
    @foreach($record as $rec)       
 <div class="col-md-3">
            <div class="revew"> 
       
        <img src="{{$rec->shop->image}}" alt="profile">
        <h3>{{$rec->shop->name}}</h3>
        <p style="color: grey;" class="typee"> <i class="bi bi-patch-check-fill"></i> {{$rec->shop->type}}</p>
        <p class="pr">{{$rec->rating}}-Star Review</p>
       
        <p class="datee">@php
    $rating = $rec->rating;
@endphp

@for ($i = 1; $i <= 5; $i++)
    @if ($i <= $rating)
        <i class="fa fa-star" style="color: gold;"></i>
    @else
        <i class="fa fa-star" style="color: grey;"></i>
    @endif
@endfor &nbsp; {{$rec->date}}</p>
        <p  class="comment" > {{$rec->comment}}</p>
        @if ( $rec->reply !== "")
        <p  class="comment" >Owner Reply: {{$rec->reply}}</p>
        @endif
        <a href="{{ route('edit-review', ['id' => $rec->id]) }}"><button id="reply1"><i class="fa fa-message"></i>Edit&nbsp; <i class="bi bi-pencil-square"></i></button></a><a href="{{ route('delete-review', ['id' => $rec->id]) }}"><button>Delete&nbsp;<i class="bi bi-trash"></i></button></a>
    
    </div>
</div>
@endforeach
                
        </div>
        </div>
                      
                    </div>
         </div>
</div>
</div>
 

<!-- Include custom JavaScript file -->
<script src="{{ asset('js/alert.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
  // Get the input element
  var input = document.getElementById("myInput");

  // Add an event listener for input changes
  input.addEventListener("input", function() {
    var filter = input.value.toLowerCase();

    // Get all the review elements
    var reviews = document.getElementsByClassName("revew");

    // Loop through the reviews and hide/show based on the input value
    for (var i = 0; i < reviews.length; i++) {
      var review = reviews[i];
      var shopName = review.getElementsByTagName("h3")[0].textContent.toLowerCase();
      var comment = review.getElementsByClassName("comment")[0].textContent.toLowerCase();
      var typee = review.getElementsByClassName("typee")[0].textContent.toLowerCase();
      var datee = review.getElementsByClassName("datee")[0].textContent.toLowerCase();

      if (shopName.includes(filter) || comment.includes(filter) || typee.includes(filter) || datee.includes(filter)) {
        review.style.display = "block";
      } else {
        review.style.display = "none";
      }
    }
  });
</script>

</body>
</html>
