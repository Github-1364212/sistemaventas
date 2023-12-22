<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addtocart(Request $request)
    {
        $data = array();
        $data['id'] = $request->id;
        $data['name'] = $request->name;
        $data['qty'] = $request->qty;
        $data['price'] = $request->price;


        $plus = Cart::add([
            'id' => $data['id'],
            'name' => $data['name'],
            'qty' => $data['qty'],
            'price' => $data['price']
        ]);
        if ($plus) {
            $notification = array(
                'message' => 'Producto agregado al carrito',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Error al agregar el producto',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function cartupdate(Request $request, $rowId)
    {

        $qty = $request->qty;
        $update = Cart::update($rowId, $qty);
        if ($update) {
            $notification = array(
                'message' => 'Cantidad actualizada',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Error al actualizar la cantidad',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function cartremove($rowId)
    {
        $remove = Cart::remove($rowId);
        if ($remove) {
            $notification = array(
                'message' => 'Producto eliminado',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Producto eliminado',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function createinvoice(Request $request)
    {
        $validatedData = $request->validate(
            [
                'cus_id' => 'required',
            ],
            [
                'cus_id.required' => 'Seleccione un cliente',
            ]
        );
        $cus_id = $request->cus_id;
        $customer = DB::table('customers')->where('id', $cus_id)->first();
        $contents = Cart::content();
        return view('pos.invoice', compact('customer', 'contents'));
    }
    public function finalinvoice(Request $request)
    {
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['order_status'] = $request->order_status;
        $data['total_products'] = $request->total_products;
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;

        $order_id = DB::table('orders')->insertGetId($data);
        $contents = Cart::content();
        $odata = array();
        foreach ($contents as $content) {
            $odata['order_id'] = $order_id;
            $odata['product_id'] = $content->id;
            $odata['quantity'] = $content->qty;
            $odata['unitcost'] = $content->price;
            $odata['total'] = $content->total;
            $insert = DB::table('ordersdetails')->insert($odata);
        }
        if ($insert) {
            $notification = array(
                'message' => 'Venta realizada con éxito',
                'alert-type' => 'success'
            );
            Cart::destroy();
            return Redirect()->route('pos')->with($notification);
        } else {
            $notification = array(
                'message' => 'Error al realizar la venta',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }

        // if ($insert) {
        //     $notification = array(
        //         'message' => 'Venta realizada con éxito',
        //         'alert-type' => 'success'
        //     );
        //     Cart::destroy();
        //     return Redirect()->route('dashboard')->with($notification);
        // }else{
        //     $notification = array(
        //         'message' => 'Error al realizar la venta',
        //         'alert-type' => 'error'
        //     );
        //     return Redirect()->back()->with($notification);
        // }
    }
}
