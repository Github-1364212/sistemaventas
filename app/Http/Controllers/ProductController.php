<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Product;
use App\Imports\ProductImport;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('product.add_product');
    }
    public function allproduct()
    {
        $product = DB::table('products')->get();
        return view('product.all_product', compact('product'));
    }
    public function store(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['cat_id'] = $request->cat_id;
        $data['sup_id'] = $request->sup_id;
        $data['product_garage'] = $request->product_garage;
        $data['product_route'] = $request->product_route;
        $data['buy_date'] = $request->buy_date;
        $data['expire_date'] = $request->expire_date;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        $image = $request->file('product_image');
        if ($image) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/product/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if ($success) {
                $data['product_image'] = $image_url;
                $product = DB::table('products')->insert($data);
                if ($product) {
                    $notification = array(
                        'message' => 'Producto insertado correctamente',
                        'alert-type' => 'success'
                    );
                    return Redirect()->back()->with($notification);
                } else {
                    $notification = array(
                        'message' => 'Error al insertar el producto',
                        'alert-type' => 'error'
                    );
                    return Redirect()->back()->with($notification);
                }
            } else {
                return Redirect()->back();
            }
        } else {
            return Redirect()->back();
        }
    }
    public function viewproduct($id)
    {
        $producto = DB::table('products')
            ->join('categories', 'products.cat_id', 'categories.id')
            ->join('suppliers', 'products.sup_id', 'suppliers.id')
            ->select('categories.cat_name', 'products.*', 'suppliers.name')
            ->where('products.id', $id)
            ->first();
        return view('product.view_product', compact('producto'));
    }
    public function deleteproduct($id)
    {
        $delete = DB::table('products')->where('id', $id)->first();
        $photo = $delete->product_image;
        unlink($photo);
        $dltuser = DB::table('products')->where('id', $id)->delete();
        if ($dltuser) {
            $notification = array(
                'message' => 'Producto eliminado correctamente',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.product')->with($notification);
        } else {
            $notification = array(
                'message' => 'Error al eliminar el producto',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function editproduct($id)
    {
        $producto = DB::table('products')->where('id', $id)->first();
        return view('product.edit_product', compact('producto'));
    }
    public function updateproduct(Request $request, $id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        $data['product_garage'] = $request->product_garage;
        $data['product_route'] = $request->product_route;
        $data['buy_date'] = $request->buy_date;
        $data['expire_date'] = $request->expire_date;
        $data['cat_id'] = $request->cat_id;
        $data['sup_id'] = $request->sup_id;

        $image = $request->file('product_image');
        if ($image) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/product/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if ($success) {
                $data['product_image'] = $image_url;
                $img = DB::table('products')->where('id', $id)->first();
                $image_path = $img->product_image;
                $done = unlink($image_path);
                $user = DB::table('products')->where('id', $id)->update($data);
                if ($user) {
                    $notification = array(
                        'message' => 'Producto actualizado correctamente',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.product')->with($notification);
                } else {
                    return Redirect()->back();
                }
            }
        } else {
            $oldphoto = $request->old_photo;
            if ($oldphoto) {
                $data['product_image'] = $oldphoto;
                $user = DB::table('products')->where('id', $id)->update($data);
                if ($user) {
                    $notification = array(
                        'message' => 'Producto actualizado correctamente',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.product')->with($notification);
                } else {
                    return Redirect()->back();
                }
            }
        }
    }
    public function importproduct()
    {
        return view('product.import_product');
    }
    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
    public function import(Request $request)
    {
        $import=Excel::import(new ProductImport, $request->file('import_file'));
        if ($import) {
            $notification = array(
                'message' => 'Productos importados correctamente',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.product')->with($notification);
        } else {
            $notification = array(
                'message' => 'Error al importar los productos',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
