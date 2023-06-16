<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\userController;
use App\Http\Controllers\productGeneralController;
use App\Http\Controllers\carCcController;
use App\Http\Controllers\carDetailController;
use App\Http\Controllers\carServiceController;
use App\Http\Controllers\mechanicServiceController;
use App\Http\Controllers\mechanicController;
use App\Http\Controllers\featureAdPlanController;
use App\Http\Controllers\shopController;
use App\Http\Controllers\shopMechanicController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\slotController;
use App\Http\Controllers\reviewController;
use App\Http\Controllers\appointmentController;
use App\Http\Controllers\carProfileController;
use App\Http\Controllers\productController;
use App\Http\Controllers\queryController;
use App\Http\Controllers\favoriteController;
use App\Http\Controllers\inventoryProductController;
use App\Http\Controllers\salesController;
use App\Http\Controllers\reservationController;
use App\Http\Controllers\featureAdController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 

Route::get('/login',[CustomAuthController::class,'showlogin'])->name('login');
Route::get('/signup',[CustomAuthController::class,'showsignup'])->name('signup');
Route::post('/signup-user',[CustomAuthController::class,'signup'])->name('signup-user');
Route::post('/login-user',[CustomAuthController::class,'login'])->name('login-user');
Route::get('/logout',[CustomAuthController::class,'logout'])->name('logout');

//Admin Routes
Route::get('/admin_dashboard',function(){
	return view('admin.admin_dashboard');
})->middleware('admin')->name('admin');

Route::get('/users', [userController::class, 'viewrecord'])->middleware('admin')->name('allusers');
Route::get('/delete-user/{id}', [userController::class, 'deleteUser'])->middleware('admin')->name('deleteUser');
 //products
 Route::get('/spareparts',[productGeneralController::class,'viewparts'])->middleware('admin')->name('spareparts');
 Route::get('/addpart',[productGeneralController::class,'addpart'])->middleware('admin')->name('addpart');
 Route::post('/add-part',[productGeneralController::class,'create'])->middleware('admin')->name('add-part');
Route::get('/delete-part/{id}', [productGeneralController::class, 'deletepart'])->middleware('admin')->name('deletepart');
Route::get('/editpart/{id}',[productGeneralController::class,'showedit'])->middleware('admin')->name('editpart');
Route::put('/part-update/{id}', [productGeneralController::class,'update'])->middleware('admin')->name('partupdate');
//car cc
 Route::get('/carCC',[carCcController::class,'viewall'])->middleware('admin')->name('carCC');
 Route::get('/addCC',[carCcController::class,'addnew'])->middleware('admin')->name('addcc');
 Route::post('/add-cc',[carCcController::class,'create'])->middleware('admin')->name('add-cc');
 Route::get('/delete-cc/{id}', [carCcController::class, 'delete'])->middleware('admin')->name('deletecc');
 Route::get('/editcc/{id}',[carCcController::class,'edit'])->middleware('admin')->name('editcc');
 Route::put('/cc-update/{id}', [carCcController::class,'update'])->middleware('admin')->name('ccupdate');
 //car details
 Route::get('/car',[carDetailController::class,'viewall'])->middleware('admin')->name('car');
  Route::get('/addcar',[carDetailController::class,'addnew'])->middleware('admin')->name('addcar');
   Route::post('/add-car',[carDetailController::class,'create'])->middleware('admin')->name('add-car');
 Route::get('/delete-car/{id}', [carDetailController::class, 'delete'])->middleware('admin')->name('deletecar');
 Route::get('/editcar/{id}',[carDetailController::class,'edit'])->middleware('admin')->name('editcar');
  Route::put('/car-update/{id}', [carDetailController::class,'update'])->middleware('admin')->name('carupdate');
//car profile
 Route::get('/carservice',[carServiceController::class,'viewall'])->middleware('admin')->name('carservice');
  Route::get('/addcarservice',[carServiceController::class,'addnew'])->middleware('admin')->name('addcarservice');
