<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
   

    <!----======== CSS ======== -->
 
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    
     
 
 <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">

    
    <title>Reply Review</title> 
</head>
<body>
   
 <div>

  @include('dealer.header', ['shop' => $shop])
 </div>
<div>
@include('dealer.sidebar', ['shop' => $shop])
  <div class="home">
 <div class="container-fluid">
  
              <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 head1">User Review</h1>
                        
                     <!-- Content Row -->
                     
                  <div class=" justify-content-center w-50">
   </div>

<div>
                        <a href="{{route('shopreviewdealer')}}" class=" d-sm-inline-block btn mt-2 btn-primary shadow-sm"><i
                                class="bi bi-star"></i> View All Reviews </a>
</div>
 </div>

<div class="aboutdiv-heading-border4"></div>
<div class="row justify-content-center">
<div class="col-md-4 mt-2 mx-2">
  <div class="car-form">
   
  <h2>Reply To Review</h2>
  <div class="aboutdiv-heading-border4"></div>
  <p>Reviewed By: <span class="text-secondary">{{$review->users->name}}</span></p>
  <p>Comment: <span class="text-secondary">{{$review->comment}}</span></p>
  <form  action="{{ route('update-shopreviewdealer',$review->id)}}"  method="POST">
   @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif

               @csrf
               @method('PUT')
   
  
   @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<br>

<div class="form-group">
  <label>Enter Reply</label>
  <textarea class="form-control" maxlength="70" name="comment"  required></textarea>
  <div class="d-flex justify-content-end">
    <p>Maximum:0/70</p>
  </div>
</div>

  <div class="global-flex1 justify-content-end">
    <div class="  mt-2"></div>
    <button class="btn btn-primary " type="Submit">Reply</button>
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
