<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Models\shop;
use App\Models\users;
use App\Models\service;
use App\Models\review;
use App\Models\favorite;
use App\Models\mechanicService;
use Illuminate\Http\Request;

class shopController extends Controller
{
    //
    public function shopinfo(){
    	return view('mechanic.shop_info');
    }
    public function shopInfoDealer(){
        return view('dealer.shop_info');
    }
    //
    public function manageInventory($id, Request $request){
        $shop=shop::where('id',$id)->first();
        $user_id=$request->session()->get('loginId');
        $user=users::where('id',$user_id)->first();
        $user->role="dealer1";
        $user->save();
        $shop->type="Dealer*";
        $shop->save();
        return redirect()->route('dealer1dashboard');

    }
    //
    public function dashboard(Request $request){
$user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
    	return view('mechanic.dashboard', compact('shop'));
    }
    else{
    	 $errorMessage = "No shop record found.";
        return view('auth.login', compact('errorMessage'));
    }
    }
    //dealer dashboard
     public function dealerDashboard(Request $request){
$user_id=$request->session()->get('loginId');
        $shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
        return view('dealer.dashboard', compact('shop'));
    }
    else{
         $errorMessage = "No shop record found.";
        return view('auth.login', compact('errorMessage'));
    }
    }
    public function dealer1dashboard(Request $request){
$user_id=$request->session()->get('loginId');
        $shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
        return view('dealer1.dashboard', compact('shop'));
    }
    else{
         $errorMessage = "No shop record found.";
        return view('auth.login', compact('errorMessage'));
    }
    }
//creating new record
    public function create(Request $request){
    // Retrieve the uploaded image file from the request
$imageFile = $request->file('image');

// Generate a unique filename for the image
$filename = uniqid() . '.' . $imageFile->getClientOriginalExtension();

// Build the path to the source file
$sourcePath = $imageFile->getPathname();

// Build the path to the destination directory
  $destinationPath = public_path('images/mechanic');

// Create a copy of the uploaded image file in the destination directory with the new filename
copy($sourcePath, $destinationPath . '/' . $filename);

// Build the path to the stored image file
$imagePath = 'images/mechanic/' . $filename;
    	
    	$product=new shop();
    	$product->name = $request->name;
       $product->image = $imagePath; 
    	 $product->latitude = $request->latitude;
    	//$request->latitude;
    	$product->longitude = $request->longitude;

    	$selectedDays = $request->input('days');
        if (empty($selectedDays)) {
    // The $selectedDays variable is null or empty
    return back()->with('fail','Please Select at least One day.');
    // Handle the case when no days are selected
}
		$filteredDays = array_filter($selectedDays); // Remove any empty or unchecked values
		$serializedDays = serialize($filteredDays);
		$product->days = $serializedDays; 

    	$product->openTime = $request->open;
    	$product->closeTime = $request->close;
    	$product->closeTime = $request->close;
    	 $product->type = "Mechanic";
    	 $product->status = "Verified";
    	 $product->user_id = $request->session()->get('loginId');
    	$res=$product->save();
 if($res){
 	$user = users::find($request->session()->get('loginId')); // Replace $userId with the actual user ID or any unique identifier

if ($user) {
    // Modify the "status" field
    $user->status = 'Verified'; // Replace 'new_status' with the desired new value

    // Save the changes
    $user->save();
}
$shop = shop::where('user_id',$request->session()->get('loginId') )->first();
$id = $shop->id;

 return redirect()->route('mechanic_dashboard', ['id' => $id])->with('success','Welcome To Purza Online Mechanic Dashboard');
 	 

 }
 else{
 	return back()->with('fail','Something went wrong');
 }
    }

