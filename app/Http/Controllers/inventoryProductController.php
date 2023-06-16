<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inventoryProduct;
use App\Models\users;
use Illuminate\Validation\Rule;
use App\Models\productGeneral;
use App\Models\carDetail;
use App\Models\shop;
use App\Models\review;

class inventoryProductController extends Controller
{
    // 
    public function view(Request $request){
    	$user_id=$request->session()->get('loginId');
    	$shop=shop::where('isDeleted',false)
    	->where('user_id',$user_id)
    	->first();
    	$record=inventoryProduct::where('shop_id',$shop->id)
    	->get();
    	return view('dealer1.all_product',compact('record','shop'));
    }

    public function showaddproduct(Request $request){
    	$user_id=$request->session()->get('loginId');
    	$shop=shop::where('isDeleted',false)
    	->where('user_id',$user_id)
    	->first();
    	$product=productGeneral::where('isDeleted',false)->get();
    	$car=carDetail::where('isDeleted',false)->get();
    	return view('dealer1.add_product',compact('product','car','shop'));
    }

    public function create(Request $request){
    	$car=carDetail::where('make',$request->make)
    	->where('model',$request->model)
    	->where('variant',$request->variant)
    	->where('isDeleted',false)
    	->first();
    	$user_id=$request->session()->get('loginId');
    	$shop=shop::where('isDeleted',false)
    	->where('user_id',$user_id)
    	->first();
     $productid=$request->product;
     $car_id=$car->id;
     $name=$request->name;
     $condition=$request->condition;
     $brand=$request->brand;

     $validatedData = $request->validate([
        'name' => 'required|unique:inventory_products,name,NULL,id,condition,' . $request->input('condition') . ',brand,' . $request->input('brand') . ',car_id,' . $car_id . ',prod_id,' . $request->input('product') . ',shop_id,' . $shop->id,
        // Other validation rules for the remaining fields
    ]);
 $imageFile = $request->file('image');

// Generate a unique filename for the image
$filename = uniqid() . '.' . $imageFile->getClientOriginalExtension();

// Build the path to the source file
$sourcePath = $imageFile->getPathname();

// Build the path to the destination directory
  $destinationPath = public_path('images/products');

// Create a copy of the uploaded image file in the destination directory with the new filename
copy($sourcePath, $destinationPath . '/' . $filename);

// Build the path to the stored image file
$imagePath = 'images/products/' . $filename;

$product=new inventoryProduct();
$product->name=$request->name;
$product->actualPrice=$request->actualPrice;
$product->sellingPrice=$request->sellingPrice;
$product->quantity=$request->quantity;
$product->image=$imagePath;
$product->condition=$request->condition;
$product->brand=$request->brand;
$product->car_id=$car_id;
$product->prod_id=$request->product;
$product->shop_id=$shop->id;
$res=$product->save();
if($res){
	return redirect()->route('allproducts')->with('success','Record Entered Successfully');
}
else{
	return back()->with('fail','Error !');
}

    }


