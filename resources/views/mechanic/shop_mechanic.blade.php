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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="{{asset('css/mechanic/dashboard.css')}}" rel="stylesheet">

    
    <title>Mechanics Added</title> 
</head>
<body>
   
 <div>
@include('mechanic.header', ['shop' => $shop])
 </div>
<div>
@include('mechanic.sidebar', ['shop' => $shop])
  <div class="home">
 <div class="container-fluid">
  
               <div class="d-sm-flex align-items-center justify-content-between  ">
                       <div class="global-flex-new1">
                        <h1 class="h3 mb-0 text-gray-800 head1"><i class="bi bi-person-fill"></i> All Mechanics</h1>
                         <p style="color: #adb5bd;">(Detail of All Mechanics that are working in your shop)</p>
                       </div>
                       <div class="global-flex-new justify-content-center">
     
     @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
  </div>
                        <a href=" {{ route('addshopmechanic')}}" class=" d-sm-inline-block btn   btn-primary shadow-sm"><i
                                class="bi bi-person-fill"></i> Add New Mechanic</a>
                    </div>
                     <!-- Content Row -->
                   
<div class="aboutdiv-heading-border4"></div>
                    <div class="row car-record justify-content-center">
                       
                      <h2>Shop Mechanics Record</h2>
                      <div class="global-flex-new justify-content-center align-items-center">
                        <input type="text" id="myInput" class="form-control w-50" placeholder="What are you looking for?" name="">
                    
                      </div>
                      <div class=" reserve-head1  mt-1">
            <div>
            <table class="table table-striped thead-dark " id="myTable">
                <thead class="bg-dark text-light">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mechanic Type</th>
                    <th>Total Services</th>
                    <th>isDeleted</th>
                    <th>Action</th>
                    
                </thead>

               @foreach($mechanics as $part)
            
       
                <tr>
                  <td>{{ $part->id }}</td>
                  <td>{{ $part->name }}</td>
                  <td>{{ $part->mechanic->name }}</td>
                  <td>{{ $mechanicCounts[$part->id] }}</td>
                  <td><span class="badge bg-lg {{ $part->isDeleted ? 'bg-danger ' : 'bg-success' }}">
    {{ $part->isDeleted ? 'Deleted' : 'false' }}
</span></td>
                  <td><div class="global-flex-new justify-content-center"> 
                    <a href="{{ route('edit_shopmechanic', ['id' => $part->id]) }}"><button class="btn btn-secondary btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                    <a href="{{ route('deleteshopmechanic', ['id' => $part->id]) }}"><button class="btn btn-secondary btn-sm"><i class="bi bi-trash"></i></button></a></div></td>

                </tr>
                  @endforeach
                
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
