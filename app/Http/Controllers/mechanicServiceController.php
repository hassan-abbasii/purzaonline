<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\mechanicService;
use Illuminate\Http\Request;

class mechanicServiceController extends Controller
{
    //
    public function viewall(){
    	$record = mechanicService::get();

    //return $record;
    return view('admin.mechanic_service', ['data'=>$record]);
    	//return view('admin.car_cc');
    }
    public function addnew() {
    	
    return view('admin.add_mechanic_service');
//return view('admin.products');
    }
    public function create(Request $request){
    	$request->validate([
    'service' => [
        'required',
        Rule::unique('mechanic_services')->where(function ($query) use ($request) {
            return $query->where('service_category', $request->category)
                         ->where('isDeleted', false);
        }),
    ],
    'category' => 'required',
]);
    	$product=new mechanicService();
    	$product->service = $request->service;
    	$product->service_category = $request->category;
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
    $user = mechanicService::find($id);

    if ($user) {
    	if ($user->isDeleted) {
            // User has already been deleted, redirect back to the user list page
            return redirect()->route('mechanicservice')->with('fail', 'This is already been deleted!');
        }
        // Set isDeleted to true
        $user->isDeleted = true;

        // Save the changes to the database
        $user->save();

        // Redirect back to the user list page
        return redirect()->route('mechanicservice')->with('success', 'Record deleted successfully!');
    } else {
        // User not found, redirect back to the user list page
        return redirect()->route('mechanicservice')->with('fail', 'Record not found!');
    }
}

public function edit($id){
$product = mechanicService::findOrFail($id);
 if ($product->isDeleted) {
        return redirect()->route('mechanicservice')->with('fail', 'Cannot Edit Deleted Record!');
    }
    //return $product;
    return view('admin.edit_mechanic_service', compact('product'));
}

public function update(Request $request, $id)
    {
        $product = mechanicService::findOrFail($id);
$request->validate([
    'service' => [
        'required',
        Rule::unique('mechanic_services')->where(function ($query) use ($request) {
            return $query->where('service_category', $request->category)
                         ->where('isDeleted', false);
        }),
    ],
    'category' => 'required',
]);

        $product->service = $request->input('service');
        $product->service_category = $request->input('category'); 
        // Set any other fields that can be updated

        $product->save();

        return redirect()->route('mechanicservice')->with('success','Record Updated Successfully!');
    }


} 
