<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\shopMechanic;
use App\Models\productGeneral;
use App\Models\carDetail;
use App\Models\shop;
use App\Models\product;

class productController extends Controller
{
    //dealer shop product controller
    //inventory less dealer
    public function view(Request $request){
    	$user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
$product=product::with('car','products')
	->where('shop_id',$shop->id)
->get();

    	return view('dealer.all_part', compact('shop','product'));
    }
    else{
    	 $errorMessage = "No shop record found.";
        return view('auth.login', compact('errorMessage'));
    }
    }
    //get view to add 
    public function getview(Request $request){
    	$user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
$product = productGeneral::where('isDeleted', false)->get();
//return $product->id;

$car=carDetail::where('isDeleted',false)
->get();
//dd($car);
    	return view('dealer.add_product', compact('shop','product','car'));
    }
    else{
    	 $errorMessage = "No shop record found.";
        return view('auth.login', compact('errorMessage'));
    }
    }

    public function create(Request $request){
    	$user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();

             $part=$request->product; 

             $make = $request->input('make');
$model = $request->input('model');
$variant = $request->input('variant');

$car = carDetail::where('make', $make)
          ->where('model', $model)
          ->where('variant', $variant)
          ->first();

           $carId = $car->id;
           $isUnique = product::where('car_id', $carId)
                        ->where('prod_id', $part)
                        ->where('shop_id',$shop->id)
                        ->doesntExist();
            if ($isUnique) {
$product=new product();
$product->prod_id=$request->product;
$product->car_id=$carId;
$product->shop_id=$shop->id;
$product->save();
return redirect()->route('allspareparts')->with('success','Record Entered Successfully!');
            	//no value
            }
            else{
            	return back()->with('fail','You are Already Providing This Part!');
            }

    }

      public function delete($id) {
    // Retrieve the user by ID
    $user = product::find($id);

    if ($user) {
    	if ($user->isDeleted) {
            // User has already been deleted, redirect back to the user list page
            return redirect()->route('allspareparts')->with('fail', 'This is already been deleted!');
        }
        // Set isDeleted to true
        $user->isDeleted = true;

        // Save the changes to the database
        $user->save();

        // Redirect back to the user list page
        return redirect()->route('allspareparts')->with('success', 'Record deleted successfully!');
    } else {
        // User not found, redirect back to the user list page
        return redirect()->route('allspareparts')->with('fail', 'Record not found!');
    }
}

public function showedit(Request $request, $id){

$user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             if ($shop) {
$product = productGeneral::where('isDeleted', false)->get();
//return $product->id;
$product1=product::where('id',$id)->first();

$car=carDetail::where('isDeleted',false)
->get();
//dd($car);
    	return view('dealer.edit_part', compact('shop','product','car','product1'));
    }
    else{
    	 $errorMessage = "No shop record found.";
        return view('auth.login', compact('errorMessage'));
    }
}

public function update(Request $request, $id){
	$user_id=$request->session()->get('loginId');
    	$shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();

             $part=$request->product; 

             $make = $request->input('make');
$model = $request->input('model');
$variant = $request->input('variant');

$car = carDetail::where('make', $make)
          ->where('model', $model)
          ->where('variant', $variant)
          ->first();

           $carId = $car->id;
           $isUnique = product::where('car_id', $carId)
                        ->where('prod_id', $part)
                        ->doesntExist();
            if ($isUnique) {
//$product=new product();
            	$product=product::where('id',$id)->first();
$product->prod_id=$request->product;
$product->car_id=$carId;
$product->shop_id=$shop->id;
$product->save();
return redirect()->route('allspareparts')->with('success','Record Updated Successfully!');
            	//no value
            }
            else{
            	return back()->with('fail','You are Already Providing This Part!');
            }

}

//end loop controller
}
