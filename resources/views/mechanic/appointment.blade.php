<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-ZVZl6Fpdn8VaxWkHv2rV9X6+u/Q8fBH5hzkmvE3qgCYN5Q5vdTwgvWxLhJCLp9XmRFGy5hW+d73Jupkq3C1Z3Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!----======== CSS ======== -->
 <link rel="stylesheet" href="{{asset('css/mechanic/mechanic_profile.css')}}">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" /> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
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
                        <h1 class="h3 mb-0 text-gray-800 head1"><i class="bi bi-person-fill"></i> Appointments</h1>
                         <p style="color: #adb5bd;">(Detail of All Appointments that customers have made)</p>
                       </div>
                       <div class="global-flex-new justify-content-center">
     
     @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
  </div>
                        <a href="{{route('allblockedappointment')}} " class=" d-sm-inline-block btn   btn-primary shadow-sm"><i
                                class="bi bi-person-fill"></i>Blocked Users </a>
                    </div>
                     <!-- Content Row -->
                   
<div class="aboutdiv-heading-border4"></div>
                    <div class="row car-record justify-content-center">
                       
                      <h2>All Appointments</h2>
                      <div class="global-flex-new justify-content-center align-items-center">
                        <input type="text" id="myInput" class="form-control w-50" placeholder="Filter Results Here..." name="">
                    
                      </div>
                      <div class=" reserve-head1  mt-1">
            
            <div class="row justify-content-center">
              @forelse($record as $rec)
              <div class="col-md-3 my-1  ">
              <div class="app-card">
                <div class="global-flex1">
                <img src="{{asset($rec->users->profile_image)}}">
                <div class="global-flex-col">
                <h5 class="nameee">{{$rec->users->name}}</h5> 
                <p class="stttatus"><i class="bi bi-pc-display-horizontal  mx-2"></i> @if ($rec->status == 'Booked')
    <span class="badge bg-success">Booked</span>
  @elseif ($rec->status == 'Canceled')
    <span class="badge bg-warning">Canceled</span>
  @else
    <span class="badge bg-danger">Rejected</span>
  @endif</p>
              </div>
              </div>
                <div class="global-flex1">
                <p class="s000"><i class="bi bi-car-front "></i> {{$rec->sarvice->CarCc->name}}</p><p class="mx-2  s111">{{$rec->sarvice->mechanicService->service}}</p><p class="s222">{{$rec->sarvice->mechanicService->service_category}}</p></div>
                <div class="global-flex1">
                <p class="dateee"><i class="bi bi-calendar2 "></i> {{$rec->date}}</p>
                <p class="mx-2"><i class="bi bi-clock slottt"></i> {{$rec->slot->slot_time}}</p></div>
                <div>
                  <p><i class="bi bi-person-fill"></i><span class="mx-2 meccc">{{$rec->slot->shopMechanic->name}}</span></p>
                </div>
                <div class="global-flex justify-content-center"><a href="{{route('shopappointmentdetail',['id' => $rec->id])}} "><button class="btn btn-sm btn-outline-primary">View detail</button></a><a href="{{route('rejectappointment',['id' => $rec->id])}} "><button class="btn btn-sm btn-danger mx-2">Reject</button></a><a href="{{route('deleteshopappointment',['id' => $rec->id])}}  "><button class="btn btn-sm btn-secondary"><i class="bi bi-trash"></i></button></a></div>

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
            var date = card.getElementsByClassName("dateee")[0];
            var slot = card.getElementsByClassName("slottt")[0];
            var mechanic = card.getElementsByClassName("meccc")[0].textContent.toLowerCase();

            if (
                name.includes(filter) ||
                status.textContent.toLowerCase().includes(filter) ||
                engine.classList.contains(filter) ||
                service1.includes(filter) ||
                service2.includes(filter) ||
                date.textContent.toLowerCase().includes(filter) ||
                slot.classList.contains(filter) ||
                mechanic.includes(filter)
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
