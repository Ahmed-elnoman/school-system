<?php

namespace App\Http\Controllers;

use App\Models\ChargeFor;
use App\Models\ClassRoom;
use App\Models\Issue;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $students   = Student::all();
        $classRoom  = ClassRoom::all();

        return view('admin.content.students.index', compact('students', 'classRoom'));
    }

    public function getCharge($id) {
        $data['charge'] = ChargeFor::where("classRoom_id", $id)
        ->get(['price', 'id']);

        return response()->json($data);
    }

    public function store(Request $request) {
        // return $request;
        Student::create([
            'full_name'  => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make('12341234'),
            'gender'     => $request->gender,
            'address'    => $request->address,
            'phone_parent'  => $request->phone_parent,
            'join_date'     => $request->join_date,
            'chargeFor_id'  => $request->charge_for,
            'classRoom_id'  => $request->class_room
        ]);
        session()->flash('Add', 'تم التسجيل بنجاح');
        return back();
    }

    public function update(Request $request) {
        $id  = $request->id;
        Student::where('id', $id)->update([
            'full_name'  => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make('12341234'),
            'gender'     => $request->gender,
            'address'    => $request->address,
            'phone_parent'  => $request->phone_parent,
            'join_date'     => $request->join_date,
            'chargeFor_id'  => $request->charge,
            'classRoom_id'  => $request->room
        ]);
        session()->flash('edit', 'تم تعديل بنجاح');
        return back();
    }

    public function problem(Request $request) {
        Issue::create([
            'type'        => $request->problem_name,
            'description' => $request->problem_description,
            'student_id'  => $request->id,
            'is_resolved' => 0,
            'date'        => $request->problem_date
        ]);
        Student::where('id' , $request->id)->update([
            'status' => 1
        ]);
        session()->flash('problem', 'تم انزار التلميذ بنجاح');
        return back();
    }

    public function softDelete(Request $request) {
        $id  = $request->id;
        Student::where('id', $id)->update([
            'status' => 2
        ]);
        Student::destroy($id);
        session()->flash('delete', 'تم عملية الفصل  بنجاح');
        return back();
    }

    public function getTrashed() {
        $studentTrashed = Student::onlyTrashed()->get();

        return view('admin.content.students.student', compact('studentTrashed'));
    }

    public function withTrashed(Request $request) {
        $id   = $request->id;
        Student::where('id', $id)->update([
            'status' => 3
        ]);
        Student::withTrashed()->where('id', $id)->restore();
        session()->flash('restore', 'تم عملية الراجع التلميذ  بنجاح');
        return back();
    }

    public function delete(Request $request) {
        $id  = $request->id;

        Student::withTrashed()->where('id', $id)->forceDelete();
        session()->flash('delete', 'تم عملية الحذف  بنجاح');
        return back();
    }
}