Route::post('/add-carservice',[carServiceController::class,'create'])->middleware('admin')->name('add-carservice');
 Route::get('/delete-carservice/{id}', [carServiceController::class, 'delete'])->middleware('admin')->name('deletecarservice');
  Route::get('/editcarservice/{id}',[carServiceController::class,'edit'])->middleware('admin')->name('editcarservice');
  Route::put('/carservice-update/{id}', [carServiceController::class,'update'])->middleware('admin')->name('carserviceupdate');
  //mechanic
   Route::get('/mechanic',[mechanicController::class,'viewall'])->middleware('admin')->name('mechanic');
   Route::get('/mechanic',[mechanicController::class,'viewall'])->middleware('admin')->name('mechanic');
   Route::get('/addmechanic',[mechanicController::class,'addnew'])->middleware('admin')->name('addmechanic');
   Route::post('/add-mechanic',[mechanicController::class,'create'])->middleware('admin')->name('add-mechanic');
   Route::get('/delete-mechanic/{id}', [mechanicController::class, 'delete'])->middleware('admin')->name('deletemechanic');
   Route::get('/editmechanic/{id}',[mechanicController::class,'edit'])->middleware('admin')->name('editmechanic');
    Route::put('/mechanic-update/{id}', [mechanicController::class,'update'])->middleware('admin')->name('mechanicupdate');
  //mechanic service

 Route::get('/mechanicservice',[mechanicServiceController::class,'viewall'])->middleware('admin')->name('mechanicservice');
   Route::get('/addmechanicservice',[mechanicServiceController::class,'addnew'])->middleware('admin')->name('addmechanicservice');
   Route::post('/add-mechanicservice',[mechanicServiceController::class,'create'])->middleware('admin')->name('add-mechanicservice');
   Route::get('/delete-mechanicservice/{id}', [mechanicServiceController::class, 'delete'])->middleware('admin')->name('deletemechanicservice');
   Route::get('/editmechanicservice/{id}',[mechanicServiceController::class,'edit'])->middleware('admin')->name('editmechanicservice');
    Route::put('/mechanicservice-update/{id}', [mechanicServiceController::class,'update'])->middleware('admin')->name('mechanicserviceupdate');
    //featureadplan
  Route::get('/featureadplan',[featureAdPlanController::class,'viewall'])->middleware('admin')->name('featureadplan');  
   Route::get('/addfeatureadplan',[featureAdPlanController::class,'addnew'])->middleware('admin')->name('addfeatureadplan');
 Route::post('/add-featureadplan',[featureAdPlanController::class,'create'])->middleware('admin')->name('add-featureadplan');
 Route::get('/delete-featureadplan/{id}', [featureAdPlanController::class, 'delete'])->middleware('admin')->name('deletefeatureadplan');
  Route::get('/editfeatureadplan/{id}',[featureAdPlanController::class,'edit'])->middleware('admin')->name('editfeatureadplan');
  Route::put('/featureadplan-update/{id}', [featureAdPlanController::class,'update'])->middleware('admin')->name('featureadplanupdate');
