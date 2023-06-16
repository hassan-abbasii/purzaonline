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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="{{asset('css/mechanic/dashboard.css')}}" rel="stylesheet">
  <link href="{{asset('css/mechanic/mechanic_profile.css')}}" rel="stylesheet">

    
    <title>Run Feature Ad</title> 
</head>
<body>
   
 <div>
@include('mechanic.header', ['shop' => $shop])
 </div>
<div>
@include('mechanic.sidebar', ['shop' => $shop])
  <div class="home">
 <div class="container-fluid">
  
               <div class="d-sm-flex align-items-center justify-content-between  ">
                       <div class="global-flex-new1">
                        <h1 class="h3 mb-0 text-gray-800 head1"><i class="bi bi-badge-ad"></i> Run Feature Ad</h1>
                         <p style="color: #adb5bd;"></p>
                       </div>
                       <div class="global-flex-new justify-content-center">
     
     @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
  </div>
                        <a href=" {{ route('addservice')}}" class=" d-sm-inline-block btn   btn-primary shadow-sm"><i
                                class="bi bi-badge-ad"></i> View All Requests</a>
                    </div>
                     <!-- Content Row -->
                   
<div class="aboutdiv-heading-border4"></div>
<br>
<div class="row justify-content-center">
           
           <div class="col-md-6 mx-2 my-2">
               <div class="f-ad">
                   <h2>Add Feature Ad Detail</h2>
                   <form class="form" id="f-ad" method="post" action="{{route('aduserdetail')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-control">
                   <label>Select Ad Plan</label>
                   <select name="plan" id="planSelect">
                   
                    @foreach ($record as $plan)
    <option value="{{ $plan->id }}">{{ $plan->days }} day</option>
  @endforeach
                </select></div>
                <div class="form-control mt-2 d-flex fw-bold justify-content-center price">
                <label>Price</label>
                <label id="priceLabel" class="mx-2">{{ $record[0]->price }}</label></div>
                <div class="form-control mt-2">
                    <p class="p11">Add any image of business</p>
                    <label>Add Ad Image</label>
                    <input class="w-75 form-control" type="file" name="image" required>
                </div>
                <div class="form-control mt-2">
                    <label>Add Description</label><br>
                     <p class="p11">Add Details of Ad.</p>
                    <textarea class="w-100 form-control" maxlength="50" name="description" placeholder="Add details here.."></textarea>

                    <div class="d-flex text-secondary justify-content-end"><p>Maximum 0/50</p></div></div>
                    
                      <p class="p11">Only Card Payments Allowed</p>
                    <div class="d-flex justify-content-end mt-2">

                    <button class="btn btn-primary my-2" type="submit">Pay Now</button></div>
                
</form>
               </div>

           </div>
       </div> 
                    




         </div>
</div>
</div>

<!-- Include custom JavaScript file -->
<script src="{{ asset('js/alert.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="{{ asset('js/admin/find.js') }}"></script>
 <script>
  // Get the select element and price label element
  var planSelect = document.getElementById('planSelect');
  var priceLabel = document.getElementById('priceLabel');

  // Set the initial price to the price of the first record
  priceLabel.innerText = {{ $record[0]->price }};

  // Add an event listener to the select element
  planSelect.addEventListener('change', function() {
    // Get the selected plan's duration from the selected option
    var selectedDuration = parseInt(planSelect.value);

    // Retrieve the corresponding price from the $record variable
    var record = {!! json_encode($record) !!};
    var selectedPlan = record.find(function(plan) {
      return plan.id === selectedDuration;
    });

    // Update the price label with the retrieved price
    priceLabel.innerText = selectedPlan.price;
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
  $('#f-ad').submit(function(e) {
    var fileInput = $('input[name="image"]');
    var file = fileInput[0].files[0];

    if (file && file.type.indexOf('image/') !== 0) {
      e.preventDefault();
      alert('Please select a valid image file.');
    }
  });
});

</script>
</body>
</html>
