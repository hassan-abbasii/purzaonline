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
 
    
    <title>Mechanic Sidebar Menu</title> 
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
                        <a href="{{ route('mechanic_dashboard') }}"  class="{{ request()->routeIs('mechanic_dashboard') ? 'active' : '' }}">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    
                     
                    <li class="nav-link ">
                        <a href="{{ route('shop_profile') }}"  class="{{ request()->routeIs(['shop_profile', 'addshopmechanic', 'add-shopmechanic', 'edit_mechanic_shop']) ? 'active' : '' }}">
                            <i class="bi bi-shop icon"></i> 
                            <span class="text nav-text">Shop</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('shopmechanic') }} " class="{{ request()->routeIs('shopmechanic') ? 'active' : '' }}">
                            <i class="bi bi-person icon"></i>
                            <span class="text nav-text">Mechanics</span>
                        </a>
                    </li>
                    <li class="nav-link ">
                        <a href="{{route('service')}}" class="{{ request()->routeIs(['service','addservice','editservice']) ? 'active' : '' }}">
                            <i class="bi bi-tools icon"></i>
                            <span class="text nav-text">services</span>
                        </a>
                    </li>

                    <li class="nav-link ">
                        <a href="{{route('slot')}}" class="{{ request()->routeIs(['slot','managetimeslot','timeslot','slotupdate']) ? 'active' : '' }}">
                            <i class='bi bi-clock-history icon'></i>
                            <span class="text nav-text">Time Slots</span>
                        </a>
                    </li>

                    <li class="nav-link ">
                        <a href="{{route('shopappointment')}}" class="{{ request()->routeIs('shopappointment') ? 'active' : '' }}">
                            <i class='bx bx-receipt icon'></i>
                            <span class="text nav-text">Appointments</span>
                        </a>
                    </li>

                    <li class="nav-link ">
                        <a href="{{route('shopreview')}}" class="{{ request()->routeIs(['shopreview','replyreview']) ? 'active' : '' }}">
                            <i class="bi bi-star icon"></i>
                            <span class="text nav-text">Reviews</span>
                        </a>
                    </li>

                     
                     

                    <li class="nav-link ">
                        <a href="{{route('runfeatureadm')}}" class="{{ request()->routeIs('runfeatureadm') ? 'active' : '' }}">
                            <i class="bi bi-badge-ad icon" ></i>
                            <span class="text nav-text">Feature Ad</span>
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
