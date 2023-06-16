<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-ZVZl6Fpdn8VaxWkHv2rV9X6+u/Q8fBH5hzkmvE3qgCYN5Q5vdTwgvWxLhJCLp9XmRFGy5hW+d73Jupkq3C1Z3Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!----======== CSS ======== -->
 
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css”/> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="css/admin/dashboard.css" rel="stylesheet">

    
    <title>Dealer Dashboard</title> 
</head>
<body>
   <div class="container-fluid">
 <div>
@include('dealer1.header', ['shop' => $shop])
 </div>
<div>
@include('dealer1.sidebar', ['shop' => $shop])
  <div class="home">
    <div class="container-fluid">
              <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 head1">Dashboard</h1>
                         
                    </div>
                    <div class="d-flex justify-content-center">
                      @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
                    </div>
                    <div class="row">

                      <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4 ">
                            <div class="card border-start border-5 border-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md fw-bold head2 font-weight-bold text-secondary text-uppercase mb-1">
                                                Spare Parts</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> 15</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-person-fill fa-3x text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4 ">
                            <div class="card border-start border-5 border-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md head2 fw-bold font-weight-bold text-primary text-uppercase mb-1">
                                                Appointments Total</div>
                                            <div class="h5 mb-0 fw-bold font-weight-bold text-gray-800"> 145</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-card-checklist fa-3x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4 ">
                            <div class="card border-start border-5 border-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md head2  fw-bold font-weight-bold text-warning text-uppercase mb-1">
                                                Reviews Total</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> 145</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-star fa-3x text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

<!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4 ">
                            <div class="card border-start border-5 border-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md head2 fw-bold font-weight-bold text-info text-uppercase mb-1">
                                                Notifications Total</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> 14</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-bell-fill fa-3x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  Row Ends __-->
                    </div>



</div>
</div>
</div>
 
  <!-- Bootstrap JavaScript -->
 </div>

 <script src="{{ asset('js/alert.js') }}"></script>
<script src="{{ asset('js/mechanic/shop.js') }}"></script>
   <!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
