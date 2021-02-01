<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\Package;
use DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
      $this->middleware(['permission:coupons']);
    }
    
    public function index()
    {
        $coupons = Coupon::Join('packages','packages.id','=','coupons.package_id')->select('coupons.id','coupons.name','coupons.code','packages.name as package','coupons.type', 'coupons.discount', 'coupons.status')->get();
        return view('backend.admin.coupons.index',compact('coupons'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = Package::all();
        return view('backend.admin.coupons.create',compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('coupons')->insert([
         'name'     => $request->name,
         'code'     => $request->code,
         'package_id' => $request->package,
         'type'     => $request->type,
         'discount' => $request->discount,
         'date_start' => $request->start,
         'date_end' => $request->end,
         'status' => $request->has('status') ? $request->status : "off"
    ]);
        return redirect()->route('coupons.index')->with('success','Coupon Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        $packages = Package::all();
        return view('backend.admin.coupons.edit',compact('coupon','packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        DB::table('coupons')->where('id',$coupon->id)->update([
          'name'     => $request->name,
          'code'     => $request->code,
          'package_id' => $request->package,
          'type'     => $request->type,
          'discount' => $request->discount,
          'date_start' => $request->start,
          'date_end' => $request->end,
          'status' => $request->has('status') ? $request->status : "off"
    ]);
        return redirect()->route('coupons.index')->with('success','Coupon Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.index')->with('success','Coupon Deleted successfully');
    }
}
