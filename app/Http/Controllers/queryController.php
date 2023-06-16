<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\shop;
use Illuminate\Support\Facades\DB;
use App\Models\users;
use App\Models\query;
use App\Models\service;
use App\Models\review;
use App\Models\product;
use App\Models\productGeneral;
use App\Models\carDetail;
use App\Models\mechanicService;
use Carbon\carbon;
class queryController extends Controller
{
    // 
    public function getview(Request $request, $id){
$services = product::select('prod_id', 'car_id')
    ->distinct()
    ->where('shop_id', $id)
    ->where('isDeleted',false)
    ->get();
$shop=shop::where('id',$id)->first();
if($services){
$ccIds = $services->pluck('prod_id')->toArray();
$serviceIds = $services->pluck('car_id')->toArray();

$product = productGeneral::whereIn('id', $ccIds)->get();
$car = carDetail::whereIn('id', $serviceIds)->get();


	$review=review::where('isDeleted',false)
->where('shop_id',$id)
->get();
$reviewCount = review::where('isDeleted', false)
    ->where('shop_id', $id)
    ->count();
    $averageRating = review::where('isDeleted', false)
    ->where('shop_id', $id)
    ->avg('rating');
    $averageRating = number_format($averageRating, 1);
	return view('send_query',compact('product','car','shop','review','averageRating','reviewCount'));
    }
else{
	return back()->with('fail','Sorry Shop is Empty!');
}
}
//user view
public function allQueries(Request $request){
	$record=query::with('products','users','shop','car')
	->where('isUserDeleted',false)
	->where('user_id',$request->session()->get('loginId'))
	->get();


	return view('query',compact('record'));
}
public function allQueriesDealer(Request $request){
	 $shop=shop::where('user_id',$request->session()->get('loginId'))
        ->where('isDeleted',false)
        ->first();
	$record=query::with('products','users','shop','car')
	->where('isDeleted',false)
	->where('shop_id',$shop->id)
	->get();
	


	return view('dealer.query',compact('record','shop'));
}

//send query
public function sendQuery(Request $request, $id){
	$productid=$request->product;
	$car=carDetail::where('isDeleted',false)
	->where('make',$request->make)
	->where('model',$request->model)
	->where('variant',$request->variant)
	->first();
	$record=new query();
 $currentDate = Carbon::now('Asia/Karachi')->format('Y-m-d');
	$record->date=$currentDate;
	$record->prod_id=$productid;
	$record->car_id=$car->id;
	$record->shop_id=$id;
	$blockeduser = query::where('userStatus', 'Blocked')
->where('user_id',$request->session()->get('loginId'))
->where('shop_id', $id)
        ->exists();
        if($blockeduser){
           return redirect()->route('shop_details_dealer',['id'=> $id])->with('fail','Shop Owner has Blocked you for sending Queries.');  
        }
	if($request->description === null)
	$record->description="";
else
	$record->description=$request->description;
	$record->user_id=$request->session()->get('loginId');
	$record->save();

	return redirect()->route('shop_details_dealer',['id'=> $id])->with('success','Query Sent Successfully! View record in your account Profile.');

}
public function deleteUser(Request $request, $id){
	$app=query::where('id',$id)->first();
	$app->isUserDeleted=true;
	//$app->status="Deleted";
	$app->save();
	return back()->with('success','Record Deleted Successfully!');
}
public function delete(Request $request, $id){
	$app=query::where('id',$id)->first();
	$app->isDeleted=true;
	//$app->status="Deleted";
	$app->save();
	return back()->with('success','Record Deleted Successfully!');
}
public function detailQuery($id, Request $request){
	$record=query::with('products','users','shop','car')
	->where('id',$id)->first();
	//$app->isUserDeleted=true;
	//$app->save();
	$blockeduser = query::where('userStatus', 'Blocked')
->where('user_id',$request->session()->get('loginId'))
->where('shop_id',$record->shop_id)
        ->exists();
        $check=0;
        if($blockeduser){
        	$check=1;
        }
	 
	return view('query_detail',compact('record','check'));
}
public function detailQueryDealer($id, Request $request){
	$record=query::with('products','users','shop','car')
	->where('id',$id)->first();
	$shop=shop::where('user_id',$request->session()->get('loginId'))
        ->where('isDeleted',false)
        ->first();
         $check=0;
        $blockeduser = query::where('userStatus', 'Blocked')
->where('user_id',$record->user_id)
        ->exists();
        if($blockeduser){
            $check=1;
        }
	//$app->isUserDeleted=true;
	//$app->save();
	return view('dealer.query_detail',compact('record','shop','check'));
}

//

public function block($id,Request $request){
      $shop=shop::where('user_id',$request->session()->get('loginId'))
        ->where('isDeleted',false)
        ->first();
        $appointment=query::where('id',$id)->first();
      

        $appointment->userStatus="Blocked";
        $appointment->save();
        return back()->with('success','User Blocked!');  
    }


    public function unblock($id,Request $request){
      $shop=shop::where('user_id',$request->session()->get('loginId'))
        ->where('isDeleted',false)
        ->first();

        $appointment=query::where('id',$id)->first();
          $blockeduser = query::where('userStatus', 'Blocked')
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
        $record = query::whereIn('id', function ($query) use ($shop) {
    $query->select(DB::raw('MAX(id)'))
        ->from('queries')
        ->where('userStatus', 'Blocked')
        ->where('shop_id', $shop->id)
        ->groupBy('user_id');
})
->get();

    return view('dealer.blocked_user',compact('record','shop'));
    }

//


//
//show view rrespoinf
public function showview($id, Request $request){

	$record=query::where('id',$id)->first();
	if($record->productStatus !== 'pending')
		return back()->with('fail','Already Responded');
	$shop=shop::where('user_id',$request->session()->get('loginId'))
        ->where('isDeleted',false)
        ->first();
	return view('dealer.respond_query',compact('record','shop'));
}
public function respond($id, Request $request){
	$record=query::where('id',$id)->first();
	 $st=$request->status;
if($request->response === null){
	 $record->response="";
}
else{
$record->response=$request->response;
}
$record->status="responded";
$record->productStatus=$st;
$record->save();
return redirect()->route('allqueriesdealer')->with('success','Response Sent Successfully!');
}


}
