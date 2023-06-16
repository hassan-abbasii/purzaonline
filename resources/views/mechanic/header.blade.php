<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-ZVZl6Fpdn8VaxWkHv2rV9X6+u/Q8fBH5hzkmvE3qgCYN5Q5vdTwgvWxLhJCLp9XmRFGy5hW+d73Jupkq3C1Z3Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{ asset('css/mechanic/header.css') }}">
   
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/css/bootstrap.css') }}">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css”/> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    
    <title>Header</title> 
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-black fixed-top">
  <a class="navbar-brand" href="#"><img src="{{ asset('images/admin/logo1.png') }}" alt="Logo" width="80" height="40" ></a>
  <button class="navbar-toggler d-md-none bg-dark" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center d-none d-md-block" id="navbarNavDropdown">
    <span class="text-light">{{ $shop->name }}</span>
  </div>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">

          <a class="nav-link nav-icon d-none d-md-block" href="#" data-toggle="dropdown" >
            <i class="bi bi-bell-fill fa-1x"></i>
             
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header justify-content-center">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
             <img src="{{asset('images/avatar.png')}}" class="rounded-circle" width="50" height="50">
             
              <div>
                <h4 class="text-info">Lorem Ipsumjkjdfjkdsfjhfsdabbasi abbasi abbasi abbasi</h4>
                <p class="p11"> Lorem Ipsumjjdjhdhsjhdjshdjhjshdhsjdhsdhshjdhsjhabbbababasiiii </p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
             <img src="{{asset('images/avatar.png')}}" class="rounded-circle" width="50" height="50">
             
              <div>
                <h4 class="text-info">Atque rerum nesciunt</h4>
                <p class="p11">Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <img src="{{asset('images/avatar.png')}}" class="rounded-circle" width="50" height="50">
             
              <div>
                <h4 class="text-info">Sit rerum fuga</h4>
                <p class="p11">Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <img src="{{asset('images/Whatsap.jpg')}}" class="rounded-circle" width="50" height="50">
              <div>
                <h4 class="text-info">Dicta reprehenderit</h4>
                <p class="p11">Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle profile-menu" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="{{ asset($shop->image) }}" alt="Profile Image" class="rounded-circle" width="40" height="40">
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-sm" aria-labelledby="navbarDropdownMenuLink">
            <a href="{{ route('mechanic_dashboard') }}" class="dropdown-item"><i class="bi bi-house"></i> Dashboard</a>
          <a class="dropdown-item" href="{{route('logout')}}"> <i class="bi bi-box-arrow-left"></i> Logout</a>

        </div>
      </li>
    </ul>
  </div>
</nav>



 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNSbNIV" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Bootstrap JavaScript -->
 
 <script type="text/javascript">
   var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
  return new bootstrap.Dropdown(dropdownToggleEl);
});
$(document).ready(function() {
  // Toggle the profile menu on click
  $('.nav-link.profile-menu').click(function() {
    $(this).siblings('.dropdown-menu').toggle();
  });
});
 </script>
</body>
</html>
