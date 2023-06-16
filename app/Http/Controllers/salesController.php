<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inventoryProduct;
use App\Models\users;
use Illuminate\Validation\Rule;
use App\Models\productGeneral;
use App\Models\carDetail;
use App\Models\shop;
use App\Models\sales;
use Carbon\carbon;

class salesController extends Controller
{
    //
    public function view(Request $request){
$user_id=$request->session()->get('loginId');
    	$shop=shop::where('isDeleted',false)
    	->where('user_id',$user_id)
    	->first();
    	$record=inventoryProduct::where('shop_id',$shop->id)
    	->where('isDeleted',false)
    	->get();
    	return view('dealer1.selling_dashboard',compact('shop','record'));
    }

    public function sell(Request $request){
    	$user_id=$request->session()->get('loginId');
    	$shop=shop::where('isDeleted',false)
    	->where('user_id',$user_id)
    	->first();
    	  $id= $request->productid;
    	$record=inventoryProduct::where('id',$id)
    	->first();
    	//return $price= $record->sellingPrice * $request->quantity;
    	$record->quantity=$record->quantity - $request->quantity;
    	$record->save();
    	$sales=new sales();

$pakistanDateTime = Carbon::now('Asia/Karachi');
$currentDateTime = $pakistanDateTime->format('Y-m-d');
$sales->date=$currentDateTime;
$sales->prod_id=$id;
$sales->shop_id=$shop->id;
$sales->quantity=$request->quantity;
$profit=$record->sellingPrice - $record->actualPrice;
$profit=$profit * $request->quantity;
$sales->profit=$profit;
$sales->save();
return back()->with('success','Item Sold Successfully!');
    }
    public function viewsales(Request $request){
    	$user_id=$request->session()->get('loginId');
    	$shop=shop::where('isDeleted',false)
    	->where('user_id',$user_id)
    	->first();
    	$record=sales::where('isDeleted',false)
    	->where('shop_id',$shop->id)
    	->get();
    	$currentMonth = Carbon::now()->format('m');

$record1 = sales::where('shop_id', $shop->id)
    ->whereMonth('created_at', $currentMonth)
    ->get();

$totalProfit = 0;

foreach ($record1 as $sale) {
    $totalProfit += $sale->profit;
}
    	return view('dealer1.all_sales',compact('record','shop','totalProfit'));

    }


    public function delete($id , Request $request){
    	$record=sales::where('id',$id)->first();
$record->isDeleted=true;
$record->save();
return back()->with('success','Sales Deleted Successfully!');

    }
    public function rollback($id , Request $request){
    	$sales=sales::where('id', $id)->first();
    	$product=inventoryProduct::where('id',$sales->prod_id)->first();
    	$sales->profit=0;
    	$qty=$sales->quantity;
    	$sales->quantity=0;
    	$sales->isDeleted=true;
    	$sales->status="Rolled Back";
    	$sales->save();
    	return $product->quantity=$product->quantity + $qty;
    	$product->save();
    	return back()->with('success','Sales Rolled Back!');
    }
}
