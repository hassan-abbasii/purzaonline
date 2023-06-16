<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{asset('css/mechanic/mechanic_profile.css')}}">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css”/> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    
    <title>Reviews</title> 
</head>
<body>
 
 <div>
@include('mechanic.header', ['shop' => $shop])
 </div>
<div>
@include('mechanic.sidebar', ['shop' => $shop])
     <div class="home" style="">
        <div class="container-fluid">
             
      <div class="row mx-md-3  reserve-head">
        <div class="global-flex1 justify-content-between">
            <div class="global-flex-col">
        <h2><i style="color: #ffd700;" class="bi bi-star"></i> All Reviews</h2>
        <p style="color: #adb5bd;">(showing all reviews that car owner has given to you, reply to reviews to gain customer attention.)</p>
        </div>
            <div class="review-count mb-1">
            <div class="global-flex-col">
                <p>Total Reviews: {{$reviewCount}} </p>
                <p>({{$averageRating}}) &nbsp;   @php
    $rating = intval($averageRating);
@endphp

@for ($i = 1; $i <= 5; $i++)
    @if ($i <= $rating)
        <i class="fa fa-star" style="color: gold;"></i>
    @else
        <i class="fa fa-star" style="color: grey;"></i>
    @endif
@endfor</p>
            </div>
        </div>
         
    </div>
    <div class="d-flex w-50 justify-content-center">
         @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
    </div>
        <div class="aboutdiv-heading-border4"></div>
        <br>
                <div class="col-md-12 justify-content-around">
                   <h2 class="heading-2">Shop Reviews</h2>
                      <div class="global-flex-new justify-content-center align-items-center">
                        <input type="text" id="myInput" class="form-control w-50" placeholder="What are you looking for? Search Here..." name="">
                    
                      </div>
            </div>

       
        <div class=" reserve-head1  mt-2" style="overflow-x: hidden;">
            <div class="row justify-content-center" >
                @forelse($review as $record)
                <div class="col-md-3 mx-2 mt-2">
            <div class="revew"> 
       
        <img src="{{asset($record->users->profile_image)}}" alt="profile">
        <h3>{{$record->users->name}}</h3> 
        <p class="pr">{{$record->rating}}-Star Review</p>
         
        <p class="datee">@php
    $rating = $record->rating;
@endphp

@for ($i = 1; $i <= 5; $i++)
    @if ($i <= $rating)
        <i class="fa fa-star" style="color: gold;"></i>
    @else
        <i class="fa fa-star" style="color: grey;"></i>
    @endif
@endfor &nbsp; {{$record->date}}</p>
        <p style="color: black" class="comment"> {{$record->comment}}</p>
         @if ( $record->reply !== "")
        <p  class="comment" >Reply: {{$record->reply}}</p>
        @endif
        <a href="{{route('replyreview',['id' => $record->id])}}">
        <button id="reply1"><i class="fa fa-message"></i>write a reply&nbsp; <i class="bi bi-chat-right-text-fill"></i></button> </a>
    
    </div>
</div>
 @empty
 <div class="col justify-content-center">
     <p>No Record To Show</p>
 </div>
@endforelse
 
 

        </div>
        </div>

    </div>
         </div>
    
   
   

    <script type="text/javascript">
        document.getElementById("reply1").addEventListener("click",function(){
            document.querySelector(".popup1").style.display="flex";
        })
         document.querySelector(".closer").addEventListener("click",function(){
            document.querySelector(".popup1").style.display="none";
        })

        function changeColor(color) {
            document.querySelector(".fa-heart").style.color = color;
           $(this).button("value", "Liked");
        }
          
        
    </script>
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
            var datee = review.getElementsByClassName("datee")[0].textContent.toLowerCase();
            var comment = review.getElementsByClassName("comment")[0].textContent.toLowerCase();

            if (shopName.includes(filter) || comment.includes(filter) || datee.includes(filter)) {
                review.style.display = "block";
            } else {
                review.style.display = "none";
            }
        }
    });
</script>
<script src="{{ asset('js/alert.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="{{ asset('js/admin/find.js') }}"></script>
 
</body>
</html>