    //
    public function delete($id) {
    // Retrieve the user by ID
    $user = inventoryProduct::find($id);

    if ($user) {
    	if ($user->isDeleted) {
            // User has already been deleted, redirect back to the user list page
            return redirect()->route('allproducts')->with('fail', 'This is already been deleted!');
        }
        // Set isDeleted to true
        $user->isDeleted = true;

        // Save the changes to the database
        $user->save();

        // Redirect back to the user list page
        return redirect()->route('allproducts')->with('success', 'Record deleted successfully!');
    } else {
        // User not found, redirect back to the user list page
        return redirect()->route('allproducts')->with('fail', 'Record not found!');
    }
}

public function showedit($id, Request $request){
$product=inventoryProduct::where('id',$id)->first();
if ($product->isDeleted) {
    return redirect()->route('allproducts')->with('fail', 'Cannot Edit Deleted Product');
}
$user_id=$request->session()->get('loginId');
    	$shop=shop::where('isDeleted',false)
    	->where('user_id',$user_id)
    	->first();
    	$product=productGeneral::where('isDeleted',false)->get();
    	$car=carDetail::where('isDeleted',false)->get();
    	$product1=inventoryProduct::where('id',$id)->first();
    	return view('dealer1.edit_product',compact('product','car','product1','shop'));

}
public function addQuantity($id, Request $request){
$product=inventoryProduct::where('id',$id)->first();
if ($product->isDeleted) {
    return redirect()->route('allproducts')->with('fail', 'Cannot Edit Deleted Product');
}
$user_id=$request->session()->get('loginId');
    	$shop=shop::where('isDeleted',false)
    	->where('user_id',$user_id)
    	->first();
    	$product=productGeneral::where('isDeleted',false)->get();
    	$car=carDetail::where('isDeleted',false)->get();
    	$product1=inventoryProduct::where('id',$id)->first();
    	return view('dealer1.add_quantity',compact('product','car','product1','shop'));

}
public function showdetail($id, Request $request){
	$record=inventoryProduct::where('id',$id)->first();
 
$user_id=$request->session()->get('loginId');
    	$shop=shop::where('isDeleted',false)
    	->where('user_id',$user_id)
    	->first();
    	$product=productGeneral::where('isDeleted',false)->get();
    	$car=carDetail::where('isDeleted',false)->get();
    	$product1=inventoryProduct::where('id',$id)->first();
    	return view('dealer1.product_detail',compact('record','car','product1','shop'));

}
public function update($id, Request $request){


	$car=carDetail::where('make',$request->make)
    	->where('model',$request->model)
    	->where('variant',$request->variant)
    	->where('isDeleted',false)
    	->first();
    	$user_id=$request->session()->get('loginId');
    	$shop=shop::where('isDeleted',false)
    	->where('user_id',$user_id)
    	->first();
     $productid=$request->product;
     $car_id=$car->id;
     $name=$request->name;
     $condition=$request->condition;
     $brand=$request->brand;

     $validatedData = $request->validate([
        'name' => 'required|unique:inventory_products,name,NULL,id,condition,' . $request->input('condition') . ',brand,' . $request->input('brand') . ',car_id,' . $car_id . ',prod_id,' . $request->input('product') . ',shop_id,' . $shop->id,
        // Other validation rules for the remaining fields
    ]);
 $imageFile = $request->file('image');

// Generate a unique filename for the image
$filename = uniqid() . '.' . $imageFile->getClientOriginalExtension();

// Build the path to the source file
$sourcePath = $imageFile->getPathname();

// Build the path to the destination directory
  $destinationPath = public_path('images/products');

// Create a copy of the uploaded image file in the destination directory with the new filename
copy($sourcePath, $destinationPath . '/' . $filename);

// Build the path to the stored image file
$imagePath = 'images/products/' . $filename;

$product=inventoryProduct::where('id',$id)->first();
$product->name=$request->name;
$product->actualPrice=$request->actualPrice;
$product->sellingPrice=$request->sellingPrice;
$product->quantity=$request->quantity;
$product->image=$imagePath;
$product->condition=$request->condition;
$product->brand=$request->brand;
$product->car_id=$car_id;
$product->prod_id=$request->product;
$product->shop_id=$shop->id;
$res=$product->save();
if($res){
	return redirect()->route('allproducts')->with('success','Record Updated Successfully');
}
else{
	return back()->with('fail','Error !');
}
}
//

public function updateQuantity($id, Request $request){

 
 

$product=inventoryProduct::where('id',$id)->first();
 
$product->quantity=$request->quantity;
 
$res=$product->save();
if($res){
	return redirect()->route('allproducts')->with('success','Quantity Updated Successfully');
}
else{
	return back()->with('fail','Error !');
}
}
//
public function homepage(){
	 $product=productGeneral::where('isDeleted',false)->get();
    $car=carDetail::where('isDeleted',false)->get();
$record=inventoryProduct::where('isDeleted',false)->get();

    return view('product',compact('car','product','record'));
}
public function browseCatalog($id){
	$record=inventoryProduct::where('isDeleted',false)
	->where('shop_id',$id)
	->get();
    $car=carDetail::where('isDeleted',false)->get();
$product=productGeneral::where('isDeleted',false)->get();
$id=$id;
$shop=shop::where('id',$id)->first();
$review=review::where('isDeleted',false)
->where('shop_id',$id)
->get();
if($review){
$reviewCount = review::where('isDeleted', false)
    ->where('shop_id', $id)
    ->count();
    $averageRating = review::where('isDeleted', false)
    ->where('shop_id', $id)
    ->avg('rating');
    $averageRating = number_format($averageRating, 1);

}
else{
    $reviewCount=0;
    $averageRating=0;
}

    return view('catlog',compact('car','product','record','id','shop','reviewCount','averageRating'));
}

public function search(Request $request){
	$productid=$request->product;
	$car1=carDetail::where('make',$request->make)
	->where('model',$request->model)
	->where('isdeleted',false)->first();
	$record=inventoryProduct::where('isDeleted',false)
	->where('prod_id',$productid)
	->where('car_id',$car1->id)
	->get();

$shop=shop::where('isDeleted',false)
	->where('id',$record->id)->first();
	if($shop){
		$review=review::where('isDeleted',false)
->where('shop_id',$id)
->get();
if($review){
$reviewCount = review::where('isDeleted', false)
    ->where('shop_id', $id)
    ->count();
    $averageRating = review::where('isDeleted', false)
    ->where('shop_id', $id)
    ->avg('rating');
    $averageRating = number_format($averageRating, 1);

}
else{
    $reviewCount=0;
    $averageRating=0;
}

	$product=productGeneral::where('isDeleted',false)->get();
    $car=carDetail::where('isDeleted',false)->get();
return view('product',compact('car','product','record','averageRating','reviewCount','shop'));
}
else{
		return back()->with('fail','Shop Closed Permenantly!');
	}
}

public function searchShop(Request $request,$id){
	$productid=$request->product;
	$car1=carDetail::where('make',$request->make)
	->where('model',$request->model)
	->where('isdeleted',false)->first();
	$record=inventoryProduct::where('isDeleted',false)
	->where('prod_id',$productid)
	->where('car_id',$car1->id)
	->where('shop_id',$id)
	->get();


$shop=shop::where('isDeleted',false)
	->where('id',$id)->first();
	if($shop){
		$review=review::where('isDeleted',false)
->where('shop_id',$id)
->get();
if($review){
$reviewCount = review::where('isDeleted', false)
    ->where('shop_id', $id)
    ->count();
    $averageRating = review::where('isDeleted', false)
    ->where('shop_id', $id)
    ->avg('rating');
    $averageRating = number_format($averageRating, 1);

}
else{
    $reviewCount=0;
    $averageRating=0;
}


	$product=productGeneral::where('isDeleted',false)->get();
    $car=carDetail::where('isDeleted',false)->get();
return view('catlog',compact('car','product','record','averageRating','reviewCount','shop'));
}

	}

public function detail($id, Request $request){
	$record=inventoryProduct::where('id',$id)->first();
	$shop=shop::where('isDeleted',false)
	->where('id',$record->shop_id)->first();
	if($shop){
		$review=review::where('isDeleted',false)
->where('shop_id',$shop->id)
->get();
if($review){
$reviewCount = review::where('isDeleted', false)
    ->where('shop_id', $shop->id)
    ->count();
    $averageRating = review::where('isDeleted', false)
    ->where('shop_id', $shop->id)
    ->avg('rating');
    $averageRating = number_format($averageRating, 1);

}
else{
    $reviewCount=0;
    $averageRating=0;
}

return view('product_detail',compact('shop','reviewCount','averageRating','record'));

	}
	
}
}
