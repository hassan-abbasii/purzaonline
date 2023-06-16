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
    
    <title>Edit Shop Mechanic </title> 
</head>
<body>
   
 <div>
@include('mechanic.header', ['shop' => $shop])
 </div>
<div>
@include('mechanic.sidebar', ['shop' => $shop])
  <div class="home ">
 <div class="container-fluid">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="global-flex-new1">
                        <h1 class="h3 mb-0 text-gray-800 head1"><i class="bi bi-person-fill"></i> Edit Mechanic Details</h1>
                         <p style="color: #adb5bd;">(Edit Mechanic To Update Record)</p>
                       </div>
                       <div>
                        <a href="{{route('shopmechanic')}}" class=" d-sm-inline-block btn mt-2 btn-primary shadow-sm"><i
                                class="bi bi-person-fill"></i> View All Mechanics</a>
</div>
        
                    </div>
<div class="aboutdiv-heading-border4"></div>

                    <div class="row justify-content-center">
<div class="col-md-4 mt-2 mx-2">
  <div class="car-form">
   
  <h2>Edit Mechanic</h2>
  <div class="aboutdiv-heading-border4"></div>
  <form  action="{{ route('shopmechanic-update',$shopMechanic->id)}}"  method="POST">
   @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif

               @csrf
               @method('PUT')
   
  <div class="form-group">
    <label>Edit Mechanic Name</label>
    <input type="text" name="name" value=" {{ $shopMechanic->name }}"class="form-control w-75" pattern="[A-Za-z ]+" required> 
  </div>
   @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<div class="form-group">
    <label>Edit Mechanic Type</label>
     <select name="mechanic_id" class="form-control w-75">
  @foreach($mechanics as $mechanic)
    <option value="{{ $mechanic->id }}" {{ $mechanic->id == $savedMechanicId ? 'selected' : '' }}>
      {{ $mechanic->name }}
    </option>
  @endforeach
</select>
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

<!-- Include custom JavaScript file -->
<script src="{{ asset('js/alert.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 

</body>
</html>
