<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('expense.add_expense');
    }
    public function store(Request $request)
    {
        $data = array();
        $data['details'] = $request->details;
        $data['amount'] = $request->amount;
        $data['month'] = $request->month;
        $data['date'] = $request->date;
        $data['year'] = $request->year;

        $expense = DB::table('expenses')->insert($data);
        if ($expense) {
            $notification = array(
                'message' => 'Gasto agregado correctamente',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Error al agregar el gasto',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function todayExpense()
    {
        $date = date('d/m/Y');
        $today = DB::table('expenses')->where('date',$date)->get();
        return view('expense.today_expense', compact('today'));
    }
    public function editTodayExpense($id)
    {
        $today = DB::table('expenses')->where('id',$id)->first();
        return view('expense.edit_today_expense', compact('today'));
    }
    public function updateTodayExpense(Request $request, $id)
    {
        $data = array();
        $data['details'] = $request->details;
        $data['amount'] = $request->amount;
        $data['month'] = $request->month;
        $data['date'] = $request->date;
        $data['year'] = $request->year;

        $expense = DB::table('expenses')->where('id',$id)->update($data);
        if ($expense) {
            $notification = array(
                'message' => 'Gasto actualizado correctamente',
                'alert-type' => 'success'
            );
            return Redirect()->route('today.expense')->with($notification);
        }else{
            $notification = array(
                'message' => 'Error al actualizar el gasto',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function deleteTodayExpense($id)
    {
        $delete = DB::table('expenses')->where('id',$id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Gasto eliminado correctamente',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Error al eliminar el gasto',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function monthlyExpense()
    {
        $month = date('F');
        $expenses = DB::table('expenses')->where('month',$month)->get();

        return view('expense.monthly_expense', compact('expenses'));
    }
    public function JanuaryExpense()
    {
        $month = "January";
        $expenses = DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthly_expense', compact('expenses'));
    }
    public function febrearyexpense()
    {
        $month = "February";
        $expenses = DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthly_expense', compact('expenses'));
    }
    public function marchexpense()
    {
        $month = "March";
        $expenses = DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthly_expense', compact('expenses'));
    }
    public function aprilexpense()
    {
        $month = "April";
        $expenses = DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthly_expense', compact('expenses'));
    }
    public function mayexpense()
    {
        $month = "May";
        $expenses = DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthly_expense', compact('expenses'));
    }
    public function juneexpense()
    {
        $month = "June";
        $expenses = DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthly_expense', compact('expenses'));
    }
    public function julyexpense()
    {
        $month = "July";
        $expenses = DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthly_expense', compact('expenses'));
    }
    public function augustexpense()
    {
        $month = "August";
        $expenses = DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthly_expense', compact('expenses'));
    }
    public function septembreexpense()
    {
        $month = "September";
        $expenses = DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthly_expense', compact('expenses'));
    }
    public function octoberexpense()
    {
        $month = "October";
        $expenses = DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthly_expense', compact('expenses'));

    }
    public function novemberexpense()
    {
        $month = "November";
        $expenses = DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthly_expense', compact('expenses'));

    }
    public function decemberexpense()
    {
        $month = "December";
        $expenses = DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthly_expense', compact('expenses'));

    }

}
