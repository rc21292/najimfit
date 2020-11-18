<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Session;
use Auth;
use App\Models\Diet;

class IntakeSubstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function send_twilio_text_sms($id, $token, $from, $to, $body)
    {
        $url = "https://api.twilio.com/2010-04-01/Accounts/".$id."/SMS/Messages";
        $data = array (
            'From' => $from,
            'To' => $to,
            'Body' => $body,
        );
        $post = http_build_query($data);
        $x = curl_init($url );
        curl_setopt($x, CURLOPT_POST, true);
        curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
        curl_setopt($x, CURLOPT_POSTFIELDS, $post);
        $y = curl_exec($x);
        // echo "<pre>";print_r(curl_getinfo($x));"</pre>";exit;
        curl_close($x);
echo "sss";
        echo "<pre>";print_r($y);"</pre>";exit;
        return $y;
    }

    public function index()
    {

$id = "ACbcfbb403ad0a2267c6e559cf9c7c8119";
$token = "c25fd668e797404fc58c5d1b197c9506";
$url = "https://api.twilio.com/2010-04-01/Accounts/$id/SMS/Messages";
$from = "+12283356343";
$to = "+919026574061"; // twilio trial verified number
$body = "using twilio rest api from Fedrick";
$data = array (
    'From' => $from,
    'To' => $to,
    'Body' => $body,
);
$post = http_build_query($data);
$x = curl_init($url );
curl_setopt($x, CURLOPT_POST, true);
curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
curl_setopt($x, CURLOPT_POSTFIELDS, $post);
$y = curl_exec($x);
// echo "<pre>";print_r($y);"</pre>";exit;
curl_close($x);
var_dump($post);
var_dump($y);


        $this->send_twilio_text_sms("ACbcfbb403ad0a2267c6e559cf9c7c8119", "c25fd668e797404fc58c5d1b197c9506", "+12283356343", "+919026574061", "Testing api please ignore");
die;

		$intake_subs = Diet::exists();

		if ($intake_subs) {

			$intake_subs = Diet::orderBy('created_at')->select('intake_substances.*','clients.firstname','clients.lastname')->join('clients','clients.id','=','intake_substances.client_id')->get();
			// echo "<pre>";print_r($intake_subs->toArray());"</pre>";exit;
			return view('backend.admin.intake-substances.index',compact('intake_subs'))->with('no', 1);
		}

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo "<pre>";print_r('working on it');"</pre>";exit;
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
