<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\shop;
use App\Models\slot;
use App\Models\service;
use App\Models\mechanicService;
use App\Models\CarCc;
use App\Models\appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;

use Carbon\Carbon;

class appointmentController extends Controller
{
    //
    public function getall(Request $request){
    	$record=appointment::with('sarvice','sarvice.mechanicService','sarvice.CarCc','slot')
->where('user_id',$request->session()->get('loginId'))
->where('isUserDeleted',false)
    	->get();
    	$totalCount = $record->count();
    	return view('all_appointment',compact('record','totalCount'));
    }
    public function appdetail($id){
        $record=appointment::with('sarvice','sarvice.mechanicService','sarvice.CarCc','slot')
->where('id',$id)
        ->first();
        $check=0;
        $blockeduser = appointment::where('userStatus', 'Blocked')
->where('user_id',$record->user_id)
->where('shop_id', $record->shop_id)
        ->exists();
        if($blockeduser){
            $check=1;
        }
        
        return view('appointment_detail',compact('record','check'));
    }
    public function shopappointmentdetail($id,Request $request){
        $record=appointment::with('sarvice','sarvice.mechanicService','sarvice.CarCc','slot')
->where('id',$id)
        ->first();
        $shop=shop::where('user_id',$request->session()->get('loginId'))
        ->where('isDeleted',false)
        ->first();
        $check=0;
        $blockeduser = appointment::where('userStatus', 'Blocked')
->where('user_id',$record->user_id)
        ->exists();
        if($blockeduser){
            $check=1;
        }
        
        return view('mechanic.appointment_detail',compact('record','shop','check'));
    }



    public function block($id,Request $request){
      $shop=shop::where('user_id',$request->session()->get('loginId'))
        ->where('isDeleted',false)
        ->first();
        $appointment=appointment::where('id',$id)->first();
      

        $appointment->userStatus="Blocked";
        $appointment->save();
        return back()->with('success','User Blocked!');  
    }


    public function unblock($id,Request $request){
      $shop=shop::where('user_id',$request->session()->get('loginId'))
        ->where('isDeleted',false)
        ->first();

        $appointment=appointment::where('id',$id)->first();
          $blockeduser = appointment::where('userStatus', 'Blocked')
->where('user_id',$appointment->user_id)
->where('shop_id',$shop->id)
        ->first();
        $blockeduser->userStatus="Allowed";
        $blockeduser->save();
        return back()->with('success','User UnBlocked!');  
    }

    public function allblocked(Request $request){
        $shop=shop::where('user_id',$request->session()->get('loginId'))
        ->where('isDeleted',false)
        ->first();
        $record = appointment::whereIn('id', function ($query) use ($shop) {
    $query->select(DB::raw('MAX(id)'))
        ->from('appointments')
        ->where('userStatus', 'Blocked')
        ->where('shop_id', $shop->id)
        ->groupBy('user_id');
})
->get();

    return view('mechanic.blocked_user',compact('record','shop'));
    }





