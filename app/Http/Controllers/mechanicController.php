<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\mechanic;


class mechanicController extends Controller
{
    //
     public function viewall(){
    	$record = mechanic::get();

    //return $record;
    return view('admin.mechanic', ['data'=>$record]);
    	//return view('admin.car_cc');
    }
    public function addnew() {
    	
    return view('admin.add_mechanic');
//return view('admin.products');
    }
    public function create(Request $request){
    	$request->validate([
    'name' => [
        'required',
        Rule::unique('mechanics')->where(function ($query) use ($request) {
            return $query->where('isDeleted', false);
        }),
    ],
]);
    	$product=new mechanic();
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
    $user = mechanic::find($id);

    if ($user) {
    	if ($user->isDeleted) {
            // User has already been deleted, redirect back to the user list page
            return redirect()->route('mechanic')->with('fail', 'This is already been deleted!');
        }
        // Set isDeleted to true
        $user->isDeleted = true;

        // Save the changes to the database
        $user->save();

        // Redirect back to the user list page
        return redirect()->route('mechanic')->with('success', 'Record deleted successfully!');
    } else {
        // User not found, redirect back to the user list page
        return redirect()->route('mechanic')->with('fail', 'Record not found!');
    }
}

public function edit($id){
$product = mechanic::findOrFail($id);
 if ($product->isDeleted) {
        return redirect()->route('mechanic')->with('fail', 'Cannot Edit Deleted Record!');
    }
    //return $product;
    return view('admin.edit_mechanic', compact('product'));
}

public function update(Request $request, $id)
    {
        $product = mechanic::findOrFail($id);
$request->validate([
    'name' => [
        'required',
        Rule::unique('mechanics')->where(function ($query) use ($request) {
            return $query->where('isDeleted', false);
        }),
    ],
     
]);

        $product->name = $request->input('name'); 
        // Set any other fields that can be updated

        $product->save();

        return redirect()->route('mechanic')->with('success','Record Updated Successfully!');
    }

}
