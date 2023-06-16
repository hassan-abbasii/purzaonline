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
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" /> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    
    <title>CarOwner Sidebar Menu</title> 
</head>
<body>
 
 
    <div class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <!--<img src="logo.png" alt="">-->
                </span>

                <div class="text logo-text">
                    <span class="name">Purza Online</span>
                </div>
             
 
             <i class='bx bx-chevron-right toggle'></i></div>
        </header>

        <div class="menu-bar">
            <div class="menu " style="float: left;">

                

                <ul class="menu-links">
                    <li class="nav-link  ">
                        <a href="{{ route('dashboard') }}"  class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class='bi bi-person-fill icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    
                     
                    <li class="nav-link ">
                        <a href="{{route('carprofile')}}"  class="">
                            <i class="bi bi-credit-card icon"></i> 
                            <span class="text nav-text">Car Profile</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('userapp') }} " class="{{ request()->routeIs('userapp') ? 'active' : '' }}">
                            <i class="bi bi-card-checklist icon"></i>
                            <span class="text nav-text">Appointment</span>
                        </a>
                    </li>
                    <li class="nav-link ">
                        <a href="{{route('allqueries')}}" class="{{ request()->routeIs(['allqueries','addservice','editservice']) ? 'active' : '' }}">
                            <i class="bi bi-patch-question-fill icon"></i>
                            <span class="text nav-text">Product Queries</span>
                        </a>
                    </li>
                    <li class="nav-link ">
                        <a href="{{route('viewreserve')}}" class="{{ request()->routeIs(['viewreserve','detailreservation','detailreservation']) ? 'active' : '' }}">
                            <i class="bi bi-receipt icon"></i>
                            <span class="text nav-text">Reservations</span>
                        </a>
                    </li>

                    <li class="nav-link ">
                        <a href="{{route('alluserrev')}}" class="{{ request()->routeIs(['alluserrev','managetimeslot','timeslot','slotupdate']) ? 'active' : '' }}">
                            <i class='bi bi-star icon'></i>
                            <span class="text nav-text">Reviews</span>
                        </a>
                    </li>

                     

                     <br>
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
