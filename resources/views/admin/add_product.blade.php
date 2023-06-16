<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-ZVZl6Fpdn8VaxWkHv2rV9X6+u/Q8fBH5hzkmvE3qgCYN5Q5vdTwgvWxLhJCLp9XmRFGy5hW+d73Jupkq3C1Z3Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!----======== CSS ======== -->
 
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" /> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="css/admin/dashboard.css" rel="stylesheet">

    
    <title>Add Part Details</title> 
</head>
<body>
   
 <div>
@include('admin.header')
 </div>
<div>
@include('admin.sidebar')
  <div class="home ">
 <div class="container-fluid">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="global-flex-new1">
                        <h1 class="h3 mb-0 text-gray-800 head1"><i class="bi bi-tools"></i> Add New Spare Part</h1>
                         <p style="color: #adb5bd;">(Enter Spare Part Name To Add New)</p>
                       </div>
                       <div>
                        <a href="{{route('spareparts')}}" class=" d-sm-inline-block btn mt-2 btn-primary shadow-sm"><i
                                class="bi bi-tools"></i> View All Spare Parts</a>
</div>
        
                    </div>
<div class="aboutdiv-heading-border4"></div>

                    <div class="row justify-content-center">
<div class="col-md-4 mt-2 mx-2">
  <div class="car-form">
   
  <h2>Add New Spare Part</h2>
  <div class="aboutdiv-heading-border4"></div>
  <form method="post" action="{{ route('add-part')}}">
   @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif

               @csrf
   
  <div class="form-group">
    <label>Enter Spare Part Name</label>
    <input type="text" name="name" class="form-control w-75" required> 
  </div>
   @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
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

 <script src="{{ asset('js/admin/find.js') }}"></script>
<!-- Include custom JavaScript file -->
<script src="{{ asset('js/alert.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
