<?php

namespace App\Http\Controllers;

use App\Rules\UniqueFieldsRuleM;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\service;
use App\Models\CarCc;
use App\Models\shop;
use App\Models\mechanicService;
use App\Models\shopMechanic;
use Illuminate\Http\Request;

class serviceController extends Controller
{
    // 
     public function viewall(Request $request){
    $services = service::with('CarCc', 'shopMechanic','mechanicService')->get();
    $user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
    	return view('mechanic.service', compact('shop','services'));
    }
    }

    //adding new record
    public function addnew(Request $request) {
//
    	$cars = CarCc::where('isDeleted', false)->get();
    	$services = mechanicService::where('isDeleted', false)->get();
    	$mechanics=shopMechanic::where('isDeleted', false)->get();
//



    	$user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();


             if ($shop) {
    return view('mechanic.add_service',compact('shop','mechanics','cars','services'));
//return view('admin.products');
    }
}


public function create(Request $request){

             $service = $request->name;
$serviceCategory = $request->category;


             $row = mechanicService::where('service', $service)
    ->where('service_category', $serviceCategory)
    ->where('isDeleted', false)
    ->first();
    	$user_id=$request->session()->get('loginId');
    $shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
    	
$validator = Validator::make($request->all(), [
    'price' => [
        'required',
        new UniqueFieldsRuleM( $request->car_cc_id, $request->mechanic, $row->id, $shop->id),
    ],
    'hour' => [
        'required',
        new UniqueFieldsRuleM( $request->car_cc_id, $request->mechanic, $row->id, $shop->id),
    ],
]);

if ($validator->fails()) {
	return back()->with('fail','Duplicate Record  NOt Allowed');
	}
	else{

$timeSlots = [];

$openingTime = $shop->openTime;
$closingTime = $shop->closeTime;
$interval = \DateInterval::createFromDateString('30 minutes');

$openingDateTime = \DateTime::createFromFormat('H:i:s', $openingTime);
$closingDateTime = \DateTime::createFromFormat('H:i:s', $closingTime);

$currentTime = $openingDateTime;
while ($currentTime <= $closingDateTime) {
    $timeSlots[] = $currentTime->format('H:i');
    $currentTime->add($interval);
}
$timeSlotsCount = count($timeSlots);
if($request->hour<=$timeSlotsCount){

    	$product=new service();
    	$product->hour = $request->hour;
    	$product->price=$request->price;
    	$product->cc_id=$request->car_cc_id;
    	$product->mechanic_id=$request->mechanic;
    
    	
             $product->shop_id=$shop->id; 

//
    $product->service_id=$row->id;
//
    	$res=$product->save();
 if($res){
 	return back()->with('success','Record Entered Successfully');
 }
 else{
 	return back()->with('fail','Something went wrong');
 }
}
else{
 	return back()->with('fail','Slot Number Is Much Greater!');
 }
}
}


public function delete($id) {
    // Retrieve the user by ID
    $user = service::find($id);

    if ($user) {
    	if ($user->isDeleted) {
            // User has already been deleted, redirect back to the user list page
            return redirect()->route('service')->with('fail', 'This is already been deleted!');
        }
        // Set isDeleted to true
        $user->isDeleted = true;

        // Save the changes to the database
        $user->save();

        // Redirect back to the user list page
        return redirect()->route('service')->with('success', 'Record deleted successfully!');
    } else {
        // User not found, redirect back to the user list page
        return redirect()->route('service')->with('fail', 'Record not found!');
    }
}


public function edit($id, Request $request){
$services= service::find($id);
 if ($services->isDeleted) {
        return redirect()->route('service')->with('fail', 'Cannot Edit Deleted Record!');
    }

    // Get the saved mechanic ID from the shop_mechanics table
    
    $serviceId = $services->service_id;
    $cc_id=$services->cc_id;
    $mechanic_id=$services->mechanic_id;

    $allmechanic=shopMechanic::where('isDeleted', false)->get();
    $allservice=mechanicService::where('isDeleted', false)->get();
    $allcc=CarCc::where('isDeleted', false)->get();

    //return $product;
  
  

    $user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
    	return view('mechanic.edit_service', [
    'serviceId' => $serviceId,
    'cc_id' => $cc_id,
    'mechanic_id' => $mechanic_id,
    'allmechanic' => $allmechanic,
    'allservice' => $allservice,
    'allcc' => $allcc,
    'services' => $services,
    'shop' => $shop,
]);
}
}



public function update(Request $request, $id)
    {
        $product = service::findOrFail($id);
      $service = $request->name;
$serviceCategory = $request->category;


             $row = mechanicService::where('service', $service)
    ->where('service_category', $serviceCategory)
    ->where('isDeleted', false)
    ->first();
    	$user_id=$request->session()->get('loginId');
    $shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
    	
$validator = Validator::make($request->all(), [
    'price' => [
        'required',
        new UniqueFieldsRuleM( $request->car_cc_id, $request->mechanic, $row->id, $shop->id),
    ],
    'hour' => [
        'required',
        new UniqueFieldsRuleM( $request->car_cc_id, $request->mechanic, $row->id, $shop->id),
    ],
]);
if ($validator->fails()) {
	return back()->with('fail','Duplicate Record  NOt Allowed');
	}
	else{
		$timeSlots = [];

$openingTime = $shop->openTime;
$closingTime = $shop->closeTime;
$interval = \DateInterval::createFromDateString('30 minutes');

$openingDateTime = \DateTime::createFromFormat('H:i:s', $openingTime);
$closingDateTime = \DateTime::createFromFormat('H:i:s', $closingTime);

$currentTime = $openingDateTime;
while ($currentTime <= $closingDateTime) {
    $timeSlots[] = $currentTime->format('H:i');
    $currentTime->add($interval);
}
$timeSlotsCount = count($timeSlots);
if($request->hour<=$timeSlotsCount){
    	 
    	$product->hour = $request->hour;
    	$product->price=$request->price;
    	$product->cc_id=$request->car_cc_id;
    	$product->mechanic_id=$request->mechanic;
    
    	
             $product->shop_id=$shop->id; 

//
    $product->service_id=$row->id;
//
    	$res=$product->save();
 if($res){
 	return redirect('service')->with('success','Record Updated Successfully');
 }
 else{
 	return redirect('service')->with('fail','Something went wrong');
 }
}
else{
 	return back()->with('fail','Slot Number Is Much Greater!');
 }
    }

}
    //
 

}
