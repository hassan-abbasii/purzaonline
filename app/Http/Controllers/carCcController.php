<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\CarCc;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class carCcController extends Controller
{
    //
    public function viewall(){
    	$record = CarCc::get();

    //return $record;
    return view('admin.car_cc', ['data'=>$record]);
    	//return view('admin.car_cc');
    }
 public function addnew() {
    	
    return view('admin.add_cc');
//return view('admin.products');
    }

    public function create(Request $request){
      
    	$request->validate([
    'name' => [
        'required',

        Rule::unique('car_ccs')->where(function ($query) {
            return $query->where('isDeleted', false);
        })
    ],
]);
    	$product=new CarCc();
    	$product->name = $request->name . ' cc';
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
    $user = CarCc::find($id);

    if ($user) {
    	if ($user->isDeleted) {
            // User has already been deleted, redirect back to the user list page
            return redirect()->route('carCC')->with('fail', 'This is already been deleted!');
        }
        // Set isDeleted to true
        $user->isDeleted = true;

        // Save the changes to the database
        $user->save();

        // Redirect back to the user list page
        return redirect()->route('carCC')->with('success', 'Record deleted successfully!');
    } else {
        // User not found, redirect back to the user list page
        return redirect()->route('carCC')->with('fail', 'Record not found!');
    }
}

public function edit($id){
$product = CarCc::findOrFail($id);
 if ($product->isDeleted) {
        return redirect()->route('carCC')->with('fail', 'Cannot Edit Deleted Record!');
    }
    //return $product;
    $product->name = str_replace(' cc', '', $product->name);
    //return $product->name;
    return view('admin.edit_cc', compact('product'));
}

public function update(Request $request, $id)
    {
        $product = CarCc::findOrFail($id);
$request->validate([
    'name' => [
        'required',
        Rule::unique('car_ccs')->where(function ($query) {
            return $query->where('isDeleted', false);
        })
    ],
]);

        $product->name = $request->name . ' cc';
        // Set any other fields that can be updated

        $product->save();

        return redirect()->route('carCC')->with('success','Record Updated Successfully!');
    }

}
