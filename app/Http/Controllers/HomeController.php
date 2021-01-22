<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminRequest;
use App\Models\Client;
use App\Models\Package;
use App\Models\DeferRequest;
use App\Models\Complaint;
use App\Models\Note;
use DB;
use Carbon\Carbon;
use Session;
use Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::User();
        $roles = $user->getRoleNames();
        $role_name =  $roles->implode('', ' ');

        if($role_name == 'Nutritionist'){

           $factory = (new Factory)->withServiceAccount(__DIR__.'/test-tegdarco-firebase-adminsdk-ohk7s-6c3ea5636a.json');

            $database = $factory->createDatabase();

            $incoming = $database->getReference('chats')->orderByChild('receiver_id')->equalTo((string)Auth::user()->id)->getSnapshot()->getValue();

            $incoming_msg = array_filter($incoming, function (array $userData) {
                return $userData['message_from'] == 'user';
            });

            $outgoing = $database->getReference('chats')->orderByChild('sender_id')->equalTo((int)Auth::user()->id)->getSnapshot()->getValue();

            $outgoing_msg = array_filter($outgoing, function (array $userData) {
                return $userData['message_from'] == 'nutri';
            });

            $total_client_chat = count($incoming_msg) + count($outgoing_msg);

            $user = Auth::User();
            $total_clients = Client::join('nutritionist_clients','nutritionist_clients.client_id','clients.id')->where('nutritionist_id',Auth::User()->id)->count();
            $total_requests = DeferRequest::count();
            $total_complaints = Complaint::count();
            $total_notes = Note::where('nutritionist_id',Auth::user()->id)->count();
            $total_users = User::count();
            $total_meetings = DB::table('meetings')->count();
            $total_staff_chat = DB::table('messages')->where('from_id',Auth::User()->id)->orWhere('to_id',Auth::User()->id)->count();


            $table_renewals = DB::table('nutritionist_clients')
            ->join('clients','clients.id','=','nutritionist_clients.client_id')
            ->where('table_status','posted')
            ->where('nutritionist_id',Auth::user()->id)
            ->count();

            $table_due = DB::table('nutritionist_clients')
            ->join('clients','clients.id','=','nutritionist_clients.client_id')
            ->where('table_status','due')
            ->where('nutritionist_id',Auth::user()->id)
            ->count();

            $workout_renewals = DB::table('nutritionist_clients')
            ->join('clients','clients.id','=','nutritionist_clients.client_id')
            ->where('workout_status','posted')
            ->where('nutritionist_id',Auth::user()->id)
            ->count();   

            $workout_due = DB::table('nutritionist_clients')
            ->join('clients','clients.id','=','nutritionist_clients.client_id')
            ->where('workout_status','due')
            ->where('nutritionist_id',Auth::user()->id)
            ->count();   

            return view('home',compact('total_clients','table_renewals','workout_renewals','table_due','workout_due','total_requests','total_complaints','total_notes','total_users','total_meetings','total_client_chat','total_staff_chat'));
        }else{

            $factory = (new Factory)->withServiceAccount(__DIR__.'/test-tegdarco-firebase-adminsdk-ohk7s-6c3ea5636a.json');

            $database = $factory->createDatabase();

            $createPosts = $database->getReference('chats')->getSnapshot()->getValue();

            $total_client_chat = count($createPosts);

            $user = Auth::User();
            $total_clients = Client::count();
            $total_requests = DeferRequest::count();
            $total_complaints = Complaint::count();
            $total_notes = Note::count();
            $total_users = User::count();
            $total_meetings = DB::table('meetings')->count();
            $total_staff_chat = DB::table('messages')->count();

            $packages = DB::table('clients')->join('packages','packages.id','clients.package_id')
            ->select('package_id','packages.name', DB::raw('count(*) as total'))
            ->whereNotNull('package_id')
            ->groupBy('package_id')
            ->get();

            $table_renewals = DB::table('nutritionist_clients')
            ->join('clients','clients.id','=','nutritionist_clients.client_id')
            ->where('table_status','posted')
            ->count();

            $table_due = DB::table('nutritionist_clients')
            ->join('clients','clients.id','=','nutritionist_clients.client_id')
            ->where('table_status','due')
            ->count();

            $workout_renewals = DB::table('nutritionist_clients')
            ->join('clients','clients.id','=','nutritionist_clients.client_id')
            ->where('workout_status','posted')
            ->count();   

            $workout_due = DB::table('nutritionist_clients')
            ->join('clients','clients.id','=','nutritionist_clients.client_id')
            ->where('workout_status','due')
            ->count();   

            return view('home',compact('total_clients','packages','table_renewals','workout_renewals','table_due','workout_due','total_requests','total_complaints','total_notes','total_users','total_meetings','total_client_chat','total_staff_chat'));
        }
    }
}
