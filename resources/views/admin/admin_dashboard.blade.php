<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-ZVZl6Fpdn8VaxWkHv2rV9X6+u/Q8fBH5hzkmvE3qgCYN5Q5vdTwgvWxLhJCLp9XmRFGy5hW+d73Jupkq3C1Z3Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!----======== CSS ======== -->
 
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css”/> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="css/admin/dashboard.css" rel="stylesheet">

    
    <title>Dashboard</title> 
</head>
<body>
   <div class="container-fluid">
 <div>
@include('admin.header')
 </div>
<div>
@include('admin.sidebar')
  <div class="home">
    <div class="container-fluid">
               <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 head1">Dashboard</h1>
                         
                    </div> 
                     <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4 ">
                            <div class="card border-start border-5 border-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs head2 font-weight-bold text-secondary text-uppercase mb-1">
                                                ALl Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> 40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-person-lines-fill fa-3x text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

<!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-start border-5 border-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs head2 font-weight-bold text-info text-uppercase mb-1">
                                                Total Shops</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">220</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-shop fa-3x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-start border-5 border-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs head2 font-weight-bold text-success text-uppercase mb-1">
                                             Car-CC Record</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">15</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-gear fa-3x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Earnings (Monthly) Card Example -->
                       
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-start border-5 border-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs head2 font-weight-bold text-danger text-uppercase mb-1">
                                             Spare Parts Added</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">15</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-battery-charging fa-3x text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-start border-5 border-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs head2 font-weight-bold text-primary text-uppercase mb-1">Cars Added
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0  ml-3 mr-3 font-weight-bold text-gray-800">11</div>
                                                </div>
                                                <div class="col">
                                                     
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-minecart fa-3x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <!-- Earnings (Monthly rev) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4 ">
                            <div class="card border-start border-5 border-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs head2 font-weight-bold text-warning text-uppercase mb-1">
                                                Total Reviews</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">50</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-star fa-3x text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-start border-5 border-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs head2 font-weight-bold text-dark text-uppercase mb-1">Car Services Added
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0  ml-3 mr-3 font-weight-bold text-gray-800">40</div>
                                                </div>
                                                <div class="col">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-gear-wide fa-3x text-dark"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                          <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-start border-5 border-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs head2 font-weight-bold text-info text-uppercase mb-1">
                                                Mechanics</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">22</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-person-fill fa-3x text-gray"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-start border-5 border-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs head2 font-weight-bold text-secondary text-uppercase mb-1">
                                                NMechanic Services</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-tools fa-3x text-gray"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-start border-5 border-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs head2 font-weight-bold text-danger text-uppercase mb-1">
                                                Feature Ad Plans</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-badge-ad fa-3x text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>







                        <!-- Row Div End -->
                    </div>
                     
   
                                <!-- Card Header - Dropdown -->
                               
                                <!-- End-->
  


</div>
</div>
</div>
 
  <!-- Bootstrap JavaScript -->
 </div>
</body>
</html>
