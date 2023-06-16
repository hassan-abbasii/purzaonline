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
                        <h1 class="h3 mb-0 text-gray-800 head1">User Reviews</h1>
                        
                     <!-- Content Row -->
                     
                  <div class=" justify-content-center w-50">
   </div>

<div>
                        <a href="{{route('alluserrev')}}" class=" d-sm-inline-block btn mt-2 btn-primary shadow-sm"><i
                                class="bi bi-star"></i> View All Reviews </a>
</div>
 </div>

<div class="aboutdiv-heading-border4"></div>
<div class="row justify-content-center">
<div class="col-md-4 mt-2 mx-2">
  <div class="car-form">
   
  <h2>Edit Review</h2>
  <div class="aboutdiv-heading-border4"></div>
  <form  action="{{ route('update-review',$record->id)}}"  method="POST">
   @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif

               @csrf
               @method('PUT')
   
  <div class="form-group">
    <label>Edit Rating</label>
     <input  type="checkbox" name="rating" value="1" onclick="updateRating(this)">
    <input type="checkbox" name="rating" value="2" onclick="updateRating(this)">
    <input type="checkbox" name="rating" value="3" onclick="updateRating(this)">
    <input type="checkbox" name="rating" value="4" onclick="updateRating(this)">
    <input type="checkbox" name="rating" value="5" onclick="updateRating(this)">
    <br> </div>
   @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<br>
<div class="form-group">
  <label>Edit Comment</label>
  <textarea class="form-control" name="comment"  required>{{$record->comment}}</textarea>
</div>

  <div class="global-flex1 justify-content-end">
    <div class="  mt-2"></div>
    <button class="btn btn-primary " type="Submit">Submit</button>
  </div>
</form>
</div>
                    </div>
         </div>



</div>
</div>
</div>

<script>
    let rating = {{$record->rating ?? 0}}; // Initialize with the rating value

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

    // Select checkboxes based on initial rating value
    window.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.getElementsByName('rating');

        for (let i = 0; i < checkboxes.length; i++) {
            if (parseInt(checkboxes[i].value) <= rating) {
                checkboxes[i].checked = true;
            }
        }
    });

    function validateForm() {
        if (rating === 0) {
            alert("Please select a rating before submitting.");
            return false; // Prevent form submission
        }
        // Other form validation and processing logic
        return true; // Allow form submission
    }
</script>

</body>
</body>
</html>
