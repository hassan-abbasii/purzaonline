@php
    use Illuminate\Support\Facades\Request;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" /> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    
    <title>Dashboard Sidebar Menu</title> 
</head>
<body>
 
 
    <div class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <!--<img src="logo.png" alt="">-->
                </span>

                <div class="text logo-text">
                    <span class="name">PURZA ONLINE</span>
                </div>
             
 
             <i class='bx bx-chevron-right toggle'></i></div>
        </header>

        <div class="menu-bar">
            <div class="menu " style="float: left;">

                

                <ul class="menu-links">
                    <li class="nav-link  ">
                        <a href="{{route('admin')}}"  class="{{ request()->routeIs('admin') ? 'active' : '' }}">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    
                     <li class="nav-link">
                        <a href="{{route('allusers')}} " class="{{ request()->routeIs('allusers') ? 'active' : '' }}">
                            <i class="bi bi-person icon"></i>
                            <span class="text nav-text">All Users</span>
                        </a>
                    </li>
                    <li class="nav-link ">
                        <a href="{{route('allshops')}}" class="{{ request()->routeIs('allshops') ? 'active' : '' }}">
                            <i class="bi bi-shop icon"></i> 
                            <span class="text nav-text">Shops</span>
                        </a>
                    </li>
                    <li class="nav-link ">
                        <a href="{{route('allreviews')}}" class="{{ request()->routeIs('allreviews') ? 'active' : '' }}">
                            <i class="bi bi-star icon"></i>
                            <span class="text nav-text">Reviews</span>
                        </a>
                    </li>

                    <li class="nav-link ">
                        <a href="{{route('spareparts')}}" class="{{ request()->routeIs('spareparts') ? 'active' : '' }}">
                            <i class='bi bi-battery-charging icon'></i>
                            <span class="text nav-text">Spare Parts</span>
                        </a>
                    </li>

                    <li class="nav-link ">
                        <a href="{{route('car')}}" class="{{ request()->routeIs('car') ? 'active' : '' }}">
                            <i class='bi bi-minecart icon'></i>
                            <span class="text nav-text">Cars</span>
                        </a>
                    </li>

                    <li class="nav-link ">
                        <a href="{{route('carCC')}}" class="{{ request()->routeIs('carCC') ? 'active' : '' }}">
                            <i class="bi bi-gear icon"></i>
                            <span class="text nav-text">Car-CC</span>
                        </a>
                    </li>

                    <li class="nav-link ">
                        <a href="{{route('carservice')}}" class="{{ request()->routeIs('carservice') ? 'active' : '' }}">
                            <i class="bi bi-gear-wide icon"></i>
                            <span class="text nav-text">Car Services</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{route('mechanic')}}" class="{{ request()->routeIs('mechanic') ? 'active' : '' }}">
                            <i class="bi bi-person-fill icon"></i>
                            <span class="text nav-text">Mechanics</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{route('mechanicservice')}}" class="{{ request()->routeIs('mechanicservice') ? 'active' : '' }}">
                            <i class="bi bi-tools icon"></i>
                            <span class="text nav-text">Mechanic Services</span>
                        </a>
                    </li>

                    <li class="nav-link ">
                        <a href="{{route('featureadplan')}}" class="{{ request()->routeIs('featureadplan') ? 'active' : '' }}">
                            <i class="bi bi-badge-ad icon" ></i>
                            <span class="text nav-text">Ad PLan</span>
                        </a>
                    </li>
                    
                 <li class="nav-link">
                    <a href="{{route('logout')}}">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
                 <li class="nav-link">
                    <a href="#">
                         
                    </a>
                </li>
                </ul>
            </div>

             
        </div>

    </div>
     
 

    <script>
        const body = document.querySelector('body'),
      sidebar = body.querySelector('.sidebar'),
      toggle = body.querySelector(".toggle"),
  
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");

toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click" , () =>{
    sidebar.classList.remove("close");
})
 
    
    
    </script>
    <script>
        $(".menu-links a").on('click', function () {
            $(".menu-links a.active").removeClass('active');
            $(this).addClass('active');
        });

       
    </script>

</body>
</html>
