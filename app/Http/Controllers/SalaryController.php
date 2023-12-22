<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return  view('salary.add_salary');
    }
    // Mostrar Salarios
    public function allsalary()
    {
        $salary = DB::table('salaries')
            ->join('employees', 'salaries.emp_id', 'employees.id')
            ->select('salaries.*', 'employees.name', 'employees.salary', 'employees.photo')
            ->orderBy('id', 'DESC')
            ->get();
        return view('salary.all_salary', compact('salary'));    }
    // Insertar Salarios
    public function store(Request $request)
    {
        $month = $request->month;
        $emp_id = $request->emp_id;
        $advanced = DB::table('salaries')
            ->where('month', $month)
            ->where('emp_id', $emp_id)
            ->first();
        if ($advanced === NULL) {
            $data = array();
            $data['emp_id'] = $request->emp_id;
            $data['month'] = $request->month;
            $data['year'] = $request->year;
            $data['advanced_salary'] = $request->advanced_salary;

            $advanced = DB::table('salaries')->insert($data);
            if ($advanced) {
                $notification = array(
                    'message' => 'Salario insertado con éxito',
                    'alert-type' => 'success'
                );
                return Redirect()->back()->with($notification);
            } else {
                $notification = array(
                    'message' => 'Error al insertar el salario',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Ya se ha insertado el salario para este empleado en este mes',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    // Pagar Salarios
    public function paysalary()
    {

        $employee = DB::table('employees')->get();
        return view('salary.pay_salary', compact('employee'));
    }
    // Ver Salarios
    public function viewsalary($id)
    {
        $salary = DB::table('salaries')
            ->join('employees', 'salaries.emp_id', 'employees.id')
            ->select('salaries.*', 'employees.name', 'employees.salary', 'employees.photo')
            ->where('salaries.id', $id)
            ->first();
        return view('salary.view_salary', compact('salary'));
    }
    // Eliminar Salarios
    public function deletesalary($id)
    {
        $delete = DB::table('salaries')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Salario eliminado con éxito',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Error al eliminar el salario',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    // Editar Salarios
    public function editsalary($id)
    {
        $salary = DB::table('salaries')->where('id', $id)->first();
        return view('salary.edit_salary', compact('salary'));
    }
    // Actualizar Salarios
    public function updatesalary(Request $request, $id)
    {
        $data = array();
        $data['emp_id'] = $request->emp_id;
        $data['month'] = $request->month;
        $data['year'] = $request->year;
        $data['advanced_salary'] = $request->advanced_salary;

        $advanced = DB::table('salaries')->where('id', $id)->update($data);
        if ($advanced) {
            $notification = array(
                'message' => 'Salario actualizado con éxito',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.salary')->with($notification);
        } else {
            $notification = array(
                'message' => 'Error al actualizar el salario',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