//test route
  // Route::get('/test',function(){
  // 	return view('mechanic.edit_shop_profile');
  // });

  //Mechanic
 Route::get('/mechanic/shop_info',[shopController::class,'shopinfo'])->middleware('mechanic')->name('shop_info_m');
 Route::get('/mechanic/mechanic_dashboard',[shopController::class,'dashboard'])->middleware('mechanic')->name('mechanic_dashboard');
 Route::post('/mechanic/add-shop-info-mechanic',[shopController::class,'create'])->middleware('mechanic')->name('add-shop-info-mechanic');
 //m-shop
 Route::get('/mechanic/shop_profile',[shopController::class,'shopprofile'])->middleware('mechanic')->name('shop_profile');
 Route::get('/mechanic/edit_mechanic_shop',[shopController::class,'edit'])->middleware('mechanic')->name('edit_mechanic_shop');
 Route::put('/mechanic/shop_profile-update', [shopController::class,'update'])->middleware('mechanic')->name('shop_profile-update');

 //shopMechanic
 Route::get('/mechanic/shopmechanic',[shopMechanicController::class,'viewall'])->middleware('mechanic')->name('shopmechanic');
 Route::get('/mechanic/addshopmechanic',[shopMechanicController::class,'addnew'])->middleware('mechanic')->name('addshopmechanic');
 Route::post('/add-shopmechanic',[shopMechanicController::class,'create'])->middleware('mechanic')->name('add-shopmechanic');
 Route::get('/delete-shopmechanic/{id}', [shopMechanicController::class, 'delete'])->middleware('mechanic')->name('deleteshopmechanic');
 Route::get('/mechanic/edit_shopmechanic/{id}',[shopMechanicController::class,'edit'])->middleware('mechanic')->name('edit_shopmechanic');
 Route::put('/mechanic/shopmechanic-update/{id}', [shopMechanicController::class,'update'])->middleware('mechanic')->name('shopmechanic-update');
 //services in shop mechanic
 Route::get('/mechanic/service',[serviceController::class,'viewall'])->middleware('mechanic')->name('service');
 Route::get('/mechanic/addservice',[serviceController::class,'addnew'])->middleware('mechanic')->name('addservice');
  Route::post('/mechanic/add-service',[serviceController::class,'create'])->middleware('mechanic')->name('add-service');
   Route::get('/delete-service/{id}', [serviceController::class, 'delete'])->middleware('mechanic')->name('deleteservice');
   Route::get('/mechanic/edit_service/{id}',[serviceController::class,'edit'])->middleware('mechanic')->name('editservice');
 Route::put('/mechanic/service-update/{id}', [serviceController::class,'update'])->middleware('mechanic')->name('serviceupdate');

 //timeslots
 Route::get('/mechanic/time_slot',[slotController::class,'viewall'])->middleware('mechanic')->name('slot'); 
 Route::get('/mechanic/time_slot_mechanic/{id}',[slotController::class,'viewallslots'])->middleware('mechanic')->name('timeslot');
  Route::get('/mechanic/manage_time_slot/{id}',[slotController::class,'manageslots'])->middleware('mechanic')->name('managetimeslot');
  Route::post('/mechanic/slot-update/{id}', [slotController::class,'create'])->middleware('mechanic')->name('slotupdate');
  Route::get('/delete-slot/{id}', [slotController::class, 'delete'])->middleware('mechanic')->name('deleteslot');

  //User-Car Owner
  Route::get('/homepage',[userController::class,'homepage'])->name('homepage');
  Route::post('/search-mechanic' , [userController::class,'searchMechanic'])->name('search-mechanic');
  Route::post('/search-dealer' , [userController::class,'searchDealer'])->name('search-dealer');
  Route::get('/shop_details/{id}',[shopController::class,'getdetails'])->name('shop_details');
  Route::get('/shop_details_dealer/{id}',[shopController::class,'getDetailsDealer'])->name('shop_details_dealer');

  //review from user
    Route::post('/add-review/{id}',[reviewController::class,'create'])->middleware('car')->name('addreview');

    //get directions
    Route::get('/get_direction/{id}',[shopController::class,'getdirection'])->name('getdirection');

    //appointment
  Route::get('/appointment/{id}',[appointmentController::class,'view'])->middleware('car')->name('appointment');
   Route::post('/confirm_appointment/{id}',[appointmentController::class,'create'])->middleware('car')->name('confirmappointment');
   Route::post('/book_slot/{id}',[appointmentController::class,'book'])->middleware('car')->name('bookslot');
