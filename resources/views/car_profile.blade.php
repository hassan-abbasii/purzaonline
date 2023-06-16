<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
   

    <!----======== CSS ======== -->
 
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    
     
 
 <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
 
    
    <title>Car Profile</title> 
</head>
<body>
   
 <div>

  @if(session()->has('loginId'))
    @include('header_session')
@else
    @include('header')
@endif
 </div>
<div>
@include('sidebar')
  <div class="home">
 <div class="container-fluid">
  
              <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 head1">Car Profile</h1>
                        <a href="{{route('addcarprofile')}}" class=" d-sm-inline-block btn mt-2 btn-primary shadow-sm"><i
                                class="bi bi-credit-card"></i> Add New Car Profile</a>
                    </div>
                     <!-- Content Row -->
                     
                  
                                <!-- Card Header - Dropdown -->
                                
                       <div class="global-flex-new justify-content-center">
     
     @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
  </div>
                      
                    
                     <!-- Content Row -->
                   
<div class="aboutdiv-heading-border4"></div>
 <!-- Earnings (Monthly) Card Example -->
                         

<div class="row">
   <div class="col-xl-3 col-md-6 mb-4 ">
                            <div class="card border-start border-5 border-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs head2 font-weight-bold text-primary text-uppercase mb-1">
                                                Total Expense</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> 40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi-cash-stack fa-3x text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                         <div class="col-xl-3 col-md-6 mb-4 ">
                            <div class="card border-start border-5 border-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs head2 font-weight-bold text-success text-uppercase mb-1">
                                                Total Services</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> 40</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-file-earmark-text fa-3x text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4 ">
                            <div class="card border-start border-5 border-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs head2 font-weight-bold text-warning text-uppercase mb-1">
                                                Next Service Date</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> 2023-06-12</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-calendar fa-3x text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


</div>
                    <div class="row car-record justify-content-center">
                       
                      <h2>Car Profile Record</h2>
                      <div class="global-flex-new justify-content-center align-items-center">
                        <input type="text" id="myInput" class="form-control w-50" placeholder="What are you looking for?" name="">
                    
                      </div>
                      <div class=" reserve-head1  mt-1">
            <div>
            <table class="table table-striped thead-dark " id="myTable">
                <thead class="bg-dark text-light">
                    <th>ID</th>
                    <th>Date</th>
                    <th>Current Mileage</th>
                    <th>Expense</th>
                    <th>Service Name</th>
                    <th>Next Service Date</th>
                    <th>Action</th>
                    
                </thead>
 
               @forelse($record as $part)
            
       
                <tr>
                  <td>{{ $part->id }}</td>
                  <td>{{ $part->service_date }}</td>
                  <td>{{ $part->mileage }}</td>
                   <td>{{ $part->cost }}</td>
                   <td>{{ $part->carService->name }}</td>
                   <td>{{ $part->next_service }}</td>
                  <td><div class="global-flex-new justify-content-center"> 
                    <a href="{{ route('edit-carprofile', ['id' => $part->id]) }}"><button class="btn btn-secondary btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                    <a href="{{ route('delete-carprofile', ['id' => $part->id]) }}"><button class="btn btn-secondary btn-sm"><i class="bi bi-trash"></i></button></a></div></td>

                </tr>
                 @empty
    <tr>
        <p>No records found.</p>
    </tr>
@endforelse
                 
            </table>
        </div>
        </div>
                      
                    </div>
         </div>
</div>
</div>
 

<!-- Include custom JavaScript file -->
<script src="{{ asset('js/alert.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="{{ asset('js/admin/find.js') }}"></script>
</body>
</html>
