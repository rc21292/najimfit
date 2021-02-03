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

    public function getMonthOrders() {

        // $clients = DB::table('nutritionist_clients')
        // ->join('users','users.id','=','nutritionist_clients.nutritionist_id')
        // ->join('clients','clients.id','=','nutritionist_clients.client_id')
        // ->select('clients.*','users.name','nutritionist_clients.created_at as assigned_on','nutritionist_clients.client_id')
        // ->where('nutritionist_clients.nutritionist_id',$id)->where('nutritionist_clients.table_status','due')
        // ->get();

       // $order_shipped_graph  = DB::select("select day(created_at) as day count(id) as total_amount from nutritionist_clients where workout_status = 'due' group by day(created_at)order by day desc");

        $sub = \Carbon\Carbon::now()->subMonth();
        $order_shipped_graph = DB::select("SELECT year(created_at) AS 'year',
        month(created_at) AS 'month',
        day(created_at) AS 'day',
        COUNT(*) AS 'orders'
        FROM      nutritionist_clients    
        GROUP BY  year(created_at),
        month(created_at),
        day(created_at)
        ORDER BY  year(created_at) desc ,month(created_at) desc , day(created_at) desc limit 10 ");


        foreach ($order_shipped_graph as $key => $value) {

        $dateObj   = \DateTime::createFromFormat('!m', $value->month);
        $monthName = $dateObj->format('M'); 

        $order_shipped_graph[$key]->monthFull = 'Day-'.$value->day;
      }

      return response()->json([
        'data' => $order_shipped_graph,
      ]);


        echo '<pre>'; print_r($order_shipped_graph); echo '</pre>'; die();



       $visitorTraffic = DB::table('nutritionist_clients')->where('created_at', '>=', \Carbon\Carbon::now()->subMonth())
                        ->groupBy(DB::raw('Date(created_at)'))
                        ->orderBy('created_at', 'DESC')->get();

                        echo '<pre>'; print_r($visitorTraffic); echo '</pre>'; die();

        foreach ($order_shipped_graph as $key => $value) {

            $dateObj   = \DateTime::createFromFormat('!m', $value->month);
            $monthName = $dateObj->format('F'); 

            $order_shipped_graph[$key]->monthFull = $monthName;
        }
       return response()->json([
        'data' => $order_shipped_graph,
    ]);
   }

    public function getOrgById() {

        // $clients = DB::table('nutritionist_clients')
        // ->join('users','users.id','=','nutritionist_clients.nutritionist_id')
        // ->join('clients','clients.id','=','nutritionist_clients.client_id')
        // ->select('clients.*','users.name','nutritionist_clients.created_at as assigned_on','nutritionist_clients.client_id')
        // ->where('nutritionist_clients.nutritionist_id',$id)->where('nutritionist_clients.table_status','due')
        // ->get();

       // $order_shipped_graph  = DB::select("select day(created_at) as day count(id) as total_amount from nutritionist_clients where workout_status = 'due' group by day(created_at)order by day desc");

        $sub = \Carbon\Carbon::now()->subMonth();
        $order_shipped_graph = DB::select("SELECT year(created_at) AS 'year',
        month(created_at) AS 'month',
        day(created_at) AS 'day',
        count(id) as total_amount
        FROM      nutritionist_clients    
        GROUP BY  year(created_at),
        month(created_at),
        day(created_at)
        ORDER BY  year(created_at) desc ,month(created_at) desc , day(created_at) desc limit 10 ");


        foreach ($order_shipped_graph as $key => $value) {

        $dateObj   = \DateTime::createFromFormat('!m', $value->month);
        $monthName = $dateObj->format('M'); 

        $order_shipped_graph[$key]->monthFull = 'Day'.$value->day;
      }

      return response()->json([
        'data' => $order_shipped_graph,
      ]);


        echo '<pre>'; print_r($order_shipped_graph); echo '</pre>'; die();



       $visitorTraffic = DB::table('nutritionist_clients')->where('created_at', '>=', \Carbon\Carbon::now()->subMonth())
                        ->groupBy(DB::raw('Date(created_at)'))
                        ->orderBy('created_at', 'DESC')->get();

                        echo '<pre>'; print_r($visitorTraffic); echo '</pre>'; die();

        foreach ($order_shipped_graph as $key => $value) {

            $dateObj   = \DateTime::createFromFormat('!m', $value->month);
            $monthName = $dateObj->format('F'); 

            $order_shipped_graph[$key]->monthFull = $monthName;
        }
       return response()->json([
        'data' => $order_shipped_graph,
    ]);
   }





   /*
      public function getMonthOrders() {

      $order_shipped_graph = DB::select("SELECT year(created_at) AS 'year',
        month(created_at) AS 'month',
        day(created_at) AS 'day',
        COUNT(*) AS 'orders'
        FROM      orders                          
        GROUP BY  year(created_at),
        month(created_at),
        day(created_at)
        ORDER BY  year(created_at) desc ,month(created_at) desc , day(created_at) desc limit 10 ");

      foreach ($order_shipped_graph as $key => $value) {

        $dateObj   = \DateTime::createFromFormat('!m', $value->month);
        $monthName = $dateObj->format('M'); 

        $order_shipped_graph[$key]->monthFull = $monthName;
      }

      return response()->json([
        'data' => $order_shipped_graph,
      ]);
    }

    public function getOrgById() {
       $order_shipped_graph = DB::select('select year(created_at) as year, month(created_at) as month, count(id) as total_amount from orders where order_status_id = 2 group by year(created_at), month(created_at) order by year desc, month Desc limit 3');

        foreach ($order_shipped_graph as $key => $value) {

            $dateObj   = \DateTime::createFromFormat('!m', $value->month);
            $monthName = $dateObj->format('F'); 

            $order_shipped_graph[$key]->monthFull = $monthName;
        }
       return response()->json([
        'data' => $order_shipped_graph,
    ]);
   }
    */

   public function tables()
   {
       return view('backend.admin.performance.tables');
   }

   public function getTablesPerDay()
   {
       
        $sub = \Carbon\Carbon::now()->subMonth();
        $order_shipped_graph = DB::select("SELECT year(created_at) AS 'year',
        month(created_at) AS 'month',
        day(created_at) AS 'day',
        COUNT(*) AS 'orders'
        FROM      nutritionist_clients    
        GROUP BY  year(created_at),
        month(created_at),
        day(created_at)
        ORDER BY  year(created_at) desc ,month(created_at) desc , day(created_at) desc limit 10 ");


        foreach ($order_shipped_graph as $key => $value) {

        $dateObj   = \DateTime::createFromFormat('!m', $value->month);
        $monthName = $dateObj->format('M'); 

        $order_shipped_graph[$key]->monthFull = 'Day-'.$value->day;
      }

      return response()->json([
        'data' => $order_shipped_graph,
      ]);

   }

   public function getchatsPerDay()
   {
       
        $sub = \Carbon\Carbon::now()->subMonth();
        $order_shipped_graph = DB::select("SELECT year(created_at) AS 'year',
        month(created_at) AS 'month',
        day(created_at) AS 'day',
        COUNT(*) AS 'orders'
        FROM      nutritionist_clients    
        GROUP BY  year(created_at),
        month(created_at),
        day(created_at)
        ORDER BY  year(created_at) desc ,month(created_at) desc , day(created_at) desc limit 10 ");


        foreach ($order_shipped_graph as $key => $value) {

        $dateObj   = \DateTime::createFromFormat('!m', $value->month);
        $monthName = $dateObj->format('M'); 

        $order_shipped_graph[$key]->monthFull = 'Day-'.$value->day;
      }

      return response()->json([
        'data' => $order_shipped_graph,
      ]);

   }

   public function getComplaintsPerDay()
   {
       
        $sub = \Carbon\Carbon::now()->subMonth();
        $order_shipped_graph = DB::select("SELECT year(created_at) AS 'year',
        month(created_at) AS 'month',
        day(created_at) AS 'day',
        COUNT(*) AS 'orders'
        FROM      nutritionist_clients    
        GROUP BY  year(created_at),
        month(created_at),
        day(created_at)
        ORDER BY  year(created_at) desc ,month(created_at) desc , day(created_at) desc limit 10 ");


        foreach ($order_shipped_graph as $key => $value) {

        $dateObj   = \DateTime::createFromFormat('!m', $value->month);
        $monthName = $dateObj->format('M'); 

        $order_shipped_graph[$key]->monthFull = 'Day-'.$value->day;
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
