<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
  <!-- Font Awesome CSS -->
  

    <!----======== CSS ======== -->
 
    <link rel="stylesheet"   href="{{ asset('css/bootstrap/css/bootstrap.css')}}">
     
 <link href="{{asset('css/admin/dashboard.css')}}" rel="stylesheet">
 <link href="{{asset('css/admin/header.css')}}" rel="stylesheet">
  <link href="{{asset('css/admin/sidebar.css')}}" rel="stylesheet">
    
    <title>Edit Part Details</title> 
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
                        <h1 class="h3 mb-0 text-gray-800 head1"><i class="bi bi-tools"></i> Edit Spare Part</h1>
                         <p style="color: #adb5bd;">(Edit Spare Part Name To Update Record)</p>
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
   
  <h2>Edit Spare Part</h2>
  <div class="aboutdiv-heading-border4"></div>
  <form  action="{{ route('partupdate',$product->id)}}"  method="POST">
   @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif

               @csrf
               @method('PUT')
   
  <div class="form-group">
    <label>Edit Spare Part Name</label>
    <input type="text" name="name" value=" {{ $product->name }}"class="form-control w-75" required> 
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

<!-- Include custom JavaScript file -->
<script src="{{ asset('js/alert.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 

</body>
</html>
