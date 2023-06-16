<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
  <!-- Font Awesome CSS -->
  
    <!----======== CSS ======== -->
 <link rel="stylesheet" href="{{asset('css/mechanic/mechanic_profile.css')}}">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
    
    <!----===== Boxicons CSS ===== -->
   
   
    <title>Appointment Detail</title> 
</head>
<body>
   
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
  
               <div class="d-sm-flex align-items-center justify-content-between  ">
                       <div class="global-flex-new1">
                        <h1 class="h3 mb-0 text-gray-800 head1"><i class="bi bi-credit-card"></i>Appointment Detail</h1>
                         <p style="color: #adb5bd;">(Detail of Appointment you have made)</p>
                       </div>
                       <div class="global-flex-new justify-content-center">
     
     @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
  </div>
  <a href="{{route('userapp')}}"><button class="btn btn-primary"><i class="bi bi-credit-card"></i> View All </button></a>
                               </div>
                     <!-- Content Row -->
                   
<div class="aboutdiv-heading-border4"></div>

                    <div class="row justify-content-center">
                      <div class="col-md-5">
                      <div class="div-detail">
                        <table class="table table-striped">
                          <tr>
                          <th colspan="2" class="text-center">Appointment Detail</th></tr>
                          <tr>
                            <td>Appointment Status</td>
                            <td>{{$record->status}}</td>
                          </tr>
                          <tr>
                            <td>Appointment Date</td>
                            <td>{{$record->date}}</td>
                          </tr>
                          <tr>
                            <td>Appointment Time</td>
                            <td>{{$record->slot->slot_time}}</td>
                          </tr>
                          <tr>
                            <td>Appointment Made On</td>
                            <td>{{$record->created_at}}</td>
                          </tr>
                          <tr>
                            <td>Car Engine</td>
                            <td>{{$record->sarvice->CarCc->name}}</td>
                          </tr>
                          <tr>
                            <td>Service</td>
                            <td>{{$record->sarvice->mechanicService->service}}</td>
                          </tr>
                          <tr>
                            <td>Service Category</td>
                            <td>{{$record->sarvice->mechanicService->service_category}}</td>
                          </tr>
                          <tr>
                            <td>Shop Name</td>
                            <td>{{$record->shop->name}}</td>
                          </tr>
                          <tr>
                            <td>Mechanic Name</td>
                            <td>{{$record->slot->shopMechanic->name}}</td>
                          </tr>
                          
                          <tr>
                            <td>User Status</td>
                            <td>@if($check==1)
                              Blocked
                              @else
                               Allowed
                               @endif</td>
                          </tr>
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
 <script>
    // Get the input element
   // Get the input element
var input = document.getElementById("myInput");

// Add an event listener for input changes
input.addEventListener("input", function() {
    var filter = input.value.toLowerCase();

    // Get all the card elements
    var cards = document.getElementsByClassName("app-card");

    // Loop through the cards and hide/show based on the input value
    for (var i = 0; i < cards.length; i++) {
        var card = cards[i];
        var name = card.getElementsByClassName("nameee")[0].textContent.toLowerCase();
        var status = card.getElementsByClassName("stttatus")[0];
        var engine = card.getElementsByClassName("s000")[0];
        var service1 = card.getElementsByClassName("s111")[0].textContent.toLowerCase();
        var service2 = card.getElementsByClassName("s222")[0].textContent.toLowerCase();
        var date = card.getElementsByClassName("dateee")[0].textContent.toLowerCase();

        if (
            name.includes(filter) ||
            status.textContent.toLowerCase().includes(filter) ||
            engine.textContent.toLowerCase().includes(filter) ||
            service1.includes(filter) ||
            service2.includes(filter) ||
            date.includes(filter)
        ) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    }
});
</script>

</body>
</html>
