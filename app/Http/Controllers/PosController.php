<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $product = DB::table('products')
            ->join('categories', 'products.cat_id', 'categories.id')
            ->select('categories.cat_name', 'products.*')
            ->get();
        $customer = DB::table('customers')->get();
        $category = DB::table('categories')->get();
        return view('pos.pos', compact('product', 'customer', 'category'));
    }
    public function pendingorders()
    {
        $pending = DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->select('customers.name', 'orders.*')
            ->where('order_status', 'pending')
            ->get();
        return view('pos.pending_orders', compact('pending'));
    }
    public function vieworderstatus($id)
    {
        $order = DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->where('orders.id', $id)
            ->first();
        $order_details = DB::table('ordersdetails')
            ->join('products', 'ordersdetails.product_id', 'products.id')
            ->select('ordersdetails.*', 'products.product_name', 'products.product_code')
            ->where('order_id', $id)
            ->get();

        return view('pos.order_confirmation', compact('order', 'order_details'));
    }
    public function deleteorderstatus($id)
    {
        $delete = DB::table('orders')->where('id', $id)->delete();
        $notification = array(
            'message' => 'Orden eliminada con éxito',
            'alert-type' => 'success'
        );
        return Redirect()->route('pending.orders')->with($notification);
    }

}
