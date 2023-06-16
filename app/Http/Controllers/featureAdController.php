<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\shop;
use App\Models\featureAdPlan;
use App\Models\featureAdRequest;
use Illuminate\Support\Facades\DB;
use Stripe;
use Session;

class featureAdController extends Controller
{
    //
    public function showplan(Request $request){
    	$shop=shop::where('user_id',$request->session()->get('loginId'))->first();
    	$record=featureAdPlan::where('isDeleted',false)->get();
    	return view('mechanic.add_feature_ad',compact('shop','record'));
    }

    //
//
    public function paymentview(Request $request){
    	$shop=shop::where('user_id',$request->session()->get('loginId'))->first();
    	return view('mechanic.feature_ad_payment',compact('shop'));
    }

     public function call(Request $request) {
     	$shop=shop::where('user_id',$request->session()->get('loginId'))->first();
        \Stripe\Stripe::setApiKey('sk_test_51KNK4FGb9p5ZjP9isZ6mNIlaUSpslnV6TpCnkw88aIXIZFGO8nsuGDQ8T6hqjBCJlJW4r31ZtP2lk0kOSEypEkLo00ajXyG4VX');
        $customer = \Stripe\Customer::create(array(
          'name' => 'test',
          'description' => 'test description',
          'email' => $shop->users->email,
          'source' => $request->input('stripeToken'),
           "address" => ["city" => "San Francisco", "country" => "US", "line1" => "510 Townsend St", "postal_code" => "98140", "state" => "CA"]

      ));
        $r=featureAdPlan::where('id',$request->adid)->first();
        try {
            \Stripe\Charge::create ( array (
                    "amount" => $r->price * 100,
                    "currency" => "pkr",
                    "customer" =>  $customer["id"],
                    "description" => "Feature Ad Payment."
            ) );

// $check=featureAdRequest::where('shop_id',$shop->id)
// ->where('')
            $add=new featureAdRequest();
            $add->image=$request->image;
            $add->description=$request->detail;
            $add->ad_id=$request->adid;
            $add->paymentStatus="Approved";
             $add->paymentMethod="Stripe";
            $add->shop_id=$shop->id;
$add->save();
            $record=featureAdPlan::where('isDeleted',false)->get();

            return view ('mechanic.add_feature_ad',compact('shop','record'))->with('success','Payment Done SuccessFully');
        } catch ( \Stripe\Error\Card $e ) {
            Session::flash ( 'fail-message', $e->get_message() );
            return view ( 'mechanic.feature_ad_payment',compact('shop') );
        }
    }


    public function userdetails(Request $request){
    	$shop=shop::where('user_id',$request->session()->get('loginId'))->first();
    	$imageFile = $request->file('image');

// Generate a unique filename for the image
$filename = uniqid() . '.' . $imageFile->getClientOriginalExtension();

// Build the path to the source file
$sourcePath = $imageFile->getPathname();

// Build the path to the destination directory
  $destinationPath = public_path('images/feature');

// Create a copy of the uploaded image file in the destination directory with the new filename
copy($sourcePath, $destinationPath . '/' . $filename);

// Build the path to the stored image file
$imagePath = 'images/feature/' . $filename;

$detail=$request->description;
$adid=$request->plan;
return view('mechanic.feature_ad_payment',compact('shop','imagePath','detail','adid'));
    }

    //
}
