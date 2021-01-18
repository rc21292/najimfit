<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use File;
use Storage;
use Spatie\Permission\Models\Role;
use DB;
use function GuzzleHttp\json_encode;
use Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Request;
use App\Models\AdminRequest;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

/**
 * Class Helper
 *
 */
class Helper extends Model
{
    /**
     * Set slug before saving in DB
     *
     * @access public
     *
     * @return array
     */
    
    public static function getAdminRequestsCount()
    {
      $user_id = Auth::user()->id;
      return $request_count = AdminRequest::where('status',0)->where('nutritionist_id',$user_id)->count();
  }
  public static function getMeetingnotificationCount()
  {
    $notification_count = DB::table('meeting_notifications')->where('user_id',Auth::User()->id)->where('seen',0)->count();
}

}
