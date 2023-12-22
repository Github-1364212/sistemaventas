<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AttendenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function takeattendence()
    {
        $employee = DB::table('employees')->get();
        return view('attendence.take_attendence', compact('employee'));
    }
    public function insertattendence(Request $request)
    {
        $date = $request->att_date;
        $att = DB::table('attendences')->where('att_date', $date)->first();
        if ($att) {
            $notification = array(
                'message' => 'Asistencia Ya Tomada',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        } else {
            foreach ($request->user_id as $id) {
                $data = [
                    "user_id" => $id,
                    "attendence" => $request->attendence[$id],
                    "att_date" => $request->att_date,
                    "att_year" => $request->att_year,
                    "month" => $request->month,
                    "edit_date" => date("d_m_y"),
                ];
                $att = DB::table('attendences')->insert($data);
            }
            if ($att) {
                $notification = array(
                    'message' => 'Asistencia Tomada Correctamente',
                    'alert-type' => 'success',
                );
                return redirect()->back()->with($notification);
            } else {
                $notification = array(
                    'message' => 'No se pudo tomar la asistencia',
                    'alert-type' => 'error',
                );
                return redirect()->back()->with($notification);
            }
        }
    }
    public function allattendence()
    {
        $all_att = DB::table('attendences')->select('edit_date')->groupBy('edit_date')->get();
        return view('attendence.all_attendence', compact('all_att'));
    }
    public function editattendence($edit_date)
    {
        $date = DB::table('attendences')->where('edit_date', $edit_date)->first();
        $data = DB::table('attendences')
            ->join('employees', 'attendences.user_id', 'employees.id')
            ->select('employees.name', 'employees.photo', 'attendences.*')
            ->where('edit_date', $edit_date)
            ->get();
        return view('attendence.edit_attendence', compact('data', 'date'));
    }
    public function updateattendence(Request $request)
    {
        foreach ($request->user_id as $id) {
            $data = [
                "attendence" => $request->attendence[$id],
                "att_date" => $request->att_date,
                "att_year" => $request->att_year,
                "edit_date" => date("d_m_y"),
                "month" => $request->month,
            ];
            $attendence=Attendence::where(['att_date'=>$request->att_date,'id'=>$id])->first();
            $attendence->update($data);
        }
        if ($attendence) {
            $notification = array(
                'message' => 'Asistencia Actualizada Correctamente',
                'alert-type' => 'success',
            );
            return redirect()->route('all.attendence')->with($notification);
        } else {
            $notification = array(
                'message' => 'No se pudo actualizar la asistencia',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
    }
    public function viewattendence($edit_date)
    {
        $date = DB::table('attendences')->where('edit_date', $edit_date)->first();
        $data = DB::table('attendences')
            ->join('employees', 'attendences.user_id', 'employees.id')
            ->select('employees.name', 'employees.photo', 'attendences.*')
            ->where('edit_date', $edit_date)
            ->get();
        return view('attendence.view_attendence', compact('data', 'date'));
    }
}
