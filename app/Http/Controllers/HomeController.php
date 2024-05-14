<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Child;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        $customerCount = Customer::count();
        $childrenCount =Child::count();
        $invoiceCount= Invoice::count();
        $user = Auth::user();
        $usertype = $user->usertype;
        $today = date('Y-m-d'); 
        
        $totalMonth = Invoice::whereMonth('date', now()->month)
                                       ->whereYear('date', now()->year)
                                       ->sum('total');
         $totalToday = Invoice::where('date', $today)->sum('total');
        //  $dataSet = [ 'labels' => ['January', 'February', 'March', 'April', 'May'],
        //                                 'data' => [65, 59, 80, 81, 56],
        //                             ];
                                    $lastSevenDays = [];
                                    for ($i = 6; $i >= 0; $i--) {
                                        $lastSevenDays[] = date('Y-m-d', strtotime("-$i days"));
                                    }
                                
                                    // Query to get count of invoices for each of the last 7 days
                                    $dataSet = [
                                        'labels' => [],
                                        'data' => []
                                    ];
                                    foreach ($lastSevenDays as $day) {
                                        $invoiceCount = Invoice::whereDate('date', $day)->count();
                                        $dataSet['labels'][] = date('F j', strtotime($day)); // Format date as "Month Day"
                                        $dataSet['data'][] = $invoiceCount;
                                    }

                                    $barChartData = [
                                        'labels' => [],
                                        'data' => []
                                    ];
                                    foreach ($lastSevenDays as $day) {
                                        $totalSum = Invoice::whereDate('date', $day)->sum('total');
                                        $barChartData['labels'][] = date('F j', strtotime($day)); // Format date as "Month Day"
                                        $barChartData['data'][] = $totalSum;
                                    }
                            
                                    $childGenders = Child::select('gender', DB::raw('COUNT(*) as count'))
                                    ->groupBy('gender')
                                     ->get();

        return view('admin.dashboard', ['customerCount' => $customerCount,'childrenCount' => $childrenCount,'invoiceCount' => $invoiceCount,'totalMonth' => $totalMonth,'usertype' => $usertype,'dataSet' => $dataSet,'totalToday'=>$totalToday,'childGenders'=> $childGenders,'barChartData'=> $barChartData]);


        
    }
    public function index1()
    {
        $customerCount = Customer::count();
        $childrenCount =Child::count();
        $invoiceCount= Invoice::count();
        $user = Auth::user();
        $usertype = $user->usertype;
        
        $totalMonth = Invoice::whereMonth('date', now()->month)
                                       ->whereYear('date', now()->year)
                                       ->sum('total');

        //  $dataSet = [ 'labels' => ['January', 'February', 'March', 'April', 'May'],
        //                                 'data' => [65, 59, 80, 81, 56],
        //                             ];
                                    $lastSevenDays = [];
                                    for ($i = 6; $i >= 0; $i--) {
                                        $lastSevenDays[] = date('Y-m-d', strtotime("-$i days"));
                                    }
                                
                                    // Query to get count of invoices for each of the last 7 days
                                    $dataSet = [
                                        'labels' => [],
                                        'data' => []
                                    ];
                                  
        return view('admin.dashboard1', ['customerCount' => $customerCount,'childrenCount' => $childrenCount,'invoiceCount' => $invoiceCount,'totalMonth' => $totalMonth,'usertype' => $usertype,'dataSet' => $dataSet]);

        
    }
    public function paneldata(){

        $customerCount = Customer::count();

        
        return view('dashboard', ['customerCount' => $customerCount]);
    }
}