//dashboard
Route::get('/user_dashboard',[userController::class,'dashboard'])->middleware('car')->name('dashboard');
Route::post('/profile-Update',[userController::class,'update'])->middleware('car')->name('userupdate');
//carprofile
Route::get('/car_profile',[carProfileController::class,'viewall'])->middleware('car')->name('carprofile');
Route::get('/add_car_profile',[carProfileController::class,'getall'])->middleware('car')->name('addcarprofile');
Route::post('/add-car_profile',[carProfileController::class,'create'])->middleware('car')->name('add-carprofile');
Route::get('/delete-car_profile/{id}',[carProfileController::class,'delete'])->middleware('car')->name('delete-carprofile');
Route::get('/edit_car_profile/{id}',[carProfileController::class,'edit'])->middleware('car')->name('edit-carprofile');
 Route::put('/carprofile-update/{id}', [carProfileController::class,'update'])->middleware('car')->name('update-carprofile');
 //userbookings of mechanic
 Route::get('/user_appointment',[appointmentController::class,'getall'])->middleware('car')->name('userapp');
 Route::get('/cancel-car_profile/{id}',[appointmentController::class,'cancel'])->middleware('car')->name('cancelapp');
 Route::get('/delete-car_appointment/{id}',[appointmentController::class,'deleteUserApp'])->middleware('car')->name('delete-app');
 Route::get('/app_detail/{id}',[appointmentController::class,'appdetail'])->middleware('car')->name('app-detail');
 //review
 Route::get('/allreview',[reviewController::class,'getallusers'])->middleware('car')->name('alluserrev');
 Route::get('/delete-review/{id}',[reviewController::class,'delete'])->middleware('car')->name('delete-review');
 Route::get('/edit_review/{id}',[reviewController::class,'edit'])->middleware('car')->name('edit-review');
 Route::put('/review-update/{id}', [reviewController::class,'update'])->middleware('car')->name('update-review');

 //shop review
 Route::get('/mechanic/all_reviews',[reviewController::class,'shopReview'])->middleware('mechanic')->name('shopreview');
 Route::get('/dealer/all_reviews',[reviewController::class,'shopReviewDealer'])->middleware('dealer')->name('shopreviewdealer');
 Route::get('/dealer/reply_review/{id}',[reviewController::class,'replyshowdealer'])->middleware('dealer')->name('replyreviewdealer');
 Route::put('/dealer/reply-review/{id}',[reviewController::class,'replydealer'])->middleware('dealer')->name('update-shopreviewdealer');
 Route::get('/mechanic/reply_review/{id}',[reviewController::class,'replyshow'])->middleware('mechanic')->name('replyreview');
 Route::put('/mechanic/reply-review/{id}',[reviewController::class,'reply'])->middleware('mechanic')->name('update-shopreview');
 Route::get('/mechanic/appointment',[appointmentController::class,'shopappointment'])->middleware('mechanic')->name('shopappointment');
 Route::get('/mechanic/app_detail/{id}',[appointmentController::class,'shopappointmentdetail'])->middleware('mechanic')->name('shopappointmentdetail');
 //dealer1 review 
 Route::get('/dealer1/all_reviews',[reviewController::class,'shopReviewDealer1'])->middleware('dealer1')->name('shopreviewdealer1');
 Route::get('/dealer1/reply_review/{id}',[reviewController::class,'replyshowdealer1'])->middleware('dealer1')->name('replyreviewdealer1');
 Route::put('/dealer1/reply-review/{id}',[reviewController::class,'replydealer1'])->middleware('dealer1')->name('update-shopreviewdealer1');
 //shop appointment

Route::get('/mechanic/reject_appointment/{id}',[appointmentController::class,'reject'])->middleware('mechanic')->name('rejectappointment');
Route::get('/mechanic/deleteshopappointment/{id}',[appointmentController::class,'shopdelete'])->middleware('mechanic')->name('deleteshopappointment');


//dealer dashboard and shop info
Route::get('/dealer/shop_info',[shopController::class,'shopInfoDealer'])->middleware('dealer')->name('shop_info_d');
//adding first time
Route::post('/dealer/add-shop-info-dealer',[shopController::class,'createDealer'])->middleware('dealer')->name('add-shop-info-dealer');
 Route::get('/dealer/dealer_dashboard',[shopController::class,'dealerdashboard'])->middleware('dealer')->name('dealer_dashboard');

 //dealer shop profile
 Route::get('/dealer/shop_profile',[shopController::class,'shopProfileDealer'])->middleware('dealer')->name('shop_profile_dealer');
 Route::get('/dealer/edit_dealer_shop',[shopController::class,'editDealer'])->middleware('dealer')->name('edit_dealer_shop');
 Route::put('/dealer/shop_profile-update', [shopController::class,'updateDealer'])->middleware('dealer')->name('dealer-shop-update');
 //dealer1
 Route::get('/dealer1/shop_profile',[shopController::class,'shopProfileDealer1'])->middleware('dealer1')->name('shop_profile_dealer1');
 Route::get('/dealer1/edit_dealer_shop',[shopController::class,'editDealer1'])->middleware('dealer1')->name('edit_dealer_shop1');
 Route::put('/dealer1/shop_profile-update', [shopController::class,'updateDealer1'])->middleware('dealer1')->name('dealer-shop-update1');

 //spare parts in dealer shop
