<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tag;
use Illuminate\Http\Request;
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function getReportsByDate($orders)
    {
        $ordering_by_date_history = array();
        $ordering_by_date = $orders->groupBy(function ($order) {
            return $order->updated_at->format('Y-m-d');
        });
        foreach ($ordering_by_date as $key => $value) {
            $ordering_by_date_history[$key] = $value;
        }
        $data = array();
        foreach ($ordering_by_date_history as $key => $value) {
            $inner_price_total = 0;
            $inner_dis_total = 0;
            $inner_cost_total = 0;
            foreach ($value as $item) {
                // dd($item);
                $inner_price_total += $item->getProfit->total_price;
                $inner_dis_total += $item->getProfit->total_discount_price;
                $inner_cost_total += $item->getProfit->total_cost_price;
            }
            $data_report = new stdClass;
            $data_report->total_price = $inner_price_total;
            $data_report->total_cost = $inner_cost_total;
            $data_report->discount = $inner_price_total - $inner_dis_total;
            $data_report->net_sale = $inner_dis_total;
            $data_report->created_at = $value->first()->created_at->format('Y-m-d');
            array_push($data, $data_report);
        }
        return $data;
    }

    public function getReports(Request $request)
    {
        $orders = Order::where('state', 'confirm')
            ->whereYear('created_at', $request->input('input_year'))
            ->latest()
            ->get();
        $result = $this->getReportsByDate($orders);
        return DataTables::of(collect($result))->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
}
