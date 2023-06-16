<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\shop;
use Illuminate\Support\Facades\Hash;
use Session;

class CustomAuthController extends Controller
{
    //
    public function showlogin(){
return view("auth.login");
    }
    public function showsignup(){
    	return view("auth.signup");
    }
 


    public function login(Request $request){
    	$user=users::where('email',$request->email)->first();
    	if($user){
    		if(Hash::check($request->password, $user->password)){
                if ($user->isDeleted) {
                return back()->with('fail', 'Your account has been deleted.');
            }
$request->session()->put('loginId',$user->id);
$request->session()->put('role', $user->role);
$request->session()->put('name', $user->name);

if($user->role=="admin"){
return redirect()->route('admin');
}
else if($user->role=="mechanic"){
    if($user->status=="Not Verified"){
return redirect()->route('shop_info_m')->with('success', 'Add Details To Access Dashboard!');
    }
    else{
        $userId = $user->id; // Replace 1 with the actual user ID

$shop = shop::where('user_id', $userId)->first();

if ($shop) {
     $id = $shop->id;

 return redirect()->route('mechanic_dashboard')->with('success','Welcome To Purza Online Mechanics Dashboard');

    }
}
}
else if($user->role =="dealer1"){
    $userId = $user->id; // Replace 1 with the actual user ID

$shop = shop::where('user_id', $userId)->first();

if ($shop) {
     $id = $shop->id;
//dealer dashboard
 return redirect()->route('dealer1dashboard')->with('success','Welcome To Purza Online Dealerss Dashboard');

    }
}
else if($user->role=="dealer"){
    if($user->status=="Not Verified"){
return redirect()->route('shop_info_d')->with('success', 'Add Details To Access Dashboard!');
    }
    else{
        $userId = $user->id; // Replace 1 with the actual user ID

$shop = shop::where('user_id', $userId)->first();

if ($shop) {
     $id = $shop->id;
//dealer dashboard
 return redirect()->route('dealer_dashboard')->with('success','Welcome To Purza Online Dealer Dashboard');

    }
}
}
else if($user->role=="car_owner"){
    return redirect()->route('dashboard')->with('success', 'Welcome To Purza Online!');
}

return view('welcome');
    		}
    		else{
    			return back()->with('fail','Password  not Matches.');
    		}
    	}
    		else{
    			return back()->with('fail','Email Not Registered');
    		}
    	}





    
    public function signup(Request $request){
 $request->validate([
    'email' => [
        'required',
        'email',
        Rule::unique('users')->where(function ($query) {
            return $query->where('isDeleted', false);
        })
    ],
]);
 $user=new users();

    $user->name = $request->name;

 $user->email=$request->email;
 $user->password=Hash::make($request->password);
 $user->email=$request->email;
 $user->role=$request->role;
 $res=$user->save();
 if($res){
 	return redirect()->route('login')->with('success', 'Registered Successfully! Login Now!');
 }
 else{
 	return back()->with('fail','Something went wrong');
 }
    }

    public function logout(){
    	if(Session::has('loginId')){
    		Session::pull('loginId');
            Session::pull('role');
            Session::pull('name');
    		return redirect('login');
    	}
    }

    
}

