<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Models\Client;
use App\Models\PasswordResetClients;
use Illuminate\Support\Str;
use DB;


class PasswordResetController extends Controller
{
	public function create(Request $request)
	{
		$request->validate([
			'email' => 'required|string|email',
		]);
		$user = Client::where('email', $request->email)->first();
		if (!$user)
			return response()->json([
				'message' => "We can't find a user with that e-mail address."
			], 404);
        // $a = mt_rand(1000, 9999); 
		$passwordReset = PasswordResetClients::updateOrCreate(
			['email' => $user->email],
			[
				'email' => $user->email,
				'token' => Str::random(40)
			]
		);
		if ($user && $passwordReset)
			$user->notify(
				new PasswordResetRequest($passwordReset->token)
			);
		return response()->json([
			'success' => 'We have e-mailed your password reset link!'
		]);
	}
    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
    	$passwordReset = PasswordResetClients::where('token', $token)
    	->first();
    	if (!$passwordReset)
    		return response()->json([
    			'message' => 'This password reset token is invalid.'
    		], 404);
    	if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
    		$passwordReset->delete();
    		return response()->json([
    			'message' => 'This password reset token is invalid.'
    		], 404);
    	}
    	return response()->json([
			'success' => $passwordReset
		]);
    }
     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
     public function reset(Request $request)
     {
     	/*$request->validate([
     		'email' => 'required|string|email',
     		'password' => 'required|string',
     		'confirm_password' => 'required|same:password',
     		'token' => 'required|string'
     	]);*/

        $validator = Validator::make($request->all(), [
           'email' => 'required|string|email',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
            'token' => 'required|string'
        ]);

        if ($validator->fails())
        {
            return response(['success'=>false,'message'=>'The given data was invalid.'], 404);
        }


     	$passwordReset = PasswordResetClients::where([
     		['token', $request->token],
     		['email', $request->email]
     	])->first();
     	if (!$passwordReset)
     		return response()->json(['success'=>false,
     			'message' => 'This password reset token is invalid.'
     		], 404);
     	$user = Client::where('email', $passwordReset->email)->first();
     	if (!$user)
     		return response()->json([
     			'message' => "We can't find a user with that e-mail address."
     		], 404);
     	$user->password = bcrypt($request->password);
     	$user->save();
     	$passwordReset->delete();
     	$user->notify(new PasswordResetSuccess($passwordReset));
     	return response()->json([
			'success' => $user
		]);
     }


     public function resetByMobile(Request $request)
    {
        $mobile_no = preg_replace(
     '/\+(?:998|996|995|994|993|992|977|976|975|974|973|972|971|970|968|967|966|965|964|963|962|961|960|886|880|856|855|853|852|850|692|691|690|689|688|687|686|685|683|682|681|680|679|678|677|676|675|674|673|672|670|599|598|597|595|593|592|591|590|509|508|507|506|505|504|503|502|501|500|423|421|420|389|387|386|385|383|382|381|380|379|378|377|376|375|374|373|372|371|370|359|358|357|356|355|354|353|352|351|350|299|298|297|291|290|269|268|267|266|265|264|263|262|261|260|258|257|256|255|254|253|252|251|250|249|248|246|245|244|243|242|241|240|239|238|237|236|235|234|233|232|231|230|229|228|227|226|225|224|223|222|221|220|218|216|213|212|211|98|95|94|93|92|91|90|86|84|82|81|66|65|64|63|62|61|60|58|57|56|55|54|53|52|51|49|48|47|46|45|44\D?1624|44\D?1534|44\D?1481|44|43|41|40|39|36|34|33|32|31|30|27|20|7|1\D?939|1\D?876|1\D?869|1\D?868|1\D?849|1\D?829|1\D?809|1\D?787|1\D?784|1\D?767|1\D?758|1\D?721|1\D?684|1\D?671|1\D?670|1\D?664|1\D?649|1\D?473|1\D?441|1\D?345|1\D?340|1\D?284|1\D?268|1\D?264|1\D?246|1\D?242|1)\D?/'
    , ''
    , $request->mobile
    );
        $no_exists = Client::where('phone',$mobile_no)->exists();
        if ($no_exists) 
        {
            $id = "ACbcfbb403ad0a2267c6e559cf9c7c8119";
            $token = "40c2f3243a9529205c1fcaf36f9b2f66";
            $url = "https://api.twilio.com/2010-04-01/Accounts/$id/SMS/Messages";
            $from = "+12283356343";
            $to = $request['mobile'];
            $code = $this->setOTP();
            $body = 'Your otp for forgot password is '.$code;

            $check = DB::table('user_otps')->where('phone',$mobile_no)->exists();
            if($check == true){   
                $res = DB::table('user_otps')->where('phone',$mobile_no)->update([ 
                    'otp' => $code, 
                ]);         

            }else{
                $res = DB::table('user_otps')->updateOrInsert([ 
                    'otp' => $code, 'phone'=> $mobile_no, 'created_at' => now(), 'is_verified' => 0]);
            }

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
            $xml = simplexml_load_string($y);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
            if (isset($array['SMSMessage']) && !empty($array['SMSMessage'])) {
                return $response = ['success' => true,'message' => 'Otp sended successfully'];
            }
            if (isset($array['RestException']) && $array['RestException']['Status'] == 400) {
                return $response = ['success' => false,'message' => $array['RestException']['Message']];
            }
        }else{
            return $response = ['success' => false,'message' => "Mobile no. doesn't exist "];
        }
        

        curl_close($x);
    }

    public function setOTP(){
      $a = mt_rand(1000, 9999); 
      $this->otp = $a;
      return $this->otp;
  }

 }

