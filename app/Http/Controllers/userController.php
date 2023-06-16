<?php

namespace App\Http\Controllers;

use App\Models\users;
use App\Models\CarCc;
use App\Models\shop;
use App\Models\service;
use App\Models\carDetail;
use App\Models\product;
use App\Models\favorite;
use App\Models\inventoryProduct;
use App\Models\productGeneral;
use App\Models\mechanicService;
use Illuminate\Http\Request;

class userController extends Controller
{
    //
    public function viewrecord()
{
	$record = users::where('role', '!=', 'admin')->get();

    //return $record;
    return view('admin.allUsers', ['data'=>$record]);
}
public function homepage(){
    $service=service::where('isDeleted',false)->get();
    $cc=CarCc::where('isDeleted',false)->get();
    $mec=mechanicService::where('isDeleted',false)->get();
    $shop=shop::where('isDeleted',false)->get();

    $product=productGeneral::where('isDeleted',false)->get();
    $car=carDetail::where('isDeleted',false)->get();


    return view('homepage',compact('cc','mec','shop','service','car','product'));

}
public function homepagemechanic(Request $request){
    $service=service::where('isDeleted',false)->get();
    $cc=CarCc::where('isDeleted',false)->get();
    $mec=mechanicService::where('isDeleted',false)->get();
    $type="Mechanic";
    $shop=shop::where('isDeleted',false)
    ->where('type',$type)->get();

    $product=productGeneral::where('isDeleted',false)->get();
    $car=carDetail::where('isDeleted',false)->get();
 

    return view('mechanics',compact('cc','mec','shop','service','car','product'));

}
public function homepagedealer(Request $request){
    $service=service::where('isDeleted',false)->get();
    $cc=CarCc::where('isDeleted',false)->get();
    $mec=mechanicService::where('isDeleted',false)->get();
    $type = "Mechanic";
$shop = shop::where('isDeleted', false)
    ->whereNotIn('type', [$type])
    ->get();

    $product=productGeneral::where('isDeleted',false)->get();
    $car=carDetail::where('isDeleted',false)->get();
 

    return view('dealers',compact('cc','mec','shop','service','car','product'));

}


public function deleteUser($id) {
    // Retrieve the user by ID
    $user = users::find($id);

    if ($user) {
    	if ($user->isDeleted) {
            // User has already been deleted, redirect back to the user list page
            return redirect()->route('allusers')->with('fail', 'This User has already been deleted!');
        }
        // Set isDeleted to true
        $user->isDeleted = true;

        // Save the changes to the database
        $user->save();

        // Redirect back to the user list page
        return redirect()->route('allusers')->with('success', 'User deleted successfully!');
    } else {
        // User not found, redirect back to the user list page
        return redirect()->route('allusers')->with('fail', 'User not found!');
    }
}
//search Dealer
public function searchDealer(Request $request){
    if($request->location1 != 'All'){
     $latitude=$request->latitude1;
     $longitude=$request->longitude1;

     $carid=carDetail::where('isDeleted',false)
     ->where('make',$request->make)
     ->where('model',$request->model)
     ->where('variant',$request->variant)
     ->first();

  //  return $request->product;
    $shopId = product::where('car_id', $carid->id)
    ->where('prod_id', $request->product)
    ->where('isDeleted',false)
    ->pluck('shop_id')
    ->unique()
    ->toArray();
    $shopId1 = inventoryProduct::where('car_id', $carid->id)
    ->where('prod_id', $request->product)
    ->where('isDeleted',false)
    ->pluck('shop_id')
    ->unique()
    ->toArray();
    $combinedShopIds = array_merge($shopId, $shopId1);
 $radius = 10;//calculates shop in radius of 10 KiloMetre
$shopIds = shop::whereIn('id', $combinedShopIds)
                 ->select('*')
                 ->selectRaw('(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance', [$latitude, $longitude, $latitude])
                 ->having('distance', '<=', $radius)
                  ->whereIn('type', ['Dealer', 'Dealer*'])
                 ->get();

 if ($shopIds->isEmpty()) {
    // No records found
    return back()->with('fail','No Record Found');
    // Handle the situation here
} else {
    $shops = shop::whereIn('id', $shopIds->pluck('id'))
    ->get();
   // return "good to h";
    return view('search_result_dealer',compact('shops'));
    // Records found
    
    // Proceed with processing the $shops collection
}
  }
  else{
//for all record
     $carid=carDetail::where('isDeleted',false)
     ->where('make',$request->make)
     ->where('model',$request->model)
     ->where('variant',$request->variant)
     ->first();
//return "han bhai";
  //  return $request->product;
    $shopId = product::where('car_id', $carid->id)
    ->where('prod_id', $request->product)
    ->where('isDeleted',false)
    ->pluck('shop_id')
    ->unique()
    ->toArray();

     //dd($shopIds);

    // Alternatively, returning the shop IDs as a response
    //return response()->json($shopIds);
    if (empty($shopId)) {
    // No records found
    return back()->with('fail','No Record Found');
    // Handle the situation here
} else {
    // Records found
    $shops = shop::whereIn('id', $shopId)
    ->get();
   // return "good a g";
    return view('search_result_dealer',compact('shops'));
    // Proceed with processing the $shops collection
}
  }
}
//serach mmechanic
public function searchMechanic(Request $request){
  if($request->location2 != 'All'){
    $latitude=$request->latitude;
     $longitude=$request->longitude;

     $ccid = $request->car_cc;
    $msid=mechanicService::where('isDeleted',false)
    ->where('service',$request->service)
    ->where('service_category',$request->service_category) 
    ->first();
     $msid->id;
     $shopIds = service::where('cc_id', $ccid)
    ->where('service_id', $msid->id)
    ->pluck('shop_id')
    ->unique()
    ->toArray();
 $radius = 10;//calculates shop in radius of 10 KiloMetre
$shopIds = shop::whereIn('id', $shopIds)
                 ->select('*')
                 ->selectRaw('(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance', [$latitude, $longitude, $latitude])
                 ->having('distance', '<=', $radius)
                 ->get();

 if ($shopIds->isEmpty()) {
    // No records found
    return back()->with('fail','Sorry! No Shop Found');
    // Handle the situation here
} else {
    $shops = shop::whereIn('id', $shopIds->pluck('id'))
    ->get();
    return view('search_result',compact('shops'));
    // Records found
    
    // Proceed with processing the $shops collection
}
  }
  else{
//for all record
    $ccid = $request->car_cc;
    $msid=mechanicService::where('isDeleted',false)
    ->where('service',$request->service)
    ->where('service_category',$request->service_category) 
    ->first();
     $msid->id;
    $shopIds = service::where('cc_id', $ccid)
    ->where('service_id', $msid->id)
    ->pluck('shop_id')
    ->unique()
    ->toArray();

     //dd($shopIds);

    // Alternatively, returning the shop IDs as a response
    //return response()->json($shopIds);
    if (empty($shopIds)) {
    // No records found
    return back()->with('fail','Sorry! No Shop Found');
    // Handle the situation here
} else {
    // Records found
    $shops = shop::whereIn('id', $shopIds)
    ->get();
    return view('search_result',compact('shops'));
    // Proceed with processing the $shops collection
}
  }
}
//user dashboard
public function dashboard(Request $request){
    $user= users::where('id', $request->session()->get('loginId'))
    ->first();
      $favorite=favorite::where('user_id',$user->id)
      ->where('isDeleted',false)
      ->get();
    return view('user_dashboard',compact('user','favorite'));
}

public function update(Request $request){
   

   $imageFile = $request->file('image');
if($imageFile){
// Generate a unique filename for the image
$filename = uniqid() . '.' . $imageFile->getClientOriginalExtension();

// Build the path to the source file
$sourcePath = $imageFile->getPathname();

// Build the path to the destination directory
  $destinationPath = public_path('images/');

// Create a copy of the uploaded image file in the destination directory with the new filename
copy($sourcePath, $destinationPath . '/' . $filename);

// Build the path to the stored image file
$imagePath = 'images/' . $filename;
    // Validation failed, handle the response
    
    // You can do something with the errors, such as redirecting back with errors
   // return back()->with('fail','Email Already Taken!');
 
    $product = users::where('id',$request->session()->get('loginId'))
    ->first();
    $product->name=$request->name;
    $product->profile_image=$imagePath;
    $product->save();
    // Validation succeeded, continue with your logic
    // ...
return back()->with('success','Profile Updated!');

}
else{
   return back()->with('fail','Profile Not Updated!'); 
}
}


}
