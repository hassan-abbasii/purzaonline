<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<title>Header</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/header.css')}}">

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>
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
					<li class="nav-item  "><a href="{{route('homepage')}}" class="nav-link  ">Home</a></li>
					<li class="nav-item"><a href="{{route('allproducthomepage')}}" class="nav-link">Products</a></li>
					<li class="nav-item"><a href="{{route('homepage-dealer')}}" class="nav-link ">Dealers</a></li>
					<li class="nav-item"><a href="{{route('homepage-mechanic')}}" class="nav-link">Mechanics</a></li>					
					<li class="nav-item"><a href="{{ route('homepage') }}#about" class="nav-link">About Us</a></li>
				</ul>

				
			
			</div>
			<div class="collapse navbar-collapse justify-content-end  " id="mynavbar">
				<a href="{{route('signup')}}"><button class="btn btn-primary mx-md-3 px-4 ">Signup</button></a>
				<a href="{{route('login')}}"><button class="btn btn-primary  px-4 "  >Login</button></a>
				
			</div>
			</nav>
			
		</div>
		
	</div>
	
</div>
</body>
</html>