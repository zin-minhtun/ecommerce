<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    public $orders;
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
        return view('home');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function calculateReport($year)
    {
        $gross_sale = 0;
        $net_sale = 0;
        $actual_cost = 0;
        $order_price_history = array();

        $orders = Order::where('state', 'confirm')
            ->whereYear('created_at', $year)
            ->latest()
            ->get();

        foreach ($orders as $order) {
            array_push($order_price_history, $order->getProfit);
        }
        foreach ($order_price_history as $price_history) {
            $gross_sale += $price_history->total_price;
            $net_sale += $price_history->total_discount_price;
            $actual_cost += $price_history->total_cost_price;
        }
        $data = [
            'gross_sale' => $gross_sale,
            'net_sale' => $net_sale,
            'actual_cost' => $actual_cost,
        ];
        return $data;
    }

    public function report(Request $request)
    {
        if ($request->ajax()) {
            $result = $this->calculateReport($request->input('input_year'));
            return $result;
        }
        $result = $this->calculateReport(date('Y'));
        return view('admin.report', compact('result'));
    }

    public function DelideryOrdertHome()
    {
        return view('admin.delivery-order');
    }
}
