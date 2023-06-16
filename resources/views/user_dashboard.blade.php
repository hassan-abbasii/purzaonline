<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
  <!-- Font Awesome CSS -->
 
    <!----======== CSS ======== -->
 
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
      
     
 <link href="css/dashboard.css" rel="stylesheet">

  <link href="{{asset('css/main.css')}}" rel="stylesheet">

  <link href="{{asset('css/homepage.css')}}" rel="stylesheet">
<link href="css/profile.css" rel="stylesheet">
    
    <title>User Dashboard</title> 
</head>
<body>
   
 
  @if(session()->has('loginId'))
    @include('header_session')
@else
    @include('header')
@endif
  
 <div>
@include('sidebar')
  <div class="home ">
 <div class="container-fluid">
  <div class="d-flex w-50 justify-content-center">
         @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
           </div>
   <div class="row">
    
     <div class="col-md-4 mt-5">
       <div class="profile">
         <div class="globbal-flex">
           <img src="{{asset($user->profile_image)}}" alt="profile picture">
           <div class="globbal-flex-col mx-2">
           <h1>{{$user->name}}</h1>
           <p class="text-secondary"><i class="bi bi-envelope"></i> {{$user->email}}</p>
         </div>
         </div>
         <div class="d-flex justify-content-center">
         <button class="btn btn-sm btn-primary mt-2  " id="editp">Edit Profile <i class="bi bi-person"></i></button></div>
       </div>
     </div>
     <div class="col-md-6 mt-5">
      <div class="favorite-list">
        <h2>Favorite Shops</h2>
       @forelse($favorite as $rec)
       <div class="searchview">
    <img src="{{$rec->shop->image}}" alt="logo"> 
    <div class="info">
      @if($rec->shop->type == 'Dealer' || $rec->shop->type== 'Dealer*')
    <h3><a href="{{route('shop_details_dealer',['id' => $rec->shop->id])}}">{{$rec->shop->name}}</a></h3>
    @else
    <h3><a href="{{route('shop_details',['id' => $rec->shop->id])}}">{{$rec->shop->name}}</a></h3>
    @endif

    <div class="global-flexx" style="font-size:15px;">
    {{$rec->shop->type}}
    @if($rec->shop->type == 'Mechanic' || $rec->shop->type == 'Dealer*')
        <i class="bi bi-patch-check-fill" style="color: blue; vertical-align: middle;"></i>
    @endif
</div>
<br>

    <a href="{{route('removefromfavorite',['id'=> $rec->shop->id])}}"><button class="btn btn-sm btn-primary">Remove From Favorite</button></a>
     
            </p>
    </div>
  </div>
  @empty
  <div>
    <p>No Shops In Favorite</p>
  </div>
  @endforelse
</div>
     </div>



   </div>
</div>
</div>

 </div>

 <div class="popup">
        <div class="popup-content">
            <img src="images/close.png" class="close" alt="close">
           <div class="userp justify-content-center form1"  >
                    <form id="profileForm" method="post" action="{{route('userupdate')}}" enctype="multipart/form-data">
                      @csrf
                        <h2>Edit Profile Details</h2><br>
                         <label>Profile Picture</label><br>
                        <input type="file" name="image" required> <br>
                        <label>Name</label><br>
                        <input type="text" name="name" value="{{$user->name}}" required> <br>
                       
                        
                         <br>
                       <br>
                        <button type="submit" class="btn btn-primary">Submit </button>

                    </form>
                </div>
        </div>
    </div>
     
<script type="text/javascript">
    document.getElementById("editp").addEventListener("click", function() {
        document.querySelector(".popup").style.display = "flex";
    });
    document.querySelector(".popup .close").addEventListener("click", function() {
        document.querySelector(".popup").style.display = "none";
    });
</script>
<script type="text/javascript">
    document.getElementById("submitBtn").addEventListener("click", function() {
        var fileInput = document.querySelector('input[name="image"]');
        var file = fileInput.files[0];
        var fileExtension = file.name.split('.').pop().toLowerCase();
        var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (!allowedExtensions.includes(fileExtension)) {
            fileInput.value = '';
            alert('Please select a valid image file (jpg, jpeg, png, gif).');
            return; // Prevent form submission
        }

        document.getElementById("profileForm").submit();
    });
</script>
<script src="{{ asset('js/alert.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