//adding new Dealer shop 
     public function createDealer(Request $request){
    // Retrieve the uploaded image file from the request
$imageFile = $request->file('image');

// Generate a unique filename for the image
$filename = uniqid() . '.' . $imageFile->getClientOriginalExtension();

// Build the path to the source file
$sourcePath = $imageFile->getPathname();

// Build the path to the destination directory
  $destinationPath = public_path('images/dealer');

// Create a copy of the uploaded image file in the destination directory with the new filename
copy($sourcePath, $destinationPath . '/' . $filename);

// Build the path to the stored image file
$imagePath = 'images/dealer/' . $filename;
        
        $product=new shop();
        $product->name = $request->name;
       $product->image = $imagePath; 
         $product->latitude = $request->latitude;
        //$request->latitude;
        $product->longitude = $request->longitude;

        $selectedDays = $request->input('days');
        if (empty($selectedDays)) {
    // The $selectedDays variable is null or empty
    return back()->with('fail','Please Select at least One day.');
    // Handle the case when no days are selected
}
        $filteredDays = array_filter($selectedDays); // Remove any empty or unchecked values
        $serializedDays = serialize($filteredDays);
        $product->days = $serializedDays; 

        $product->openTime = $request->open;
        $product->closeTime = $request->close;
        $product->closeTime = $request->close;
         $product->type = "Dealer";
         $product->status = "Verified";
         $product->user_id = $request->session()->get('loginId');
        $res=$product->save();
 if($res){
    $user = users::find($request->session()->get('loginId')); // Replace $userId with the actual user ID or any unique identifier

if ($user) {
    // Modify the "status" field
    $user->status = 'Verified'; // Replace 'new_status' with the desired new value

    // Save the changes
    $user->save();
}
$shop = shop::where('user_id',$request->session()->get('loginId') )->first();
$id = $shop->id;

 return redirect()->route('dealer_dashboard', ['id' => $id])->with('success','Welcome To Purza Online Spare Part Dealers Dashboard');
     

 }
 else{
    return back()->with('fail','Something went wrong');
 }
    }

    public function shopprofile(Request $request){
$user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
    	//
    	//$shop = shop::find($id);
    	return view('mechanic.shop_profile', compact('shop'));
    }

    }
     public function shopProfileDealer(Request $request){
$user_id=$request->session()->get('loginId');
        $shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
        //
        //$shop = shop::find($id);
        return view('dealer.shop_profile', compact('shop'));
    }

    }
    public function shopProfileDealer1(Request $request){
$user_id=$request->session()->get('loginId');
        $shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
        //
        //$shop = shop::find($id);
        return view('dealer1.shop_profile', compact('shop'));
    }

    }


    public function edit(Request $request){
//$shop = shop::find($id);
 
    $user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
    return view('mechanic.edit_shop_profile', compact('shop'));
}
}

public function editDealer(Request $request){
//$shop = shop::find($id);
 
    $user_id=$request->session()->get('loginId');
        $shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
    return view('dealer.edit_shop_profile', compact('shop'));
}
}

public function editDealer1(Request $request){
//$shop = shop::find($id);
 
    $user_id=$request->session()->get('loginId');
        $shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
    return view('dealer1.edit_shop_profile', compact('shop'));
}
}
//dealer
public function updateDealer(Request $request)
    {
        $user_id=$request->session()->get('loginId');
// Retrieve the uploaded image file from the request
$imageFile = $request->file('image');

// Generate a unique filename for the image
$filename = uniqid() . '.' . $imageFile->getClientOriginalExtension();

// Build the path to the source file
$sourcePath = $imageFile->getPathname();

// Build the path to the destination directory
  $destinationPath = public_path('images/dealer');

// Create a copy of the uploaded image file in the destination directory with the new filename
copy($sourcePath, $destinationPath . '/' . $filename);

// Build the path to the stored image file
$imagePath = 'images/dealer/' . $filename;
        
        $product= shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
        $product->name = $request->name;
       $product->image = $imagePath; 
         $product->latitude = $request->latitude;
        //$request->latitude;
        $product->longitude = $request->longitude;

        $selectedDays = $request->input('days');

if (empty($selectedDays)) {
    // The $selectedDays variable is null or empty
    return back()->with('fail','Please Select at least One day.');
    // Handle the case when no days are selected
}
        $filteredDays = array_filter($selectedDays); // Remove any empty or unchecked values
        $serializedDays = serialize($filteredDays);
        $product->days = $serializedDays; 

        $product->openTime = $request->open;
        $product->closeTime = $request->close;
        $product->closeTime = $request->close;
         $product->type = "Dealer";
         $product->status = "Verified";
         $product->user_id = $request->session()->get('loginId');
        $res=$product->save();
 if($res){
    $user = users::find($request->session()->get('loginId')); // Replace $userId with the actual user ID or any unique identifier

if ($user) {
    // Modify the "status" field
    $user->status = 'Verified'; // Replace 'new_status' with the desired new value

    // Save the changes
    $user->save();
}
$shop = shop::where('user_id',$request->session()->get('loginId') )->first();
$id = $shop->id;

 return redirect()->route('shop_profile_dealer', ['id' => $id])->with('success','Record Updated Successfully');
     

 }
 else{
    return back()->with('fail','Something went wrong');
 }

    }



