<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="{{asset('css/mechanic/mechanic_profile.css')}}">

    <!----======== CSS ======== -->
 
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    
     
 
 <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">

    
    <title>Reservations</title> 
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
                        <h1 class="h3 mb-0 text-gray-800 head1">Product Reservations</h1>
                        
                     <!-- Content Row -->
                     
                  <div class=" justify-content-center w-50">
     
     @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
  </div> 
                                <!-- Card Header - Dropdown -->
                     
                      
         </div>                         
                       
                      
                  
                     <!-- Content Row -->
                   
<div class="aboutdiv-heading-border4"></div>
 <!-- Earnings (Monthly) Card Example -->
                        

 
                    <div class="row car-record justify-content-center">
                       
                      <h2>Reservation Record</h2>
                      <div class="global-flex-new justify-content-center align-items-center">
                        <input type="text" id="myInput" class="form-control w-50" placeholder="What are you looking for?" name="">
                    
                      </div>
                      <div class=" reserve-head1  mt-1">
                        <div class="row justify-content-center">
                           @forelse($record as $rec)
              <div class="col-md-3 my-1  ">
              <div class="app-card">
                <div class="global-flex1">
                <img src="{{asset($rec->shop->image)}}">
                <div class="global-flex-col">
                   
    <h5  class="nameee"><a style="text-decoration: none;" href="{{route('shop_details',['id' => $rec->shop->id])}}">{{$rec->shop->name}}</a></h5>
     
                 
                <p class="stttatus"> @if ($rec->status == 'active')
    <span class="badge bg-success">Active</span>
  @elseif ($rec->status == 'canceled')
    <span class="badge bg-warning">Canceled</span>
  @else
    <span class="badge bg-danger">Expired</span>
  @endif</p>
              </div>
              </div>
                <div class="global-flex1">
                <p class="s000"><i class="bi bi-car-front "></i> {{$rec->product->name}}</p><p class="mx-2  s111">{{$rec->product->products->name}}</p> </div>
                <div class="global-flex1">
                <p class="dateee"><i class="bi bi-calendar2 "></i> {{$rec->created_at}}</p>
                </div>
                <div>
                   
                </div>
                <div class="global-flex justify-content-center"><a href="{{route('detailreservation' ,['id' => $rec->id])}} "><button class="btn btn-sm btn-outline-primary">View detail</button></a><a href="{{route('cancelreserve',['id' => $rec->id])}} "><button class="btn btn-sm btn-danger mx-2">Cancel</button></a><a href="{{route('deletereserve',['id' => $rec->id])}}  "><button class="btn btn-sm btn-secondary"><i class="bi bi-trash"></i></button></a></div>

              </div>
            </div>
              @empty
              <div>
                <p class="d-flex justify-content-center text-gray-800" style="font-family:'poppins',sans-serif; ">No Record To Show</p>
              </div>
              @endforelse
                        </div>
            <div>
             





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
        var date = card.getElementsByClassName("dateee")[0].textContent.toLowerCase();

        if (
            name.includes(filter) ||
            status.textContent.toLowerCase().includes(filter) ||
            engine.textContent.toLowerCase().includes(filter) ||
            service1.includes(filter) ||
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
