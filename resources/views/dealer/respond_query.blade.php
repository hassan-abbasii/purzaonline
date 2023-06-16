<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
   

    <!----======== CSS ======== -->
 
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    
     <link rel="stylesheet" href="{{asset('css/mechanic/respond_query.css')}}">
 
 <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">

    
    <title>Responding Query</title> 
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
                        <a href="{{route('allqueriesdealer')}}" class=" d-sm-inline-block btn mt-2 btn-primary shadow-sm"><i
                                class="bi bi-star"></i> View All Queries </a>
</div>
 </div>

<div class="aboutdiv-heading-border4"></div>
<div class="row justify-content-center">
          <div class="col-md-4 mx-2 mt-2">
            <div class="reply-query">
              <div class="bg1 py-2">
            <h2><i class="bi bi-reply"></i> Replying To Query</h2>
            <p class="ps1"><i class="bi bi-person"></i> {{$record->users->name}}</p>
          </div>
            <div>
              <div class="aboutdiv-heading-border4"></div>
            <label><i class="bi bi-ca"></i> Product</label><p>{{$record->products->name}}</p>
            <div class="aboutdiv-heading-border4"></div>
            <label><i class="bi bi-ca"></i> Car Detail</label><p>{{$record->car->make}}, {{$record->car->model}}, {{$record->car->variant}}</p>
            <div class="aboutdiv-heading-border4"></div>
            <label><i class="bi bi-ticket-detailed"></i> Description</label>
            <p>{{$record->description}}</p>
            <div class="aboutdiv-heading-border4"></div>
          </div>
          <div>
            <form class="form" action="{{route('respond',['id'=>$record->id])}}" method="post">
@csrf
@method('PUT')
              <div class="form-control">
                <label>Select Availability</label>
                <select name="status" class="w-100 form-control" required>
                  <option>Available</option>
                  <option>Not Available</option>
                </select>
              </div>
              <div class="form-control">
                <label>Add Response</label><br>
                <textarea class="w-100 form-control" maxlength="50" name="response"></textarea>
                <div class="global-flex1 justify-content-end"><p>Maximum 0/50</p></div>
              </div>
              <div class="global-flex1 justify-content-end my-1">
              <button class="btn btn-primary" type="submit">Send Response</button> 
            </div>
            </form>
          </div>

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
