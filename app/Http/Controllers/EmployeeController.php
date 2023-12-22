<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('employee.add_employee');
    }
    // Insertar empleados
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'nid_no' => 'required|max:20',
            'address' => 'required',
            'phone' => 'required|max:20',
            'photo' => 'required',
            'salary' => 'required',
        ]);
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['experience'] = $request->experience;
        $data['nid_no'] = $request->nid_no;
        $data['salary'] = $request->salary;
        $data['vacation'] = $request->vacation;
        $data['city'] = $request->city;
        $image = $request->file('photo');
        if ($image) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/employee/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $data['photo'] = $image_url;
            $employee = DB::table('employees')->insert($data);
            if ($employee) {
                $notification = array(
                    'message' => 'Empleado insertado con éxito',
                    'alert-type' => 'success'
                );
                return Redirect()->route('all.employee')->with($notification);
            } else {
                $notification = array(
                    'message' => 'Empleado insertado fallido',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }
        } else {
            return Redirect()->back();
        }
    }
    // Mostrar todos los empleados
    public function allemployees()
    {
        $employees = Employee::all();
        return view('employee.all_employee', compact('employees'));
    }
    // Ver empleados
    public function viewemployee($id)
    {
        $single = DB::table('employees')->where('id', $id)->first();
        return view('employee.view_employee', compact('single'));
    }
    // Eliminar empleados
    public function deleteemployee($id)
    {
        $delete = DB::table('employees')->where('id', $id)->first();
        $photo = $delete->photo;
        unlink($photo);
        $dltuser = DB::table('employees')->where('id', $id)->delete();
        if ($dltuser) {
            $notification = array(
                'message' => 'Empleado eliminado con éxito',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.employee')->with($notification);
        } else {
            $notification = array(
                'message' => 'Empleado eliminado fallido',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    // Editar empleados
    public function editemployee($id)
    {
        $edit = DB::table('employees')->where('id', $id)->first();
        return view('employee.edit_employee', compact('edit'));
    }
    // Actualizar empleados
    public function updateemployee(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['experience'] = $request->experience;
        $data['nid_no'] = $request->nid_no;
        $data['salary'] = $request->salary;
        $datea['vacation'] = $request->vacation;
        $data['city'] = $request->city;
        $image = $request->photo;

        if ($image) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/employee/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $data['photo'] = $image_url;
            $img = DB::table('employees')->where('id', $id)->first();
            $image_path = $img->photo;
            $done = unlink($image_path);
            $user = DB::table('employees')->where('id', $id)->update($data);
            if ($user) {
                $notification = array(
                    'message' => 'Empleado actualizado con éxito',
                    'alert-type' => 'success'
                );
                return Redirect()->route('all.employee')->with($notification);
            } else {
                return Redirect()->back();
            }
        } else {
            $oldphoto = $request->old_photo;
            if ($oldphoto) {
                $data['photo'] = $oldphoto;
                $user = DB::table('employees')->where('id', $id)->update($data);
                if ($user) {
                    $notification = array(
                        'message' => 'Empleado actualizado con éxito',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.employee')->with($notification);
                } else {
                    return Redirect()->back();
                }
            }
        }
    }
}
