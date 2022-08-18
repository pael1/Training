<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('orders')->get();

        return response()->json([
            'item' => $orders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $order = new Order();
        $order->items_id = $request->items_id;
        $order->save();

        return response()->json([
            'message' => 'successfully ordered',
            'item' => $order
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orders = DB::table('orders')->where('id', '=', $order->id)->get();

        return response()->json([
            'item' => $orders
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrderRequest $request, Order $order)
    {
        DB::table('orders')
            ->where('id', $order->id)
            ->update(array('items_id' => $request->items_id));

        return response()->json([
            'message' => 'successfully updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        DB::table('orders')->where('id', '=', $order->id)->delete();

        return response()->json([
            'message' => 'successfully deleted'
        ], 200);
    }
}
