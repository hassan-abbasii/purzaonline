<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inventoryProduct;
use App\Models\users;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\reservation;
use App\Models\carDetail;
use App\Models\shop;
use App\Models\review;
use Carbon\carbon;

class reservationController extends Controller
{
    //
    public function reserve(Request $request){
    	$quantity=$request->quantity;
    	$shopId = $request->shop_id;
$prodId = $request->prod_id;
$userId = $request->session()->get('loginId');
$currentDate = Carbon::now()->format('Y-m-d');
$blockeduser = reservation::where('userStatus', 'Blocked')
->where('user_id',$request->session()->get('loginId'))
->where('shop_id',$request->shop_id)
        ->exists();
        if($blockeduser){
return redirect()->back()->with('fail', 'Shop owner has blocked you from making reservations!.');

        }
$existingReservation = reservation::where('user_id', $userId)
    ->where('shop_id', $shopId)
    ->where('prod_id', $prodId)
    ->where('status','active')
    ->whereDate('created_at', $currentDate)
    ->first();

if ($existingReservation) {
    // Reservation already exists, handle the error or return a response
    // For example:
    return redirect()->back()->with('fail', 'A reservation already exists for the same user, shop, and product on the current day.');
}



$reservation = new reservation();
$reservation->user_id = $userId;
$reservation->shop_id = $shopId;
$reservation->prod_id = $prodId;
 $reservation->quantity=$request->quantity;
 $record=inventoryProduct::where('id',$prodId)->first();
 $record->quantity= $record->quantity - $request->quantity;
 $record->save();

// Set other reservation properties
$reservation->save();
return redirect()->back()->with('success', 'Reservation Successfull! you can cancel it from your profile.');
    }

    public function viewall(Request $request){
    	$record=reservation::where('user_id',$request->session()->get('loginId'))
    	->where('isUserDeleted',false)
    	->get();
    	return view('reservation',compact('record'));
    }
    public function viewallshop(Request $request){

$shop=shop::where('user_id',$request->session()->get('loginId'))->first();
    	$record=reservation::where('shop_id',$shop->id)
    	->where('isDeleted',false)
    	->get();




    	return view('dealer1.reservation',compact('record','shop'));
    }


public function block($id,Request $request){
      $shop=shop::where('user_id',$request->session()->get('loginId'))
        ->where('isDeleted',false)
        ->first();
        $appointment=reservation::where('id',$id)->first();
      

        $appointment->userStatus="Blocked";
        $appointment->save();
        return back()->with('success','User Blocked!');  
    }


    public function unblock($id,Request $request){
      $shop=shop::where('user_id',$request->session()->get('loginId'))
        ->where('isDeleted',false)
        ->first();

        $appointment=reservation::where('id',$id)->first();
          $blockeduser = reservation::where('userStatus', 'Blocked')
->where('user_id',$appointment->user_id)
->where('shop_id',$shop->id)
        ->first();
        $blockeduser->userStatus="Allowed";
        $blockeduser->save();
        return back()->with('success','User UnBlocked!');  
    }

    //
     public function allblocked(Request $request){
        $shop=shop::where('user_id',$request->session()->get('loginId'))
        ->where('isDeleted',false)
        ->first();
        $record = reservation::whereIn('id', function ($query) use ($shop) {
    $query->select(DB::raw('MAX(id)'))
        ->from('reservations')
        ->where('userStatus', 'Blocked')
        ->where('shop_id', $shop->id)
        ->groupBy('user_id');
})
->get();

    return view('dealer1.blocked_user',compact('record','shop'));
    }

    public function cancel($id , Request $request){
$record=reservation::where('id',$id)->first();
if($record->status !== 'active'){
	return back()->with('fail','You Cannot Cancel This Reservation Only Active Reservations could be canceled');

    }
    $part=inventoryProduct::where('id',$record->prod_id)->first();
	$record->status='canceled';
	$part->quantity=$part->quantity + $record->quantity;
	$record->quantity=0;
	$part->save();
	$record->save();
	return back()->with('success','Reservation Canceled!');
}
public function cancelShop($id , Request $request){
$record=reservation::where('id',$id)->first();
if($record->status !== 'active'){
	return back()->with('fail','You Cannot Cancel This Reservation Only Active Reservations could be canceled');

    }
    $part=inventoryProduct::where('id',$record->prod_id)->first();
	$record->status='canceled';
	$part->quantity=$part->quantity + $record->quantity;
	$record->quantity=0;
	$part->save();
	$record->save();
	return back()->with('success','Reservation Canceled!');
}

public function deleteUser($id , Request $request){
$record=reservation::where('id',$id)->first();
if($record->isUserDeleted){
	return back()->with('fail','Already Deleted');

    }
    $part=inventoryProduct::where('id',$record->prod_id)->first();
	$record->status='canceled';
	$part->quantity=$part->quantity + $record->quantity;
	$record->quantity=0;
	$record->isUserDeleted=true;
	$part->save();
	$record->save();
	return back()->with('success','Reservation Deleted!');
}
public function deleteShop($id , Request $request){
$record=reservation::where('id',$id)->first();
if($record->isUserDeleted){
	return back()->with('fail','Already Deleted');

    }
    $part=inventoryProduct::where('id',$record->prod_id)->first();
	$record->status='canceled';
	$part->quantity=$part->quantity + $record->quantity;
	$record->quantity=0;
	$record->isDeleted=true;
	$part->save();
	$record->save();
	return back()->with('success','Reservation Deleted!');
}

public function detail($id, Request $request){
	$record=reservation::where('id',$id)->first();
	$blockeduser = reservation::where('userStatus', 'Blocked')
->where('user_id',$request->session()->get('loginId'))
->where('shop_id',$record->shop_id)
        ->exists();
        $check=0;
        if($blockeduser){
        	$check=1;
        }
	return view('reservation_detail',compact('record','check'));
}
public function detailShop($id, Request $request){
	$record=reservation::where('id',$id)->first();
	$shop=shop::where('user_id',$request->session()->get('loginId'))->first();
	$check=0;
       //$record->user_id;
        $blockeduser = reservation::where('userStatus', 'Blocked')
->where('user_id',$record->user_id)
        ->exists();
        if($blockeduser){
            $check=1;
        }
	return view('dealer1.reservation_detail',compact('record','shop','check'));
}
}