Route::get('/dealer/all_spareparts',[productController::class,'view'])->middleware('dealer')->name('allspareparts');
Route::get('/dealer/add_spareparts',[productController::class,'getview'])->middleware('dealer')->name('add-spareparts');
Route::post('/dealer/add-sparepart',[productController::class,'create'])->middleware('dealer')->name('addsparepart');
Route::get('/dealer/delete-sparepart/{id}',[productController::class,'delete'])->middleware('dealer')->name('delete-sparepart');
Route::get('/dealer/edit_sparepart/{id}',[productController::class,'showedit'])->middleware('dealer')->name('edit-sparepart');
Route::put('/dealer/update_sparepart/{id}',[productController::class, 'update'])->middleware('dealer')->name('update-sparepart');

//queries
Route::get('/send_query/{id}',[queryController::class, 'getview'])->middleware('car')->name('sendquery');
Route::post('/send-query/{id}',[queryController::class, 'sendQuery'])->middleware('car')->name('send-query');
Route::get('/all_queries',[queryController::class,'allQueries'])->middleware('car')->name('allqueries');
Route::get('/delete-query/{id}',[queryController::class,'deleteUser'])->middleware('car')->name('deleteUserq');
Route::get('/detail_query/{id}',[queryController::class,'detailQuery'])->middleware('car')->name('detail_query');
//shop query record
Route::get('/dealer/all_queries',[queryController::class,'allQueriesDealer'])->middleware('dealer')->name('allqueriesdealer');
Route::get('/dealer/delete-query/{id}',[queryController::class,'delete'])->middleware('dealer')->name('deleteq');
Route::get('/dealer/detail_query/{id}',[queryController::class,'detailQueryDealer'])->middleware('dealer')->name('detail_query-dealer');
Route::get('/dealer/respond_query/{id}',[queryController::class,'showview'])->middleware('dealer')->name('getrespond');
Route::put('/dealer/respond-query/{id}',[queryController::class,'respond'])->middleware('dealer')->name('respond');
//add favorite
Route::get('/add_favorite/{id}',[favoriteController::class,'add'])->middleware('car')->name('addtofavorite');
Route::get('/remove_favorite/{id}',[favoriteController::class,'remove'])->middleware('car')->name('removefromfavorite');

//all mechanics
Route::get('/mechanics',[userController::class,'homepagemechanic'])->name('homepage-mechanic');
Route::get('/dealers',[userController::class,'homepagedealer'])->name('homepage-dealer');

