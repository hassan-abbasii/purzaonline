<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\carService;
use App\Models\carProfile;
use Illuminate\Http\Request;

class carProfileController extends Controller
{
    //
    public function viewall(Request $request){
$record=carProfile::where('isDeleted',false)
->where('user_id',$request->session()->get('loginId'))
->get();
return view('car_profile',compact('record'));
    }
public function getall(){
	$services=carService::where('isDeleted',false)
	->get();
	return view('add_car_profile',compact('services'));
}
public function create(Request $request){
	$product=new carProfile();
	$product->service_date=$request->date1;
	$product->service_id=$request->service_id;
	$product->mileage=$request->mileage;
	$product->cost=$request->cost;
	$product->next_service=$request->date2;
	$product->user_id=$request->session()->get('loginId');
	$product->save();
	return redirect()->route('carprofile')->with('success','Record Entered Successfully!');
}

public function delete($id) {
    // Retrieve the user by ID
    $user = carProfile::find($id);

    if ($user) {
    	if ($user->isDeleted) {
            // User has already been deleted, redirect back to the user list page
            return redirect()->route('carprofile')->with('fail', 'This is already been deleted!');
        }
        // Set isDeleted to true
        $user->isDeleted = true;

        // Save the changes to the database
        $user->save();

        // Redirect back to the user list page
        return redirect()->route('carprofile')->with('success', 'Record deleted successfully!');
    } else {
        // User not found, redirect back to the user list page
        return redirect()->route('carprofile')->with('fail', 'Record not found!');
    }
}


public function edit($id){
$product = carProfile::findOrFail($id);
 if ($product->isDeleted) {
        return redirect()->route('carprofile')->with('fail', 'Cannot Edit Deleted Record!');
    }
    $services=carService::where('isDeleted',false)
	->get();
    //return $product;
    return view('edit_car_profile', compact('product','services'));
}

public function update(Request $request, $id)
    {
        $product = carProfile::findOrFail($id);
 
$product->service_date=$request->date1;
	$product->service_id=$request->service_id;
	$product->mileage=$request->mileage;
	$product->cost=$request->cost;
	$product->next_service=$request->date2;
	$product->user_id=$request->session()->get('loginId');
	$product->save();

        $product->save();

        return redirect()->route('carprofile')->with('success','Record Updated Successfully!');
    }

}