    public function shopappointment(Request $request){
         $shop=shop::where('user_id',$request->session()->get('loginId'))
        ->where('isDeleted',false)
        ->first();
        $record=appointment::with('sarvice','sarvice.mechanicService','sarvice.CarCc','slot','users')
->where('shop_id',$shop->id)
->where('isDeleted',false)
        ->get();
        if($record){
       
        //return $record->id;
        $totalCount = $record->count();
        return view('mechanic.appointment',compact('record','totalCount','shop'));
    }

    }
    public function view($id){
    	$shop=shop::where('id',$id)
    	->where('isDeleted',false)
    	->first();

    	$services = service::select('cc_id', 'service_id')
    ->distinct()
    ->where('shop_id', $id)
    ->where('isDeleted',false)
    ->get();
    if($services){

$ccIds = $services->pluck('cc_id')->toArray();
$serviceIds = $services->pluck('service_id')->toArray();

$carCcs = CarCc::whereIn('id', $ccIds)->get();
$mechanicServices = mechanicService::whereIn('id', $serviceIds)->get();

$service=service::where('isDeleted',false)
     ->get();
     return view('appointment',compact('shop','carCcs','mechanicServices','service'));
    }
    else{
        return back()->with('fail','Sorry! No Record Against This Shop!');
    }
}

public function create(Request $request, $id){
	$ccid=$request->cc_id;
	$service=$request->service;
	$category=$request->service_category;
	$check=0;
	$mechanicid;
	//return $date=$request->date;
$mechanicService=mechanicService::where('service',$service)
->where('service_category',$category)
->where('isDeleted',false)
->first();
$mec_id=$mechanicService->id;

$mechanicSlot=service::where('isDeleted','false')
->where('service_id',$mec_id)
->where('shop_id',$id)
->first();


$bookSlot=$mechanicSlot->hour;

$mechanicIds = service::select('mechanic_id')
    ->where('cc_id', $ccid)
    ->where('service_id', $mec_id)
    ->where('shop_id', $id)
    ->distinct()
    ->pluck('mechanic_id');

    $shop=shop::where('isDeleted', false)
    ->where('id', $id)
    ->first();
    $days = unserialize($shop->days);

    $date = $request->date;
$carbonDate = Carbon::parse($date);
  $dayName = $carbonDate->format('l');
if (in_array($dayName, $days)){

//

	$openingTime = $shop->openTime;
$closingTime = $shop->closeTime;
$interval = \DateInterval::createFromDateString('30 minutes');

$openingDateTime = \DateTime::createFromFormat('H:i:s', $openingTime);
$closingDateTime = \DateTime::createFromFormat('H:i:s', $closingTime);
	//

$freeSlotsCount = 0;
$selectedMechanicId = null;

foreach ($mechanicIds as $mechanicId) {
	$slots = slot::where('isDeleted', false)
    ->where('mechanic_id', $mechanicId)
    ->where('date', $date)
    ->where('shop_id', $id)
    ->where('status', '!=', 'Available')
    ->get();
    // $slotsCount = slot::where('isDeleted', false)
    //     ->where('mechanic_id', $mechanicId)
    //     ->where('date', $date)
    //     ->where('shop_id',$id)
    //     ->where('status', 'Available')
    //     ->count();
    
///logic
    $timeSlots = [];
$disabledSlotTimes = [];
        foreach ($slots as $slot) {
    $slotTime = $slot->slot_time;
    $slotValue = $slot->slot;

    // Calculate the number of disabled slots based on the slot value
    $disabledSlotsCount = $slotValue - 1;

    // Create a DateTime object for the slot time
    $slotDateTime = \DateTime::createFromFormat('H:i:s', $slotTime);

    // Disable the current slot and the successive slots
    for ($i = 0; $i <= $disabledSlotsCount; $i++) {
        $disabledSlot = clone $slotDateTime;
        $disabledSlot->add(new \DateInterval('PT' . ($i * 30) . 'M'));
        $disabledSlotTime = $disabledSlot->format('H:i');

        // Add the disabled slot time to the array
        $disabledSlotTimes[] = $disabledSlotTime;
    }
}
foreach (new \DatePeriod($openingDateTime, $interval, $closingDateTime) as $slot) {
    $timeSlot = $slot->format('H:i');

    // Check if the time slot is not disabled
    if (!in_array($timeSlot, $disabledSlotTimes)) {
        $timeSlots[] = $timeSlot;
    }
}

        //logic
$timeSlotsCount = count($timeSlots);
if($timeSlotsCount >= $bookSlot){
	$check=1;
	$mechanicid=$mechanicId;

	return view('book_slot', compact('timeSlots','mec_id', 'shop','ccid', 'mechanicid','date','bookSlot','mechanicSlot'));

break;

}

    // if ($slotsCount >= $bookSlot) {
    // 	return $slotsCount;
    //     $freeSlotsCount = $slotsCount;
    //     $selectedMechanicId = $mechanicId;
    //     break; // Exit the loop if a mechanic with more than 4 free slots is found
    // }
}
if($check == 0){
	return back()->with('fail','Sorry! Mechanics Busy Try Some Other Shop');
}

}
else{

	return back()->with('fail','This day Shop is Closed!');
}
}




public function book(Request $request, $id){
	 $selectedSlots = $request->input('selectedSlots');
$pakistanDateTime = Carbon::now('Asia/Karachi');
$currentDateTime = $pakistanDateTime->format('Y-m-d H:i:s');
$currentDateTimeCarbon = Carbon::createFromFormat('Y-m-d H:i:s', $currentDateTime);
$currentDate = $pakistanDateTime->format('Y-m-d');


 

// Update the slot model based on the selected slot
$product = new slot();
  $product->slot = $request->slot;
   $product->date = $request->date;

// Format the selected time
 $selectedTime = Carbon::parse($selectedSlots)->format('H:i:s');

// Combine the formatted date and time
 $combinedDateTime = $product->date . ' ' . $selectedTime;

// Format the combined date and time
 $formattedDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $combinedDateTime);