//dealer1
 Route::get('/dealer1/dealer_inventory/{id}',[shopController::class,'manageInventory'])->middleware('dealer')->name('manageInventory');
 Route::get('/dealer1/dealer_dashboard',[shopController::class,'dealer1dashboard'])->name('dealer1dashboard');
 //dealer product
 Route::get('/dealer1/product',[inventoryProductController::class,'view'])->middleware('dealer1')->name('allproducts');
  Route::get('/dealer1/add_product',[inventoryProductController::class,'showaddproduct'])->middleware('dealer1')->name('add-products');
  Route::post('/dealer1/add-product',[inventoryProductController::class,'create'])->middleware('dealer1')->name('add-product');
  Route::get('/dealer1/delete-product/{id}',[inventoryProductController::class,'delete'])->middleware('dealer1')->name('delete-product');

  Route::get('/dealer1/edit_product/{id}',[inventoryProductController::class,'showedit'])->middleware('dealer1')->name('showeditproduct');
  Route::get('/dealer1/edit_quantity/{id}',[inventoryProductController::class,'addQuantity'])->middleware('dealer1')->name('showquantity');
  Route::put('/dealer1/update-product/{id}',[inventoryProductController::class,'update'])->middleware('dealer1')->name('update-product');
 Route::put('/dealer1/update-quantity/{id}',[inventoryProductController::class,'updateQuantity'])->middleware('dealer1')->name('update-quantity');
   Route::get('/dealer1/product_details/{id}',[inventoryProductController::class,'showdetail'])->middleware('dealer1')->name('showdetailp');

   //sellling dashboard
   Route::get('dealer1/selling_dashboard',[salesController::class,'view'])->middleware('dealer1')->name('salesdashboard');
   Route::post('dealer1/sell',[salesController::class,'sell'])->middleware('dealer1')->name('sellproduct');
   Route::get('dealer1/allsales',[salesController::class,'viewsales'])->middleware('dealer1')->name('allsales');
  Route::get('dealer1/deletesales/{id}',[salesController::class,'delete'])->middleware('dealer1')->name('delete-sale');
   Route::get('dealer1/rollback/{id}',[salesController::class,'rollback'])->middleware('dealer1')->name('rollback');
   Route::get('/allproducts',[inventoryProductController::class,'homepage'])->name('allproducthomepage');
   Route::post('/searched_parts',[inventoryProductController::class,'search'])->name('allproductsearch');
   Route::get('product_detail/{id}',[inventoryProductController::class,'detail'])->name('productdetailhomepage');
    Route::get('/browse_catalog/{id}',[inventoryProductController::class,'browseCatalog'])->name('browsecatalog');
    Route::post('/searched_parts/{id}',[inventoryProductController::class,'searchShop'])->name('allproductsearchshop');
 //reservation
  Route::post('/reserve_product',[reservationController::class,'reserve'])->middleware('car')->name('reserve');
  Route::get('/reservation',[reservationController::class,'viewall'])->middleware('car')->name('viewreserve');
   Route::get('/cancelreservation/{id}',[reservationController::class,'cancel'])->middleware('car')->name('cancelreserve');
  Route::get('/deletereservation/{id}',[reservationController::class,'deleteUser'])->middleware('car')->name('deletereserve');
  Route::get('/reservation_detail/{id}',[reservationController::class,'detail'])->middleware('car')->name('detailreservation');
  Route::get('/daeler1/reservation',[reservationController::class,'viewallshop'])->middleware('dealer1')->name('viewreserveshop');
   Route::get('/dealer1/deletereservation/{id}',[reservationController::class,'deleteShop'])->middleware('dealer1')->name('deletereserveshop');
    Route::get('/dealer1/cancelreservation/{id}',[reservationController::class,'cancelShop'])->middleware('dealer1')->name('cancelreserveshop');
  Route::get('/daeler1/reservation_detail/{id}',[reservationController::class,'detailShop'])->middleware('dealer1')->name('detailreservationshop');


  //block unblock mechanic
  Route::get('/blockappointment/{id}',[appointmentController::class,'block'])->middleware('mechanic')->name('blockappointment');
    Route::get('/unblockappointment/{id}',[appointmentController::class,'unblock'])->middleware('mechanic')->name('unblockappointment');
  Route::get('/mechanic/blockedUser',[appointmentController::class,'allblocked'])->middleware('mechanic')->name('allblockedappointment');
//block query
  Route::get('/blockquery/{id}',[queryController::class,'block'])->middleware('dealer')->name('blockquery');
    Route::get('/unblockquery/{id}',[queryController::class,'unblock'])->middleware('dealer')->name('unblockquery');
     Route::get('/dealer/blockedUser',[queryController::class,'allblocked'])->middleware('dealer')->name('allblockedquery');
//block reservation
 Route::get('/blockres/{id}',[reservationController::class,'block'])->middleware('dealer1')->name('blockres');
    Route::get('/unblockres/{id}',[reservationController::class,'unblock'])->middleware('dealer1')->name('unblockres');
     Route::get('/dealer1/blockedUser',[reservationController::class,'allblocked'])->middleware('dealer1')->name('allblockedres');

     //mechanic feature ad
     Route::get('/mechanic/run_feature_ad',[featureAdController::class,'showplan'])->middleware('mechanic')->name('runfeatureadm');

   

     //admin

Route::get('/allshops',[shopController::class, 'allshops'])->middleware('admin')->name('allshops');
Route::get('/allreviewss',[reviewController::class, 'allreviews'])->middleware('admin')->name('allreviews');
Route::get('/allreviewss/{id}',[reviewController::class, 'adminDelete'])->middleware('admin')->name('allreviewsd');
     //
Route::post ( '/mechanic/featuread', [featureAdController::class,'call'] )->name('payment');
  Route::get ( '/mechanic/featueradpayment',[featureAdController::class,'paymentview'] )->name('paymentview');
  Route::post('/mechanic/addfeaturead',[featureAdController::class,'userdetails'])->name('aduserdetail');
