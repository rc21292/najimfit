<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Auth;
use App\Models\Client;
use App\Models\Package;
use App\Models\Question;
use App\Models\Coupon;
use Carbon\Carbon;
use DB;
use Session;

class CartController extends Controller
{
	public function getcart(){
		$user_id = Auth::Client()->id;
		if(DB::table('cart')->where('client_id', $user_id)->exists()){
		$cart = DB::table('cart')->join('packages','packages.id','=','cart.package_id')->select('cart.*','packages.name','packages.description',DB::raw("CONCAT('https://tegdarco.com/uploads/packages/', packages.image) AS imageurl"))->where('client_id', $user_id)->get();
		$response = $cart;
		}else{
		$response = $cart;
		}
		return $response;
	}

	public function addtocart(Request $request){
		$user_id = Auth::Client()->id;
		if(DB::table('cart')->where('client_id', $user_id)->where('package_id', $request->package)->exists()){
			$cart = DB::table('cart')->join('packages','packages.id','=','cart.package_id')->select('cart.*','packages.name','packages.description', DB::raw("CONCAT('https://tegdarco.com/uploads/packages/', packages.image) AS imageurl"))->where('client_id', $user_id)->get();
			$response = ['success' => $cart , 'message' => 'Package already added to Cart' ];
		return response($response, 200);
		}else{
		$subtotal = Package::find($request->package)->price;
		$quantity = 1;
		Session::put('total',$subtotal);
		$cart_id = DB::table('cart')->insertGetId(['client_id' => $user_id, 'package_id' => $request->package, 'subtotal'=> $subtotal, 'quantity'=> $quantity,'discount'=> 0, 'total' => $subtotal]);
		$cart = DB::table('cart')->join('packages','packages.id','=','cart.package_id')->select('cart.*','packages.name','packages.description',DB::raw("CONCAT('https://tegdarco.com/uploads/packages/', packages.image) AS imageurl"))->where('client_id', $user_id)->get();
		$response = ['success' => $cart];
		return response($response, 200);
		}
	}

	public function deletecart(Request $request){
		$user_id = Auth::Client()->id;
		if(DB::table('cart')->where('client_id', $user_id)->exists()){
		DB::table('cart')->where('client_id', $user_id)->delete();
		$response = ['success' => 'Package removed from cart'];
		}else{
		$response = ['success' => 'Nothing to delete cart is already empty'];
		}

		return response($response, 200);
	}

	public function updatecart(Request $request){
		$user_id = Auth::Client()->id;
		if($request->quantity > 0){
			$package = Package::find($request->package);
			$price = $package->price;
		}
		$subtotal = $price * $request->quantity;
		
		if(isset($request->coupon)){
		$check=DB::table('coupons')->where('code',$request->coupon)->where('package_id',$request->package)->exists();
		$validities = DB::table('coupons')->where('code',$request->coupon)->first();
			if($check){
				if($validities->type == 'P'){
					$total = $subtotal - ($subtotal * ($validities->discount/100));
					$discount = $subtotal * ($validities->discount/100);
				}else if($validities->type == 'F'){
					$total = $subtotal - $validities->discount ;
					$discount = $validities->discount;
				}
			}else{
				$response = ['message' => 'Coupon is not valid. Please try again!' ];
				return response($response, 200);
			}
		}else{
			$total = $subtotal;
		    $discount = 0;	
		}

		DB::table('cart')->where('id', $request->cart_id)->update(['package_id' => $request->package, 'subtotal'=> $subtotal, 'quantity'=> $request->quantity, 'coupon' => $request->coupon, 'discount' => $discount, 'total' => $total]);
		Session::put('total',$total);
		$cart = DB::table('cart')->join('packages','packages.id','=','cart.package_id')->select('cart.*','packages.name','packages.description', DB::raw("CONCAT('https://tegdarco.com/uploads/packages/', packages.image) AS imageurl"))->where('client_id', $user_id)->get();
			$response = ['success' => $cart , 'message' => 'Cart Updated Successfully' ];
			return response($response, 200);
	}

	public function coupons(){
		$coupons = DB::table('coupons')->get();
		$response = ['success' => $coupons];
		return response($response, 200);
	}
	
}