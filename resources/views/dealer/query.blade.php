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
   
   
    <title>Product Queries</title> 
</head>
<body>
   
 <div>
   @include('dealer.header', ['shop' => $shop])
 </div>
<div>
@include('dealer.sidebar', ['shop' => $shop])
  <div class="home">
 <div class="container-fluid">
  
               <div class="d-sm-flex align-items-center justify-content-between  ">
                       <div class="global-flex-new1">
                        <h1 class="h3 mb-0 text-gray-800 head1"><i class="bi bi-patch-question-fill"></i> Product Queries</h1>
                         <p style="color: #adb5bd;">(Respond to customer queries and get connected with more.)</p>
                       </div>
                       <div class="global-flex-new justify-content-center">
     
     @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
  </div>
  <a href="{{route('allblockedquery')}}">
    <button class="btn btn-primary">Blocked Users <i class="bi bi-person"></i></button>
  </a>
                               </div>
                     <!-- Content Row -->
                   
<div class="aboutdiv-heading-border4"></div>
                    <div class="row car-record justify-content-center ">
                       
                      <h2>All Queries</h2>
                      <div class="global-flex-new justify-content-center align-items-center">
                        <input type="text" id="myInput" class="form-control w-50" placeholder="Filter Results Here..." name="">
                    
                      </div>
                      <div class=" reserve-head1  mt-1">
            
            <div class="row ">
              @forelse($record as $rec)
              <div class="col-md-3 my-1  ">
              <div class="app-card">
                <div class="global-flex1">
                <img src="{{asset($rec->users->profile_image)}}">
                <div class="global-flex-col">
                <h5 class="nameee">{{$rec->users->name}}</h5> 
                <p class="stttatus"><i class="bi bi-pc-display-horizontal  mx-2"></i> @if ($rec->status == 'responded')
    <span class="badge bg-success">Responded</span>
  @elseif ($rec->status == 'pending')
    <span class="badge bg-warning">Pending</span>
  @else
    <span class="badge bg-danger">Deleted</span>
  @endif</p>
              </div>
              </div>
                <div class="global-flex1">
                <p class="s000"><i class="bi bi-car-front "></i> {{$rec->products->name}}</p><p class="mx-2  s111">{{$rec->car->make}}</p><p class="s222">{{$rec->car->model}}</p><p class="s222 mx-2">{{$rec->car->variant}}</p></div>
                <p class="dateee"><i class="bi bi-calendar2 "></i> {{$rec->date}}</p>
                <div class="global-flex justify-content-center"><a href="{{route('getrespond',['id' => $rec->id])}}"><button class="btn btn-sm btn-outline-success">Respond</button></a><a href="{{route('detail_query-dealer',['id' => $rec->id])}}"><button class="btn btn-sm btn-outline-primary">View detail</button></a><a href="{{route('deleteq',['id' => $rec->id])}}  "><button class="btn btn-sm btn-secondary"><i class="bi bi-trash"></i></button></a></div>

              </div>
            </div>
              @empty
              <div>
                <p class="d-flex justify-content-center text-gray-800" style="font-family:'poppins',sans-serif; ">No Record To Show</p>
              </div>
              @endforelse
              
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
