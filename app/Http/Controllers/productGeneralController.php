<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\productGeneral;
use Illuminate\Http\Request;

class productGeneralController extends Controller
{
    //
    public function viewparts() {
    	$record = productGeneral::get();

    //return $record;
    return view('admin.products', ['data'=>$record]);
//return view('admin.products');
    }
    public function addpart() {
    	
    return view('admin.add_product');
//return view('admin.products');
    }

    public function create(Request $request){
    	$request->validate([
    'name' => [
        'required',
        Rule::unique('product_generals')->where(function ($query) {
            return $query->where('isDeleted', false);
        })
    ],
]);
    	$product=new productGeneral();
    	$product->name = $request->name;
    	$res=$product->save();
 if($res){
 	return back()->with('success','Record Entered Successfully');
 }
 else{
 	return back()->with('fail','Something went wrong');
 }
    }

    public function deletepart($id) {
    // Retrieve the user by ID
    $user = productGeneral::find($id);

    if ($user) {
    	if ($user->isDeleted) {
            // User has already been deleted, redirect back to the user list page
            return redirect()->route('spareparts')->with('fail', 'This is already been deleted!');
        }
        // Set isDeleted to true
        $user->isDeleted = true;

        // Save the changes to the database
        $user->save();

        // Redirect back to the user list page
        return redirect()->route('spareparts')->with('success', 'Record deleted successfully!');
    } else {
        // User not found, redirect back to the user list page
        return redirect()->route('spareparts')->with('fail', 'Record not found!');
    }
}

public function showedit($id){
$product = productGeneral::findOrFail($id);
 if ($product->isDeleted) {
        return redirect()->route('spareparts')->with('fail', 'Cannot Edit Deleted Record!');
    }
    //return $product;
    return view('admin.edit_product', compact('product'));
}

 public function update(Request $request, $id)
    {
        $product = productGeneral::findOrFail($id);
$request->validate([
    'name' => [
        'required',
        Rule::unique('product_generals')->where(function ($query) {
            return $query->where('isDeleted', false);
        })
    ],
]);

        $product->name = $request->input('name'); 
        // Set any other fields that can be updated

        $product->save();

        return redirect()->route('spareparts')->with('success','Record Updated Successfully!');
    }


}