 $product->slot_time = $formattedDateTime;
//$product->slot_time = $formattedDateTime;



          //   $product->date = $request->date;
          // $product->slot_time = Carbon::parse($selectedSlots)->format('Y-m-d H:i:s');
          //  $product->slot_time = Carbon::createFromFormat('Y-m-d H:i:s', $product->slot_time);

//return $slotDateTime = Carbon::parse($currentDate . ' ' . $product->slot_time);
if($product->slot_time->greaterThan($currentDateTimeCarbon)){
          $product->mechanic_id=$request->mechanic;
            $user_id = $request->session()->get('loginId');
$shop = shop::where('id', $id)
    ->where('isDeleted', false)
    ->first();
    $product->shop_id=$shop->id;
         $blockeduser = appointment::where('userStatus', 'Blocked')
->where('user_id',$request->session()->get('loginId'))
->where('shop_id',$shop->id)
        ->exists();
        if($blockeduser){
            return redirect()->route('shop_details',['id' => $id])->with('fail','Shop Owner Blocked You For Making Appointments!');
        }


            $product->status = 'Appointment'; // Update the status
            $product->save();
$s1=service::where('isDeleted', false)
->where('shop_id',$id)
->where('mechanic_id',$request->mechanic)
->where('service_id',$request->ser)
->where('cc_id',$request->cc)
->first();









        $app=new appointment();
        $app->date=$product->date;
        $app->status='Booked';
        $app->user_id=$request->session()->get('loginId');
         $app->shop_id=$id;
         $app->service_id=$s1->id;
         $app->slot_id=$product->id;
         //return "good";
        $res=$app->save();
         if($res){

    
    return redirect()->route('shop_details',['id' => $id])->with('success','AppointMent SuccessFull!');
    }
}
    else{
    	return redirect()->route('shop_details',['id' => $id])->with('fail','You Can Choose Only Slots that are Greater Than Current Time!');
    	//return back()->with('fail',);
    }
}


public function cancel($id){

$pakistanDateTime = Carbon::now('Asia/Karachi');
$currentDateTime = $pakistanDateTime->format('Y-m-d H:i:s');
  $currentDateTimeCarbon = Carbon::createFromFormat('Y-m-d H:i:s', $currentDateTime);
$currentDate = $pakistanDateTime->format('Y-m-d');

$app=appointment::where('id',$id)->first();
if ($app->status == 'Canceled' || $app->status == 'Rejected' ) {
        return redirect()->route('userapp')->with('fail', 'Appointment Already Canceled!');
    }
$slotid=$app->slot_id;
$slot=slot::where('id',$slotid)->first();
$slotdate=$slot->date;
$slottime=$slot->slot_time;
 $combinedDateTime = $slotdate . ' ' . $slottime;

// Format the combined date and time
 $formattedDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $combinedDateTime);

 $producttime = $formattedDateTime;
if($producttime->greaterThan($currentDateTimeCarbon)){
 $slot->status="Available";
 $slot->save();
 $app->status="Canceled";
 $app->save();
 return redirect()->route('userapp')->with('success', 'AppointMent Cancelled!');
}
else{
	return redirect()->route('userapp')->with('fail', 'Cancellation Time Up!');
}
}

//rejhect
public function reject(Request $request,$id){
   
$pakistanDateTime = Carbon::now('Asia/Karachi');
$currentDateTime = $pakistanDateTime->format('Y-m-d H:i:s');
  $currentDateTimeCarbon = Carbon::createFromFormat('Y-m-d H:i:s', $currentDateTime);
$currentDate = $pakistanDateTime->format('Y-m-d');

$app=appointment::where('id',$id)->first();
if ($app->status == 'Canceled' || $app->status == 'Rejected' ) {
    $app=appointment::where('id',$id)->first();
   
        //$app->isUserDeleted=true;
    //$app->status='Rejected';
    //$app->save();
        return back()->with('fail', 'Canceled Already!');
    }
$slotid=$app->slot_id;
$slot=slot::where('id',$slotid)->first();
$slotdate=$slot->date;
$slottime=$slot->slot_time;
 $combinedDateTime = $slotdate . ' ' . $slottime;

// Format the combined date and time
 $formattedDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $combinedDateTime);
//return "good";
 $producttime = $formattedDateTime;
