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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="css/admin/dashboard.css" rel="stylesheet">

    
    <title>All Users</title> 
</head>
<body>
   
 <div>
@include('admin.header')
 </div>
<div>
@include('admin.sidebar')
  <div class="home">
 <div class="container-fluid">
  <div class="global-flex-new justify-content-center">
     
     @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
  </div>
               <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        
                    </div>
                     <!-- Content Row -->
                   
                    <div class="row car-record justify-content-center">
                       
                      <h2>All User Record</h2>
                      <div class="global-flex-new justify-content-center align-items-center">
                        <input type="text" id="myInput" class="form-control w-50" placeholder="What are you looking for?" name="">
                    
                      </div>
                      <div class=" reserve-head1  mt-1">
            <div>
            <table class="table table-striped thead-dark " id="myTable">
                <thead class="bg-dark text-light">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registered On</th>
                    <th>status</th>
                    <th>isDeleted</th>
                    <th>Action</th>
                    
                </thead>

                @foreach($data as $user)
            
       
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->role }}</td>
                  <td>{{ $user->created_at }}</td>
                  <td><span class="badge {{ $user->status === 'Verified' ? 'bg-success' : ($user->status === 'Not Verified' ? 'bg-warning' : 'bg-success') }}">
  {{ $user->status }}
</span>


</td>
                  <td><span class="badge bg-lg {{ $user->isDeleted ? 'bg-danger ' : 'bg-success' }}">
    {{ $user->isDeleted ? 'Deleted' : 'Active' }}
</span></td>
                  <td><div class="global-flex-new justify-content-center"> 
                    <a href="{{ route('deleteUser', ['id' => $user->id]) }}"><button class="btn btn-secondary btn-sm"><i class="bi bi-trash"></i></button></a></div></td>

                </tr>
                  @endforeach
                
            </table>
        </div>
        </div>
                      
                    </div>
         </div>
     </div>
 </div>

     


     <!-- End-->
   </div>
</div>


<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include custom JavaScript file -->
<script src="{{ asset('js/alert.js') }}"></script>
<script src="{{ asset('js/admin/find.js') }}"></script>
</body>
</html>
