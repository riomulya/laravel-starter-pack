<?php

namespace App\Http\Controllers;

use App\Models\SalesTransactions;
// use App\Models\SalesTransactions;
use App\Models\Customers;
use App\Models\PurchaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // $sTransactions = SalesTransactions::with('customer')->get();
        // $pTransactions = PurchaseTransactions::with('supplier')->get();
        // $customer = Customers::all();
        //     $sales = SalesTransactions::select(DB::raw("DATE_FORMAT(Tanggal,'%Y-%m-%d') as month"), 
        //                                        DB::raw("SUM(TotalHarga) as total_sales"))
        //                               ->groupBy('month')
        //                               ->orderBy('month', 'ASC')
        //                               ->get();
    
        //     $labels = $sales->pluck('month');
        //     $data = $sales->pluck('total_sales');
        //     $purchase = PurchaseTransactions::select(DB::raw("DATE_FORMAT(Tanggal,'%Y-%m-%d') as month"), 
        //                                        DB::raw("SUM(TotalHarga) as total_sales"))
        //                               ->groupBy('month')
        //                               ->orderBy('month', 'ASC')
        //                               ->get();
    
        //     $labelsPurchase = $purchase->pluck('month');
        //     $dataPurchase = $purchase->pluck('total_sales');
    
        return view('pages.dashboard');
    }
}
