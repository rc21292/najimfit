<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('newsletter');
    }

    public function store(Request $request)
    {

    	$this->validate($request, [
    		'email' => 'required|email',
    	]);
    	DB::table('newsletter_subscriptions')->insert(
    		['email' => $request->email, 'status' => 0]
    	);

        \Mail::send('newsletter_email',
             array(
                 'email' => $request->get('email'),
             ), function($message) use ($request)
               {
                  $message->from('hello@najimfit.com');
                  $message->to('info@tegdarco.com')->subject
            ("Newsletter Subscription mail");
               });

    	return redirect('/')->with('success_news', 'Thanks For Subscribing our newsletter!');
    	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