if($producttime->greaterThan($currentDateTimeCarbon)){
 $slot->status="Available";
 $slot->save();
 $app->status="Rejected";
 $app->save();
 $app=appointment::where('id',$id)->first();
  //  if($app->isUserDeleted == true)
    // return back()->with('fail','Appointment Deleted Already!'); 
    //$app->isUserDeleted=true;
    //$app->status='Rejected';
  //  $app->save();
 return back()->with('success', 'AppointMent Rejected!');
}
else{
    $app=appointment::where('id',$id)->first();
   
        $app->status="Rejected";
    //$app->status='Rejected';
    $app->save();
     //return back()->with('fail','Appointment Deleted Already!'); 
    
    return back()->with('success', 'Appointment Rejected!');
}   }
public function deleteUserApp(Request $request,$id){

$pakistanDateTime = Carbon::now('Asia/Karachi');
$currentDateTime = $pakistanDateTime->format('Y-m-d H:i:s');
  $currentDateTimeCarbon = Carbon::createFromFormat('Y-m-d H:i:s', $currentDateTime);
$currentDate = $pakistanDateTime->format('Y-m-d');

$app=appointment::where('id',$id)->first();
if ($app->status == 'Canceled' || $app->status == 'Rejected' ) {
    $app=appointment::where('id',$id)->first();
   
        $app->isUserDeleted=true;
    //$app->status='Rejected';
    $app->save();
        return redirect()->route('userapp')->with('success', 'Appointment Deleted!');
    }
$slotid=$app->slot_id;
$slot=slot::where('id',$slotid)->first();
$slotdate=$slot->date;
$slottime=$slot->slot_time;
 $combinedDateTime = $slotdate . ' ' . $slottime;

// Format the combined date and time
 $formattedDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $combinedDateTime);
//return "good";
 $producttime = $formattedDateTime;
if($producttime->greaterThan($currentDateTimeCarbon)){
 $slot->status="Available";
 $slot->save();
 $app->status="Canceled";
 $app->save();
 $app=appointment::where('id',$id)->first();
    if($app->isUserDeleted == true)
     return back()->with('fail','Appointment Deleted Already!'); 
    $app->isUserDeleted=true;
    //$app->status='Rejected';
    $app->save();
 return redirect()->route('userapp')->with('success', 'AppointMent Cancelled!');
}
else{
    $app=appointment::where('id',$id)->first();
   
        $app->isUserDeleted=true;
    //$app->status='Rejected';
    $app->save();
     //return back()->with('fail','Appointment Deleted Already!'); 
    
    return redirect()->route('userapp')->with('success', 'Record Deleted!');
}   
}
public function shopdelete(Request $request,$id){
   
$pakistanDateTime = Carbon::now('Asia/Karachi');
$currentDateTime = $pakistanDateTime->format('Y-m-d H:i:s');
  $currentDateTimeCarbon = Carbon::createFromFormat('Y-m-d H:i:s', $currentDateTime);
$currentDate = $pakistanDateTime->format('Y-m-d');

$app=appointment::where('id',$id)->first();
if ($app->status == 'Canceled' || $app->status == 'Rejected' ) {
    $app=appointment::where('id',$id)->first();
   
        $app->isDeleted=true;
    //$app->status='Rejected';
    $app->save();
        return back()->with('success', 'Appointment Deleted!');
    }
$slotid=$app->slot_id;
$slot=slot::where('id',$slotid)->first();
$slotdate=$slot->date;
$slottime=$slot->slot_time;
 $combinedDateTime = $slotdate . ' ' . $slottime;

// Format the combined date and time
 $formattedDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $combinedDateTime);
//return "good";
 $producttime = $formattedDateTime;
if($producttime->greaterThan($currentDateTimeCarbon)){
 $slot->status="Available";
 $slot->save();
 $app->status="Rejected";
 $app->save();
 $app=appointment::where('id',$id)->first();
    if($app->isDeleted == true)
     return back()->with('fail','Appointment Deleted Already!'); 
    $app->isDeleted=true;
    //$app->status='Rejected';
    $app->save();
 return back()->with('success', 'AppointMent Deleted!');
}
else{
    $app=appointment::where('id',$id)->first();
   
        $app->isDeleted=true;
    //$app->status='Rejected';
    $app->save();
     //return back()->with('fail','Appointment Deleted Already!'); 
    
    return back()->with('success', 'Record Deleted!');
}   
}
}
