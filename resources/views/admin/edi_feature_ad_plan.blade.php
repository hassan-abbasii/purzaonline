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
    
    <title>Edit Feature Ad Plan</title> 
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
                        <h1 class="h3 mb-0 text-gray-800 head1 align-items-baseline"><i class="bi bi-tools"></i> Edit Plan Details</h1>
                         <p style="color: #adb5bd;">(Edit Plan Details To Update Record)</p>
                       </div>
                       <div>
                        <a href="{{route('faetureadplan')}}" class=" d-sm-inline-block align-items-baseline btn mt-2 btn-primary shadow-sm"><i
                                class="bi bi-badge-ad"></i> View All Plans</a>
</div>
        
                    </div>
<div class="aboutdiv-heading-border4"></div>

                    <div class="row justify-content-center">
<div class="col-md-4 mt-2 mx-2">
  <div class="car-form">
   
  <h2>Edit Feature Ad Plan</h2>
  <div class="aboutdiv-heading-border4"></div>
  <form  action="{{ route('featureadplanupdate',$product->id)}}"  method="POST">
    @error('days')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
   @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif

               @csrf
               @method('PUT')
   
  <div class="form-group">
    <label>Edit Car Make</label>
    <input type="text" name="days" value=" {{ $product->days }}" class="form-control w-75" required pattern="^[1-9]\d*$"> 
  </div>
   
 <div class="form-group">
    <label>Enter Plan Price </label>
    <input type="number" name="price" id="name" value=" {{ $product->price }}" class="form-control w-75" required  pattern="^[1-9]\d*$"> 
  </div>
  <div class="form-group">
    <label>Enter Account Number </label>
    <input type="number" name="account" id="phone-input" value=" {{ $product->accountNo }}" class="form-control w-75" required  pattern="^03\d{9}$" placeholder="E.g: 03120010011"> 
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
 
 <script>
const phoneInput = document.getElementById('phone-input');
phoneInput.addEventListener('input', () => {
  const pattern = /^03/;
  if (!pattern.test(phoneInput.value)) {
    phoneInput.setCustomValidity('Phone number must start with "03"');
  } else {
    phoneInput.setCustomValidity('');
  }
});
</script>
</body>
</html>
