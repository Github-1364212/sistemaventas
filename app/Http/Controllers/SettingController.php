<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function setting(Request $request)
    {
        $setting = DB::table('settings')->first();
        return view('ajuste.setting', compact('setting'));
    }
    public function updatewebsite(Request $request, $id)
    {
        $validata = $request->validate([
            'company_name' => 'required|max:255',
            'company_address' => 'required|max:255',
            'company_email' => 'required|max:255',
            'company_phone' => 'required',
            'company_mobile' => 'required',
            'company_city' => 'required|max:30',
            'company_ruc' => 'required',
            'company_zipcode' => 'required',
        ]);
        $data = array();
        $data['company_name'] = $request->company_name;
        $data['company_address'] = $request->company_address;
        $data['company_email'] = $request->company_email;
        $data['company_phone'] = $request->company_phone;
        $data['company_mobile'] = $request->company_mobile;
        $data['company_city'] = $request->company_city;
        $data['company_ruc'] = $request->company_ruc;
        $data['company_zipcode'] = $request->company_zipcode;
        $image = $request->company_logo;
        if ($image) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'melody/company/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if ($success) {
                $data['company_logo'] = $image_url;
                unlink($request->old_photo);
                DB::table('settings')->where('id', $id)->update($data);
                $notification = array(
                    'message' => 'Configuración actualizada correctamente',
                    'alert-type' => 'success'
                );
                return redirect()->route('setting')->with($notification);
            }
        } else {
            $data['company_logo'] = $request->old_photo;
            DB::table('settings')->where('id', $id)->update($data);
            $notification = array(
                'message' => 'Configuración actualizada correctamente',
                'alert-type' => 'success'
            );
            return redirect()->route('setting')->with($notification);
        }
    }
}