public function updateDealer1(Request $request)
    {
        $user_id=$request->session()->get('loginId');
// Retrieve the uploaded image file from the request
$imageFile = $request->file('image');

// Generate a unique filename for the image
$filename = uniqid() . '.' . $imageFile->getClientOriginalExtension();

// Build the path to the source file
$sourcePath = $imageFile->getPathname();

// Build the path to the destination directory
  $destinationPath = public_path('images/dealer');

// Create a copy of the uploaded image file in the destination directory with the new filename
copy($sourcePath, $destinationPath . '/' . $filename);

// Build the path to the stored image file
$imagePath = 'images/dealer/' . $filename;
        
        $product= shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
        $product->name = $request->name;
       $product->image = $imagePath; 
         $product->latitude = $request->latitude;
        //$request->latitude;
        $product->longitude = $request->longitude;

        $selectedDays = $request->input('days');

if (empty($selectedDays)) {
    // The $selectedDays variable is null or empty
    return back()->with('fail','Please Select at least One day.');
    // Handle the case when no days are selected
}
        $filteredDays = array_filter($selectedDays); // Remove any empty or unchecked values
        $serializedDays = serialize($filteredDays);
        $product->days = $serializedDays; 

        $product->openTime = $request->open;
        $product->closeTime = $request->close;
        $product->closeTime = $request->close;
         $product->type = "Dealer*";
         $product->status = "Verified";
         $product->user_id = $request->session()->get('loginId');
        $res=$product->save();
 if($res){
    $user = users::find($request->session()->get('loginId')); // Replace $userId with the actual user ID or any unique identifier

if ($user) {
    // Modify the "status" field
    $user->status = 'Verified'; // Replace 'new_status' with the desired new value

    // Save the changes
    $user->save();
}
$shop = shop::where('user_id',$request->session()->get('loginId') )->first();
$id = $shop->id;

 return redirect()->route('shop_profile_dealer1', ['id' => $id])->with('success','Record Updated Successfully');
     

 }
 else{
    return back()->with('fail','Something went wrong');
 }

    }




