<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\featureAdPlan;
use Illuminate\Http\Request;

class featureAdPlanController extends Controller
{
    //
    public function viewall(){
    	$record = featureAdPlan::get();

    //return $record;
    return view('admin.feature_ad_plan', ['data'=>$record]);
    	//return view('admin.car_cc');
    }

    public function addnew() {
    	
    return view('admin.add_feature_ad_plan');
//return view('admin.products');
    }

    public function create(Request $request){
      
    	$request->validate([
    'days' => [
        'required',

        Rule::unique('feature_ad_plans')->where(function ($query) {
            return $query->where('isDeleted', false);
        })
    ],
]);
    	$product=new featureAdPlan();
    	$product->days = $request->days;
    	$product->price = $request->price;
    	$product->accountNo = $request->account;
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
    $user = featureAdPlan::find($id);

    if ($user) {
    	if ($user->isDeleted) {
            // User has already been deleted, redirect back to the user list page
            return redirect()->route('featureadplan')->with('fail', 'This is already been deleted!');
        }
        // Set isDeleted to true
        $user->isDeleted = true;

        // Save the changes to the database
        $user->save();

        // Redirect back to the user list page
        return redirect()->route('featureadplan')->with('success', 'Record deleted successfully!');
    } else {
        // User not found, redirect back to the user list page
        return redirect()->route('featureadplan')->with('fail', 'Record not found!');
    }
}

public function edit($id){
$product = featureAdPlan::findOrFail($id);
 if ($product->isDeleted) {
        return redirect()->route('featureadplan')->with('fail', 'Cannot Edit Deleted Record!');
    }
    //return $product;
  
    //return $product->name;
    return view('admin.edit_feature_ad_plan', compact('product'));
}



public function update(Request $request, $id)
    {
        $product = featureAdPlan::findOrFail($id);
$request->validate([
    'days' => [
        'required',

        Rule::unique('feature_ad_plans')->where(function ($query) {
            return $query->where('isDeleted', false);
        })
    ],
]);

       $product->days = $request->days;
    	$product->price = $request->price;
    	$product->accountNo = $request->account;
        // Set any other fields that can be updated

        $product->save();

        return redirect()->route('featureadplan')->with('success','Record Updated Successfully!');
    }

}
