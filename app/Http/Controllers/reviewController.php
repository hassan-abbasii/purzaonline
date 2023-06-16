<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\review;
use App\Models\users;
use App\Models\shop;
use Illuminate\Http\Request;

class reviewController extends Controller
{

    public function allreviews(){
        $data=review::get();
        return view('admin.allreviews',compact('data'));
    }
    public function adminDelete($id){
        $data=review::where('id',$id)->first();
        if($data->isDeleted){
            return back()->with('fail','Review Already Successfully!');
        }
        $data->isDeleted=true;
$data->save();
        return back()->with('success','Review Deleted Successfully!');
    }
    //
    public function getallusers(Request $request){
    	$record=review::with('shop')
         ->where('user_id',$request->session()->get('loginId'))
         ->where('isDeleted',false)
    	->get();
    	$user=users::where('id',$request->session()->get('loginId'))->first();
    	$totalCount = $record->count();
    	return view('all_reviews',compact('record','totalCount','user'));
    }

    public function shopReview(Request $request){
         $user_id=$request->session()->get('loginId');
          $shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
         $review = review::with('shop','users')
         ->orderBy('id', 'desc')
         ->where('isDeleted',false)
         ->where('shop_id',$shop->id)
         ->get();

        
   // $user_id=$request->session()->get('loginId');
       
             if ($shop) {
                if($review){
                     $reviewCount = review::with('shop', 'users')
    ->orderBy('id', 'desc')
    ->where('isDeleted', false)
    ->where('shop_id', $shop->id)
    ->count();
    $averageRating = review::where('isDeleted', false)
    ->where('shop_id', $shop->id)
    ->avg('rating');
    $averageRating = number_format($averageRating, 1);
        return view('mechanic.review', compact('shop','review','reviewCount','averageRating'));
    }
    else{
        $reviewCount=0;
        $averageRating=0;
        return view('mechanic.review', compact('shop','review','reviewCount','averageRating'));
    }
    }
    else{
        return back()->with('fail','Shop Temporarily Closed!');
    }
}
public function shopReviewDealer(Request $request){
         $user_id=$request->session()->get('loginId');
          $shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
         $review = review::with('shop','users')
         ->orderBy('id', 'desc')
         ->where('isDeleted',false)
         ->where('shop_id',$shop->id)
         ->get();

        
   // $user_id=$request->session()->get('loginId');
       
             if ($shop) {
                if($review){
                     $reviewCount = review::with('shop', 'users')
    ->orderBy('id', 'desc')
    ->where('isDeleted', false)
    ->where('shop_id', $shop->id)
    ->count();
    $averageRating = review::where('isDeleted', false)
    ->where('shop_id', $shop->id)
    ->avg('rating');
    $averageRating = number_format($averageRating, 1);
        return view('dealer.review', compact('shop','review','reviewCount','averageRating'));
    }
    else{
        $reviewCount=0;
        $averageRating=0;
        return view('dealer.review', compact('shop','review','reviewCount','averageRating'));
    }
    }
    else{
        return back()->with('fail','Shop Temporarily Closed!');
    }
}
    public function create(Request $request, $id){

$record=review::where('isDeleted',false)
->where('user_id',$request->session()->get('loginId'))
->where('shop_id',$id)
->first();
if($record){
	return back()->with('fail','You Cannot Rate Single Shop Multiple Times, Edit Your Review From Profile');
    }
    else{
    	$currentDate = Carbon::now('Asia/Karachi')->format('Y-m-d');
    	$product=new review();
    	$product->date=$currentDate;
    	//$product->rating=$currentDate;
    	$product->comment=$request->comment;
    	 $product->rating = $request->input('rating');
    	 $product->shop_id=$id;
    	 $product->user_id=$request->session()->get('loginId');
    	 $product->save();
    	 return back()->with('success','Review Added!!!');
    }
}

public function delete($id) {
    // Retrieve the user by ID
    $user = review::find($id);

    if ($user) {
    	if ($user->isDeleted) {
            // User has already been deleted, redirect back to the user list page
            return redirect()->route('alluserrev')->with('fail', 'This is already been deleted!');
        }
        // Set isDeleted to true
        $user->isDeleted = true;

        // Save the changes to the database
        $user->save();

        // Redirect back to the user list page
        return redirect()->route('alluserrev')->with('success', 'Review deleted successfully!');
    } else {
        // User not found, redirect back to the user list page
        return redirect()->route('alluserrev')->with('fail', 'Record not found!');
    }
}


//

public function edit($id, Request $request){
$record= review::find($id);
 if ($record->isDeleted) {
        return redirect()->route('alluserrev')->with('fail', 'Cannot Edit Deleted Record!');
    }

    // Get the saved mechanic ID from the shop_mechanics table
    
    return view('edit_review',compact('record'));
}




public function update(Request $request, $id)
    {
        $product = review::findOrFail($id);
      $comment = $request->comment;
$rating = $request->rating;

 
$product->comment=$request->comment;
 $product->rating = $request->input('rating');
$product->save();
 return redirect()->route('alluserrev')->with('success', 'Your review Updated!');
}
public function replyshow(Request $request, $id){
$user_id=$request->session()->get('loginId');
          $shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             $review=review::with('users')
             ->where('id',$id)
             ->first();
             if($review->reply !== ""){
               return back()->with('fail','Already replied!!!');
               } 
             if($review){
                return view('mechanic.reply_review',compact('review','shop'));
             }
}
public function reply(Request $request,$id){
    $review=review::with('users')
             ->where('id',$id)
             ->first();
              
         $currentDate = Carbon::now('Asia/Karachi')->format('Y-m-d');
         $review->reply=$request->comment;
         $review->reply_date=$currentDate;
         $review->save();
         return redirect()->route('shopreview')->with('success','Replied To Review!!!');    
}
//
public function replyshowdealer(Request $request, $id){
$user_id=$request->session()->get('loginId');
          $shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             $review=review::with('users')
             ->where('id',$id)
             ->first();
             if($review->reply !== ""){
               return back()->with('fail','Already replied!!!');
               } 
             if($review){
                return view('dealer.reply_review',compact('review','shop'));
             }
}
public function replydealer(Request $request,$id){
    $review=review::with('users')
             ->where('id',$id)
             ->first();
              
         $currentDate = Carbon::now('Asia/Karachi')->format('Y-m-d');
         $review->reply=$request->comment;
         $review->reply_date=$currentDate;
         $review->save();
         return redirect()->route('shopreviewdealer')->with('success','Replied To Review!!!');    
}

public function shopReviewDealer1(Request $request){
         $user_id=$request->session()->get('loginId');
          $shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
         $review = review::with('shop','users')
         ->orderBy('id', 'desc')
         ->where('isDeleted',false)
         ->where('shop_id',$shop->id)
         ->get();

        
   // $user_id=$request->session()->get('loginId');
       
             if ($shop) {
                if($review){
                     $reviewCount = review::with('shop', 'users')
    ->orderBy('id', 'desc')
    ->where('isDeleted', false)
    ->where('shop_id', $shop->id)
    ->count();
    $averageRating = review::where('isDeleted', false)
    ->where('shop_id', $shop->id)
    ->avg('rating');
    $averageRating = number_format($averageRating, 1);
        return view('dealer1.review', compact('shop','review','reviewCount','averageRating'));
    }
    else{
        $reviewCount=0;
        $averageRating=0;
        return view('dealer1.review', compact('shop','review','reviewCount','averageRating'));
    }
    }
    else{
        return back()->with('fail','Shop Temporarily Closed!');
    }
}
public function replyshowdealer1(Request $request, $id){
$user_id=$request->session()->get('loginId');
          $shop = shop::where('user_id','=', $user_id)
             ->where('isDeleted', false)
             ->first();
             $review=review::with('users')
             ->where('id',$id)
             ->first();
             if($review->reply !== ""){
               return back()->with('fail','Already replied!!!');
               } 
             if($review){
                return view('dealer1.reply_review',compact('review','shop'));
             }
}
public function replydealer1(Request $request,$id){
    $review=review::with('users')
             ->where('id',$id)
             ->first();
              
         $currentDate = Carbon::now('Asia/Karachi')->format('Y-m-d');
         $review->reply=$request->comment;
         $review->reply_date=$currentDate;
         $review->save();
         return redirect()->route('shopreviewdealer1')->with('success','Replied To Review!!!');    
}



}
