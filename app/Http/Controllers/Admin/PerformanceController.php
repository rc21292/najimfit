<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\AdminRequest;
use App\Models\Note;
use DB;
use URL;
use Carbon\Carbon;
use Session;
use Auth;
use App\Models\ClientTable;
use App\Models\Package;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

use Spatie\Permission\Traits\HasRoles;

class PerformanceController extends Controller
{

     private $user_ids = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return view('backend.admin.performance.index');
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



   public function tables()
   {
       return view('backend.admin.performance.tables');
   }

   public function getTablesPerDay()
   {
         $month = date("Y",strtotime("-1 year"));
         $year = date("Y");;
         $month = date("m",strtotime("-1 month"));
         $month = date('m');
         $nutritionist_id = Auth::user()->id;

          $order_shipped_graph = DB::select("
            SELECT Year(created_at)  AS 'year',
                   Month(created_at) AS 'month',
                   Day(created_at)   AS 'day',
                   Count(*)          AS 'orders'
            FROM   nutritionist_clients
            WHERE  nutritionist_id = $nutritionist_id
                   AND Month(created_at) = $month
                   AND Year(created_at) = $year
            GROUP  BY Year(created_at),
                      Month(created_at),
                      Day(created_at)
            ORDER  BY Year(created_at) DESC,
                      Month(created_at) DESC,
                      Day(created_at) DESC
            LIMIT  100 
            ");
          if (empty($order_shipped_graph)) {             
            $month = date("m",strtotime("-1 month"));
        }
         $order_shipped_graph = DB::select("
            SELECT Year(created_at)  AS 'year',
                   Month(created_at) AS 'month',
                   Day(created_at)   AS 'day',
                   Count(*)          AS 'orders'
            FROM   nutritionist_clients
            WHERE  nutritionist_id = $nutritionist_id
                   AND Month(created_at) = $month
                   AND Year(created_at) = $year
            GROUP  BY Year(created_at),
                      Month(created_at),
                      Day(created_at)
            ORDER  BY Year(created_at) DESC,
                      Month(created_at) DESC,
                      Day(created_at) DESC
            LIMIT  100 
            ");

        foreach ($order_shipped_graph as $key => $value) {

        $dateObj   = \DateTime::createFromFormat('!m', $value->month);
        $monthName = $dateObj->format('M'); 

        $order_shipped_graph[$key]->monthFull = 'Day-'.$value->day;
        $order_shipped_graph[$key]->monthName = $monthName;
      }

      return response()->json([
        'data' => $order_shipped_graph,
      ]);

   }

   public function getchatsPerDay(){

        $thisMonth = date('m');

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

        $result = array_merge($incoming_msg, $outgoing_msg);

        $array_merge = array_filter($result, function ($val) use ($thisMonth) {
            $month_name =  date('m',strtotime($val['timestamp']));
            return $month_name == $thisMonth;
        });

        if ( count($array_merge) <= 0 ) {           

            $thisMonth = date("m",strtotime("-1 month"));
        }

         $array_merge = array_filter($result, function ($val) use ($thisMonth) {
            $month_name =  date('m',strtotime($val['timestamp']));
            return $month_name == $thisMonth;
        });

        $date_count = array();


        foreach ($array_merge as $key2 => $value2) {
            $array_merge[$key2]['date'] = date('Y-m-d',strtotime($value2['timestamp']));
            $array_merge[$key2]['day'] = date('d',strtotime($value2['timestamp']));
            $array_merge[$key2]['month'] = date('m',strtotime($value2['timestamp']));
            $array_merge[$key2]['year'] = date('Y',strtotime($value2['timestamp']));
        }


        $new_array = array();
        foreach($array_merge as $v) {
            $date_key = strtotime($v['date']); 
            if(!isset($new_array[$date_key])) { 
                $new_array[$date_key] = array_merge($v, array('total' => 0));
            }
            $new_array[$date_key]['total']++; 
        }

        $neee = array();
        $data_array = array_values($new_array);
        foreach ($data_array as $key => $value) {

            $dateObj   = \DateTime::createFromFormat('!m', $value['month']);
            $monthName = $dateObj->format('M'); 

            $neee[$key]['monthFull'] = 'Day-'.$value['day'];
            $neee[$key]['monthName'] = $monthName;
            $neee[$key]['orders'] = $value['total'];
            $neee[$key]['day'] = $value['day'];
            $neee[$key]['month'] = $value['month'];
            $neee[$key]['year'] = $value['year'];
        }


        return response()->json([
            'data' => $obj = json_decode(json_encode($neee))
        ]);

        return response()->json([
            'data' => $obj = json_decode(json_encode($order_shipped_graph))
        ]);

    }

   public function getComplaintsPerDay()
   {
         $month = date("Y",strtotime("-1 year"));
         $year = date("Y");;
         $month = date("m",strtotime("-1 month"));
         $month = date('m');
         $nutritionist_id = Auth::user()->id;
         $order_shipped_graph = DB::select("
            SELECT Year(created_at)  AS 'year',
                   Month(created_at) AS 'month',
                   Day(created_at)   AS 'day',
                   Count(*)          AS 'orders'
            FROM   complaints
            WHERE  nutritionist_id = $nutritionist_id
                   AND Month(created_at) = $month
                   AND Year(created_at) = $year
            GROUP  BY Year(created_at),
                      Month(created_at),
                      Day(created_at)
            ORDER  BY Year(created_at) DESC,
                      Month(created_at) DESC,
                      Day(created_at) DESC
            LIMIT  100 
            ");

         if (empty($order_shipped_graph)) {
             $month = date("m",strtotime("-1 month"));
         }

         $order_shipped_graph = DB::select("
            SELECT Year(created_at)  AS 'year',
                   Month(created_at) AS 'month',
                   Day(created_at)   AS 'day',
                   Count(*)          AS 'orders'
            FROM   complaints
            WHERE  nutritionist_id = $nutritionist_id
                   AND Month(created_at) = $month
                   AND Year(created_at) = $year
            GROUP  BY Year(created_at),
                      Month(created_at),
                      Day(created_at)
            ORDER  BY Year(created_at) DESC,
                      Month(created_at) DESC,
                      Day(created_at) DESC
            LIMIT  100 
            ");

        foreach ($order_shipped_graph as $key => $value) {

        $dateObj   = \DateTime::createFromFormat('!m', $value->month);
        $monthName = $dateObj->format('M'); 

        $order_shipped_graph[$key]->monthFull = 'Day-'.$value->day;
        $order_shipped_graph[$key]->monthName = $monthName;
      }

      return response()->json([
        'data' => $order_shipped_graph,
      ]);

   }

   public function complaints()
   {
       return view('backend.admin.performance.complaints');
   }

}