//end
public function update(Request $request)
    {
    	$user_id=$request->session()->get('loginId');
// Retrieve the uploaded image file from the request
$imageFile = $request->file('image');

// Generate a unique filename for the image
$filename = uniqid() . '.' . $imageFile->getClientOriginalExtension();

// Build the path to the source file
$sourcePath = $imageFile->getPathname();

// Build the path to the destination directory
  $destinationPath = public_path('images/mechanic');

// Create a copy of the uploaded image file in the destination directory with the new filename
copy($sourcePath, $destinationPath . '/' . $filename);

// Build the path to the stored image file
$imagePath = 'images/mechanic/' . $filename;
    	
    	$product= shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
    	$product->name = $request->name;
       $product->image = $imagePath; 
    	 $product->latitude = $request->latitude;
    	//$request->latitude;
    	$product->longitude = $request->longitude;

    	$selectedDays = $request->input('days');
        if (empty($selectedDays)) {
    // The $selectedDays variable is null or empty
    return back()->with('fail','Please Select at least One day.');
    // Handle the case when no days are selected
}
		$filteredDays = array_filter($selectedDays); // Remove any empty or unchecked values
		$serializedDays = serialize($filteredDays);
		$product->days = $serializedDays; 

    	$product->openTime = $request->open;
    	$product->closeTime = $request->close;
    	$product->closeTime = $request->close;
    	 $product->type = "Mechanic";
    	 $product->status = "Verified";
    	 $product->user_id = $request->session()->get('loginId');
    	$res=$product->save();
 if($res){
 	$user = users::find($request->session()->get('loginId')); // Replace $userId with the actual user ID or any unique identifier

if ($user) {
    // Modify the "status" field
    $user->status = 'Verified'; // Replace 'new_status' with the desired new value

    // Save the changes
    $user->save();
}
$shop = shop::where('user_id',$request->session()->get('loginId') )->first();
$id = $shop->id;

 return redirect()->route('shop_profile', ['id' => $id])->with('success','Record Updated Successfully');
 	 

 }
 else{
 	return back()->with('fail','Something went wrong');
 }

    }


    //
    public function getDetailsDealer($id, Request $request){
        $shop=shop::where('id',$id)
        ->first();

$currentDate = Carbon::now('Asia/Karachi');
$day = $currentDate->day;
$dayName = $currentDate->format('l');

$timeSlots = 0;

 

$days = unserialize($shop->days);

if (in_array($dayName, $days)) {
    $timeSlots = 1; // Condition is true, add 1 to the array shop open
} else {
    $timeSlots = 0; // Condition is false, add 0 to the array
}
 

        if($shop){
            if($shop->type !== 'Mechanic' ){
$shopId = $shop->id; // Replace 1 with the desired shop_id

$serviceIds = service::where('shop_id', $shopId)
    ->where('isDeleted', false)
    ->pluck('service_id')
    ->unique()
    ->toArray();
    $mechanicServices = mechanicService::whereIn('id', $serviceIds)->get();
    $review=review::where('isDeleted',false)
->where('shop_id',$id)
->get();
if($review){
$reviewCount = review::where('isDeleted', false)
    ->where('shop_id', $id)
    ->count();
    $averageRating = review::where('isDeleted', false)
    ->where('shop_id', $id)
    ->avg('rating');
    $averageRating = number_format($averageRating, 1);

}
else{
    $reviewCount=0;
    $averageRating=0;
}
$favorite=favorite::where('shop_id',$id)
->where('user_id',$request->session()->get('loginId'))
->where('isDeleted',false)
->first();
if($favorite){
    $favorite1=0;
}
else{
    $favorite1=1;
}

            return view('shop_details_dealer',compact('shop','favorite1','timeSlots','mechanicServices','review','averageRating','reviewCount'));
        }
        
        }
        else{
        abort(404, 'Page Not Found');
    }
    }
//dealer serach 
 public function getdetails($id, Request $request){
        $shop=shop::where('id',$id)
        ->first();

$currentDate = Carbon::now('Asia/Karachi');
$day = $currentDate->day;
$dayName = $currentDate->format('l');

$timeSlots = 0;

 

$days = unserialize($shop->days);

if (in_array($dayName, $days)) {
    $timeSlots = 1; // Condition is true, add 1 to the array
} else {
    $timeSlots = 0; // Condition is false, add 0 to the array
}
 

        if($shop){
            if($shop->type == 'Mechanic'){
$shopId = $shop->id; // Replace 1 with the desired shop_id

$serviceIds = service::where('shop_id', $shopId)
    ->where('isDeleted', false)
    ->pluck('service_id')
    ->unique()
    ->toArray();
    $mechanicServices = mechanicService::whereIn('id', $serviceIds)->get();
$review=review::where('isDeleted',false)
->where('shop_id',$id)
->get();
if($review){
$reviewCount = review::where('isDeleted', false)
    ->where('shop_id', $id)
    ->count();
    $averageRating = review::where('isDeleted', false)
    ->where('shop_id', $id)
    ->avg('rating');
    $averageRating = number_format($averageRating, 1);

}
else{
    $reviewCount=0;
    $averageRating=0;
}
$favorite=favorite::where('shop_id',$id)
->where('user_id',$request->session()->get('loginId'))
->where('isDeleted',false)
->first();
if($favorite){
    $favorite1=0;
}
else{
    $favorite1=1;
}


            return view('shop_details_mechanic',compact('shop','timeSlots','mechanicServices','review','averageRating','reviewCount','favorite1'));
        }
        
        }
        else{
        abort(404, 'Page Not Found');
    }
    }

    //

    //get direction
    public function getdirection($id){
        $shop=shop::where('id',$id)
        ->first();
        if($shop){
return view('get_direction',compact('shop'));
        }
          else{
        abort(404, 'Page Not Found');
    }
    }

    public function allshops(){
        $data=shop::get();
        return view('admin.allshops',compact('data'));
    }
}
