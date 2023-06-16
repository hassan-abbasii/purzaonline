@php
use App\Models\users;
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Header</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/header.css')}}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>
    @php
        $user = users::where('id', session()->get('loginId'))->first();
    @endphp
<div class="container-fluid  py-0  "   
        >
    <div class="row  ">
        <div class="col bg-dark ">
            <nav class="navbar navbar-expand-sm bg-dark"  >
                <a href="homepage.php" class="navbar-brand "><img src="{{asset('images/logo1.png')}}" alt="logo"></a>
<button class="navbar-toggler" data-toggle="collapse" data-target="#mynavbar">
    <span class="navbar-toggler-icon bg-light">
</button>

<div class="collapse navbar-collapse justify-content-center mx-md-5 myynav" id="mynavbar" class="">
                <ul class="navbar-nav  align-items-center ">
                    <li class="nav-item "><a href="{{route('homepage')}}" class="nav-link ">Home</a></li>
                    <li class="nav-item"><a href="{{route('allproducthomepage')}}" class="nav-link">Products</a></li>
                    <li class="nav-item"><a href="{{route('homepage-dealer')}}" class="nav-link ">Dealers</a></li>
                    <li class="nav-item"><a href="{{route('homepage-mechanic')}}" class="nav-link">Mechanics</a></li>                    
                    <li class="nav-item"><a href="{{ route('homepage') }}#about" class="nav-link">About Us</a></li>
                </ul>

                
            
            </div>


          <div class="collapse navbar-collapse justify-content-end" id="mynavbar">
    <div class="dropdown">
        <img src="{{asset($user->profile_image)}}" class="rounded-circle dropdown-toggle" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" width="40" height="40">
        
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown" style="right: 0; left: auto;">
            <a class="dropdown-item" href="{{route('dashboard')}}"><i class="bi bi-house-door-fill"></i> Dashboard</a>
            <a class="dropdown-item" href="{{route('logout')}}"> <i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>
</div>


            </nav>
            
        </div>
        
    </div>
    
</div>
</body>
</html>