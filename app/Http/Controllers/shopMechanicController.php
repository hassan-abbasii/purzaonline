<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\shopMechanic;
use App\Models\mechanic;
use App\Models\service;
use App\Models\shop;
use Illuminate\Http\Request;

class shopMechanicController extends Controller
{
    //
    public function viewall(Request $request){
    	$user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
    	$services = service::where('isDeleted', false)
        ->where('shop_id',$shop->id)
    	->get();
$serviceCounts = $services->groupBy(function ($service) {
    return $service->mechanic_id . '-' . $service->shop_id;
})->map(function ($group) {
    return $group->count();
});
    	  $mechanics = shopMechanic::all();

    $mechanicCounts = [];
    foreach ($mechanics as $mechanic) {
        $serviceCounts = service::where('mechanic_id', $mechanic->id)
            ->where('isDeleted', false)
            ->count();

        $mechanicCounts[$mechanic->id] = $serviceCounts;
    }





    	$record = shopMechanic::get();
    	$data = shopMechanic::join('mechanics', 'shop_mechanics.mechanic_id', '=', 'mechanics.id')
    ->where('shop_mechanics.isDeleted', false)
    ->select('shop_mechanics.*', 'mechanics.name')
    ->get();

    
             if ($shop) {
    	return view('mechanic.shop_mechanic', compact('record','data','shop','mechanics','mechanicCounts'));
    }
    	//$type = mechanic::where('isDeleted', false)->get();
    	//$user_id=$request->session()->get('loginId');


    }


    public function addnew(Request $request) {
    	$user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             $mechanics = mechanic::where('isDeleted', false)->get();
             if ($shop) {
    return view('mechanic.add_shop_mechanic',compact('shop','mechanics'));
//return view('admin.products');
    }
}

//
public function create(Request $request){
    	 $request->validate([
    'name' => [
        'required',
        Rule::unique('shop_mechanics')->where(function ($query) use ($request) {
            return $query->where('isDeleted', false);
        }),
    ],
]);
    	$product=new shopMechanic();
    	$product->name = $request->name;
    	$product->mechanic_id=$request->mechanic_id;
    	$user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             $product->shop_id=$shop->id; 
    	$res=$product->save();
 if($res){
 	return back()->with('success','Record Entered Successfully');
 }
 else{
 	return back()->with('fail','Something went wrong');
 }
    }
//
//

     public function delete($id) {
    // Retrieve the user by ID
    $user = shopMechanic::find($id);

    if ($user) {
    	if ($user->isDeleted) {
            // User has already been deleted, redirect back to the user list page
            return redirect()->route('shopmechanic')->with('fail', 'This is already been deleted!');
        }
        // Set isDeleted to true
        $user->isDeleted = true;

        // Save the changes to the database
        $user->save();

        // Redirect back to the user list page
        return redirect()->route('shopmechanic')->with('success', 'Record deleted successfully!');
    } else {
        // User not found, redirect back to the user list page
        return redirect()->route('shopmechanic')->with('fail', 'Record not found!');
    }
}
    //
public function edit($id, Request $request){
$shopMechanic = shopMechanic::find($id);
 if ($shopMechanic->isDeleted) {
        return redirect()->route('shopmechanic')->with('fail', 'Cannot Edit Deleted Record!');
    }

    // Get the saved mechanic ID from the shop_mechanics table
    
    $savedMechanicId = $shopMechanic->mechanic_id;
    //return $product;
  
    	// Retrieve all mechanic records
    $mechanics = mechanic::where('isDeleted', false)->get();

    $user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
    	return view('mechanic.edit_shop_mechanic', compact('mechanics','shopMechanic','savedMechanicId','shop'));
}
}



public function update(Request $request, $id)
    {
        $product = shopMechanic::findOrFail($id);
$request->validate([
    'name' => [
        'required',
        Rule::unique('shop_mechanics')->where(function ($query) use ($request) {
            return $query->where('isDeleted', false);
        }),
    ],
     
]);
$product->name = $request->name;
    	$product->mechanic_id=$request->mechanic_id;
    	$user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             $product->shop_id=$shop->id; 


        //$product->name = $request->input('name'); 
        // Set any other fields that can be updated

        $product->save();

        return redirect()->route('shopmechanic')->with('success','Record Updated Successfully!');
    }


}
