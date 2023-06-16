<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\shopMechanic;
use App\Models\shop;
use App\Models\slot;
use Illuminate\Http\Request;
use Carbon\Carbon;

class slotController extends Controller
{
    //
    public function viewall(Request $request){

$record = shopMechanic::where('isDeleted', false)->get();
    $user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
    	return view('mechanic.slot', compact('shop','record'));
    }
    else{ 
    	abort(404, 'Page Not Found');
    }
    }

public function viewallslots(Request $request, $id){
	$mec=shopMechanic::where('id','=', $id)
             ->where('isDeleted', false)
             ->first();

$user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
$record = slot::where('isDeleted', false)
    ->where('mechanic_id', $id)
    ->where('shop_id', $shop->id)
    ->get();
    
             if ($shop) {
    	return view('mechanic.time_slot', compact('shop','record','mec'));
    }
    else{
    	abort(404, 'Page Not Found');
    }
    }

    public function manageslots(Request $request,$id){



     $currentDate = Carbon::now('Asia/Karachi')->format('Y-m-d');
$carbonDate = Carbon::parse($currentDate);
  //$day = $currentDate->day;
  $dayName = $carbonDate->format('l');

$timeSlots = [];

$user_id = $request->session()->get('loginId');
$shop = shop::where('user_id', $user_id)
    ->where('isDeleted', false) 
    ->first(); 
   $days = unserialize($shop->days);
   if (in_array($dayName, $days)) {
    // Current day name exists in the array
    
$openingTime = $shop->openTime;
$closingTime = $shop->closeTime;
$interval = \DateInterval::createFromDateString('30 minutes');

$openingDateTime = \DateTime::createFromFormat('H:i:s', $openingTime);
$closingDateTime = \DateTime::createFromFormat('H:i:s', $closingTime);

$slots = slot::where('isDeleted', false)
    ->where('mechanic_id', $id)
    ->where('date', $currentDate)
    ->where('shop_id', $shop->id)
    ->where('status', '!=', 'Available')
    ->get();

// Collect the disabled slot times in an array
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

// Generate the time slots array within the opening and closing time range
foreach (new \DatePeriod($openingDateTime, $interval, $closingDateTime) as $slot) {
    $timeSlot = $slot->format('H:i');

    // Check if the time slot is not disabled
    if (!in_array($timeSlot, $disabledSlotTimes)) {
        $timeSlots[] = $timeSlot;
    }
}

$mechanic = $id;

return view('mechanic.manage_time_slot', compact('timeSlots', 'shop', 'mechanic','currentDate'));

   
}
else{

	return redirect()->route('timeslot',['id' => $id])->with('fail','Today Shop is Closed!');
}
 }

    public function create(Request $request, $id){
    	 $selectedSlots = $request->input('selectedSlots');
    	


    	$pakistanDateTime = Carbon::now('Asia/Karachi');
$currentDateTime = $pakistanDateTime->format('Y-m-d H:i:s');
  $currentDateTimeCarbon = Carbon::createFromFormat('Y-m-d H:i:s', $currentDateTime);
$currentDate = $pakistanDateTime->format('Y-m-d');
    	
       // Update the slot model based on the selected slot
    	 	$product=new slot();
        
        
            $product->slot = 1;
             // Set the slot value to 1 (assuming it becomes busy)
            $product->date = Carbon::now('Asia/Karachi')->toDateString();
          $product->slot_time = Carbon::parse($selectedSlots)->format('Y-m-d H:i:s');
           $product->slot_time = Carbon::createFromFormat('Y-m-d H:i:s', $product->slot_time);
//return $slotDateTime = Carbon::parse($currentDate . ' ' . $product->slot_time);
if($product->slot_time->greaterThan($currentDateTimeCarbon)){
            $product->mechanic_id=$id;
            $user_id = $request->session()->get('loginId');
$shop = shop::where('user_id', $user_id)
    ->where('isDeleted', false)
    ->first();
    $product->shop_id=$shop->id;

            $product->status = 'Busy'; // Update the status
            $product->save();

        
    
    return redirect()->route('timeslot',['id' => $id])->with('success','Record Updated Successfully!');
    }
    else{
    	return redirect()->route('timeslot',['id' => $id])->with('fail','You Can Update Only Slots that are Greater Than Current Time!');
    }
}



public function delete(Request $request, $id){
	$pakistanDateTime = Carbon::now('Asia/Karachi');
$currentDateTime = $pakistanDateTime->format('Y-m-d H:i:s');
 $currentDateTimeCarbon = Carbon::createFromFormat('Y-m-d H:i:s', $currentDateTime);
$currentDate = $pakistanDateTime->format('Y-m-d');

$currentDateTime;
//

$pakistanDateTime = Carbon::now('Asia/Karachi');
$currentDateTime = $pakistanDateTime->format('Y-m-d H:i:s');

//


$slot1=slot::where('isDeleted',false)
->where('id',$id)
->first();

$slot= slot::where('isDeleted', false)
    ->where('id', $id)
    ->where('date', $currentDate)
    ->where('status', '=', 'Busy')
    ->first();
    if($slot){
$slotDateTime = Carbon::parse($slot->date . ' ' . $slot->slot_time);

if($slotDateTime->greaterThan($currentDateTimeCarbon)){


	$minutesDifference = $slotDateTime->diffInMinutes($currentDateTimeCarbon);

if ($currentDateTimeCarbon->diffInMinutes($slotDateTime) >= 10) {
     
    	//return $currentDateTime->diffInMinutes($slotDateTime);
        $slot->status = 'Available';

        $slot->save();
        return redirect()->route('timeslot',['id' => $slot->mechanic_id])->with('success','Record Updated Successfully!');
    }
    else{
    	return redirect()->route('timeslot',['id' => $slot->mechanic_id])->with('fail','Time Exceeded To Update!');
    }
}
else{
    	return redirect()->route('timeslot',['id' => $slot->mechanic_id])->with('fail','You Cant Update!');
    }

//return $minutesDifference;
//return "good a g";
//return $currentDateTime;
// return "<br>";
// return "good";
    	//return "good";
    //$slotDateTime = Carbon::parse($slot->date . ' ' . $slot->slot_time);
    	// $slot->slot_time;
   

//return $slotDateTime;

 

    
}
else{
	//return $slot1->mechanic_id;
	return redirect()->route('timeslot',['id' => $slot1->mechanic_id])->with('fail','You Cannot Update Appointment!!');
}

}
}
