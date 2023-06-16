<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\carService;
use Illuminate\Http\Request;

class carServiceController extends Controller
{
    //
     public function viewall(){
    	$record = carService::get();

    //return $record;
    return view('admin.car_service', ['data'=>$record]);
    	//return view('admin.car_cc');
    }

    public function addnew() {
    	
    return view('admin.add_car_service');
//return view('admin.products');
    }

    public function create(Request $request){
    	$request->validate([
    'name' => [
        'required',
        Rule::unique('car_services')->where(function ($query) {
            return $query->where('isDeleted', false);
        })
    ],
]);
    	$product=new carService();
    	$product->name = $request->name;
    	$res=$product->save();
 if($res){
 	return back()->with('success','Record Entered Successfully');
 }
 else{
 	return back()->with('fail','Something went wrong');
 }
    }

    public function delete($id) {
    // Retrieve the user by ID
    $user = carService::find($id);

    if ($user) {
    	if ($user->isDeleted) {
            // User has already been deleted, redirect back to the user list page
            return redirect()->route('carservice')->with('fail', 'This is already been deleted!');
        }
        // Set isDeleted to true
        $user->isDeleted = true;

        // Save the changes to the database
        $user->save();

        // Redirect back to the user list page
        return redirect()->route('carservice')->with('success', 'Record deleted successfully!');
    } else {
        // User not found, redirect back to the user list page
        return redirect()->route('carservice')->with('fail', 'Record not found!');
    }
}
public function edit($id){
$product = carService::findOrFail($id);
 if ($product->isDeleted) {
        return redirect()->route('carservice')->with('fail', 'Cannot Edit Deleted Record!');
    }
    //return $product;
    return view('admin.edit_car_service', compact('product'));
}
public function update(Request $request, $id)
    {
        $product = carService::findOrFail($id);
$request->validate([
    'name' => [
        'required',
        Rule::unique('car_services')->where(function ($query) {
            return $query->where('isDeleted', false);
        })
    ],
]);

        $product->name = $request->input('name'); 
        // Set any other fields that can be updated

        $product->save();

        return redirect()->route('carservice')->with('success','Record Updated Successfully!');
    }

}
