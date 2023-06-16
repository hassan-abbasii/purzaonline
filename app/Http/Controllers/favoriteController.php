<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\favorite;

class favoriteController extends Controller
{
    //
    public function add(Request $request, $id){
    	
        $app1 = favorite::where('shop_id',$id)
        ->where('user_id',$request->session()->get('loginId'))
        ->where('isDeleted',true)
        ->first();
        if($app1){
            $app1->isDeleted=false;
            $app1->save();
            return back()->with('success','Shop Added To Favorite!');
        }
        else{
            $app = new favorite();
    	$app->shop_id=$id;
    	$app->user_id=$request->session()->get('loginId');
    	$app->save();
    	return back()->with('success','Shop Added To Favorite!');
    }
    } 
    public function remove(Request $request, $id){
    	$app = favorite::where('shop_id',$id)
    	->where('user_id',$request->session()->get('loginId'))
        ->where('isDeleted',false)
    	->first();
    	$app->isDeleted=true;
    	//return  $id;
    	 //$app->save();
         if( $app->save()){ 
return back()->with('success','Shop Removed From Favorite!');
         }
    	
    }
}
