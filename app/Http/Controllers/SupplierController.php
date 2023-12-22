<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return  view('supplier.add_supplier');
    }
    // Insertar Proveedores
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
        $data['shop'] = $request->shop;
        // $data['accountholder'] = $request->accountholder;
        // $data['accountnumber'] = $request->accountnumber;
        // $data['bankname'] = $request->bankname;
        // $data['branchname'] = $request->branchname;
        $data['city'] = $request->city;
        $data['type'] = $request->type;

        $image = $request->file('photo');

        if ($image) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/supplier/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $data['photo'] = $image_url;
            $customer = DB::table('suppliers')->insert($data);
            if ($customer) {
                $notification = array(
                    'message' => 'Proveedor insertado con éxito',
                    'alert-type' => 'success'
                );
                return Redirect()->route('all.supplier')->with($notification);
            } else {
                $notification = array(
                    'message' => 'Proveedor insertado fallido',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }
        } else {
            return Redirect()->back();
        }
    }

    // Mostrar todos los proveedores
    public function allsupplier()
    {
        $supplier = DB::table('suppliers')->get();
        return view('supplier.all_supplier', compact('supplier'));
    }

    // Ver un solo proveedor
    public function viewsupplier($id)
    {
        $single = DB::table('suppliers')->where('id', $id)->first();
        return view('supplier.view_supplier', compact('single'));
    }

    // Eliminar proveedor
    public function deletesupplier($id)
    {
        $delete = DB::table('suppliers')->where('id', $id)->first();
        $photo = $delete->photo;
        unlink($photo);
        $dltuser = DB::table('suppliers')->where('id', $id)->delete();
        if ($dltuser) {
            $notification = array(
                'message' => 'Proveedor eliminado con éxito',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.supplier')->with($notification);
        } else {
            $notification = array(
                'message' => 'Proveedor eliminado fallido',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    // Editar proveedor
    public function editsupplier($id)
    {
        $edit = DB::table('suppliers')->where('id', $id)->first();
        return view('supplier.edit_supplier', compact('edit'));
    }

    // Actualizar proveedor
    public function updatesupplier(Request $request, $id){
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['shop'] = $request->shop;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        // $data['accountholder'] = $request->accountholder;
        // $data['accountnumber'] = $request->accountnumber;
        // $data['bankname'] = $request->bankname;
        // $data['branchname'] = $request->branchname;
        $data['city'] = $request->city;
        $data['type'] = $request->type;

        $image = $request->file('photo');

        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/supplier/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $data['photo'] = $image_url;
            $img = DB::table('suppliers')->where('id', $id)->first();
            $image_path = $img->photo;
            $done = unlink($image_path);
            $user = DB::table('suppliers')->where('id', $id)->update($data);
            if($user){
                $notification = array(
                    'message' => 'Proveedor actualizado con éxito',
                    'alert-type' => 'success'
                );
                return Redirect()->route('all.supplier')->with($notification);
            }else{
                $notification = array(
                    'message' => 'Proveedor actualizado fallido',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }
        }
        else{
            $oldphoto = $request->old_photo;
            if($oldphoto){
                $data['photo'] = $oldphoto;
                $user = DB::table('suppliers')->where('id', $id)->update($data);
                if($user){
                    $notification = array(
                        'message' => 'Proveedor actualizado con éxito',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.supplier')->with($notification);
                }else{
                    $notification = array(
                        'message' => 'Proveedor actualizado fallido',
                        'alert-type' => 'error'
                    );
                    return Redirect()->back()->with($notification);
                }
            }
        }
    }
}
