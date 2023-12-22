<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('customer.add_customer');
    }
    // Insertar Clientes
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:20',
            'address' => 'required',
            'photo' => 'required',
            'city' => 'required',
        ]);
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['shopname'] = $request->shopname;
        $data['city'] = $request->city;


        $image = $request->file('photo');

        if ($image) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/customer/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $data['photo'] = $image_url;
            $customer = DB::table('customers')->insert($data);
            if ($customer) {
                $notification = array(
                    'message' => 'Cliente insertado con éxito',
                    'alert-type' => 'success'
                );
                return Redirect()->back()->with($notification);
            } else {
                $notification = array(
                    'message' => 'Cliente insertado fallido',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }
        } else {
            return Redirect()->back();
        }
    }
    // Todos los Clientes
    public function allcustomer()
    {
        $customer = DB::table('customers')->get();
        return view('customer.all_customer')->with('customer', $customer);
    }
    // Ver Clientes
    public function viewcustomer($id)
    {
        $single = DB::table('customers')->where('id', $id)->first();
        return view('customer.view_customer', compact('single'));
    }
    // Eliminar Clientes
    public function deletecustomer($id)
    {
        $delete = DB::table('customers')->where('id', $id)->first();
        $photo = $delete->photo;
        unlink($photo);
        $dltuser = DB::table('customers')->where('id', $id)->delete();
        if ($dltuser) {
            $notification = array(
                'message' => 'Cliente eliminado con éxito',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.customer')->with($notification);
        } else {
            $notification = array(
                'message' => 'Cliente eliminado fallido',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    // Editar Clientes
    public function editcustomer($id)
    {
        $edit = DB::table('customers')->where('id', $id)->first();
        return view('customer.edit_customer', compact('edit'));
    }

    // Actualizar Clientes
    public function updatecustomer(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;

        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['shopname'] = $request->shopname;
        $data['city'] = $request->city;
        $image = $request->photo;

        if ($image) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/customer/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $data['photo'] = $image_url;
            $img = DB::table('customers')->where('id', $id)->first();
            $image_path = $img->photo;
            $done = unlink($image_path);
            $user = DB::table('customers')->where('id', $id)->update($data);
            if ($user) {
                $notification = array(
                    'message' => 'Cliente actualizado con éxito',
                    'alert-type' => 'success'
                );
                return Redirect()->route('all.customer')->with($notification);
            } else {
                return Redirect()->back();
            }
        } else {
            $oldphoto = $request->old_photo;
            if ($oldphoto) {
                $data['photo'] = $oldphoto;
                $user = DB::table('customers')->where('id', $id)->update($data);
                if ($user) {
                    $notification = array(
                        'message' => 'Cliente actualizado con éxito',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.customer')->with($notification);
                } else {
                    return Redirect()->back();
                }
            }
        }

    }
}
