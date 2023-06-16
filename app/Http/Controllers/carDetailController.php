<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\carDetail;
use Illuminate\Http\Request;

class carDetailController extends Controller
{
    // 
     public function viewall(){
    	$record = carDetail::get();

    //return $record;
    return view('admin.car_detail', ['data'=>$record]);
    	//return view('admin.car_cc');
    }

    public function addnew() {
    	
    return view('admin.add_car');
//return view('admin.products');
    }

    public function create(Request $request){
    	$request->validate([
    'make' => [
        'required',
        Rule::unique('car_details')->where(function ($query) use ($request) {
            return $query->where('model', $request->model)
                         ->where('variant', $request->variant)
                         ->where('isDeleted', false);
        }),
    ],
    'model' => 'required',
    'variant' => 'required',
]);
    	$product=new carDetail();
    	$product->make = $request->make;
$product->model = $request->model;
$product->variant = $request->variant;
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
    $user = carDetail::find($id);

    if ($user) {
    	if ($user->isDeleted) {
            // User has already been deleted, redirect back to the user list page
            return redirect()->route('car')->with('fail', 'This is already been deleted!');
        }
        // Set isDeleted to true
        $user->isDeleted = true;

        // Save the changes to the database
        $user->save();

        // Redirect back to the user list page
        return redirect()->route('car')->with('success', 'Record deleted successfully!');
    } else {
        // User not found, redirect back to the user list page
        return redirect()->route('car')->with('fail', 'Record not found!');
    }
}

public function edit($id){
$product = carDetail::findOrFail($id);
 if ($product->isDeleted) {
        return redirect()->route('car')->with('fail', 'Cannot Edit Deleted Record!');
    }
    //return $product;
   
    //return $product->name;
    return view('admin.edit_car', compact('product'));
}

public function update(Request $request, $id)
    {
    	 $product = carDetail::findOrFail($id);
        $request->validate([
    'make' => [
        'required',
        Rule::unique('car_details')->where(function ($query) use ($request) {
            return $query->where('model', $request->model)
                         ->where('variant', $request->variant)
                         ->where('isDeleted', false);
        }),
    ],
    'model' => 'required',
    'variant' => 'required',
]);

       $product->make = $request->make;
 $product->model = $request->model;
$product->variant = $request->variant;
    	 
        // Set any other fields that can be updated

        $product->save();

        return redirect()->route('car')->with('success','Record Updated Successfully!');
    }

}
