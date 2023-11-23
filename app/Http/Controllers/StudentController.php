<?php

namespace App\Http\Controllers;

use App\Models\AnException;
use App\Models\ChargeFor;
use App\Models\ClassRoom;
use App\Models\Father;
use App\Models\Issue;
use App\Models\PaymentStatus;
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
        // $students   = Student::all();
        $classRoom  = ClassRoom::all();

        return view('admin.content.students.index', compact('classRoom'));
    }

    public function getCharge($id) {
        $data['charge'] = ChargeFor::where("classRoom_id", $id)
        ->get(['id', 'total_fees', 'first_payment', 'second_payment']);

        return response()->json($data);
    }

    public function an_exception($id) {
        $data['charge'] = AnException::where('id', $id)
        ->get(['id', 'discount_rate']);

        return response()->json($data);
    }
    public function getStudentByClass(Request $request) {
        $classRoom  = ClassRoom::all();

        $class_id = $request->class_name;
        $students = Student::where('classRoom_id', $class_id)->get();
        return view('admin.content.students.index', compact('students', 'classRoom'));
    }
    public function create() {

        $classRoom       = ClassRoom::all();
        $an_exceptions   = AnException::all();

        return view('admin.content.students.create', compact('classRoom', 'an_exceptions'));
    }

    public function store(Request $request) {
        if($request->file('medical_situation_file')){
            $medical_situation_file = $request->file('medical_situation_file');
            $rel_name               = $medical_situation_file->hashName();
            $location = 'Image/Student/Medical_situation_file/';

            $medical_situation_file->move($location , $rel_name);

            $filePath = url('Image/Student/Medical_situation_file/', $rel_name);
            $student = Student::create([
                'name'                            => $request->name,
                'gender'                          => $request->gender,
                'address'                         => $request->address,
                'medical_situation'               => $request->medical_situation,
                'medical_situation_file'          => $filePath,
                'chargeFor_id'                    => $request->charge_for,
                'classRoom_id'                    => $request->class_room,
                'an_exception_id'                 => $request->an_exception,
            ]);
            Father::create([
                'name'          => $request->parent_name,
                'email'         => $request->parent_email,
                'password'      => Hash::make('1231234'),
                'phone'         => $request->phone_parent,
                'address'       => $request->parent_address,
                'job'           => $request->parent_job,
                'student_id'    => $student->id
            ]);
            PaymentStatus::create([
                'total_fees'      => $request->total_fees,
                'payment_status'  => $request->payment_status,
                'description'     => $request->description,
                'student_id'      => $student->id
            ]);
            $capacity            = ClassRoom::where('id', $student->classRoom_id)->count('capacity');

            $student_count       = ClassRoom::where('id', $request->class_room)->first('student_count');

            if($student_count->student_count <= $capacity){
                ClassRoom::where('id', $student->classRoom_id)->update([
                    'student_count'  => $student_count->student_count + 1
                ]);
            }
            else {
                session()->flash('delete', 'الفصل ممتلا');
                Student::destroy($student->id);
                return back();
            }
            session()->flash('Add', 'تم التسجيل بنجاح');
            return back();
        }
        else {

            $student = Student::create([
                'name'                            => $request->name,
                'gender'                          => $request->gender,
                'address'                         => $request->address,
                'medical_situation'               => $request->medical_situation,
                'Medical_situation_file'          => 'default',
                'chargeFor_id'                    => $request->charge_for,
                'classRoom_id'                    => $request->class_room,
                'an_exception_id'                 => $request->an_exception
            ]);
            Father::create([
                'name'          => $request->parent_name,
                'email'         => $request->parent_email,
                'password'      => Hash::make('1231234'),
                'phone'         => $request->phone_parent,
                'address'       => $request->parent_address,
                'job'           => $request->parent_job,
                'student_id'    => $student->id
            ]);
            PaymentStatus::create([
                'total_fees'      => $request->total_fees,
                'payment_status'  => $request->payment_status,
                'description'     => $request->description,
                'student_id'      => $student->id
            ]);
            $capacity            = ClassRoom::where('id', $student->classRoom_id)->count('capacity');

            $student_count       = ClassRoom::where('id', $request->class_room)->first('student_count');

            if($student_count->student_count <= $capacity){
                ClassRoom::where('id', $student->classRoom_id)->update([
                    'student_count'  => $student_count->student_count + 1
                ]);
            }
            else {
                session()->flash('delete', 'الفصل ممتلا');
                Student::destroy($student->id);
                return back();
            }
            session()->flash('Add', 'تم التسجيل بنجاح');
            return back();
        }

    }

    public function edit($id) {

        $classRoom       = ClassRoom::all();
        $an_exceptions   = AnException::all();

        $student = Student::find($id);
        return view('admin.content.students.edit', compact('student', 'classRoom', 'an_exceptions'));
    }


    public function update(Request $request , $id) {
        if($request->file('medical_situation_file')) {
            $medical_situation_file = $request->file('medical_situation_file');
            $rel_name               = $medical_situation_file->hashName();
            $location = 'Image/Student/Medical_situation_file/' . $request->name . '/';


            $medical_situation_file->move($location , $rel_name);
            $filePath = url('Image/Student/Medical_situation_file/'. $request->name . '/', $rel_name);
            Student::where('id', $id)->update([
                'name'      => $request->name,
                'gender'    => $request->gender,
                'address'   => $request->address,
                'medical_situation'       => $request->medical_situation,
                'medical_situation_file'  => $filePath,
                'chargeFor_id'            => $request->charge_for,
                'classRoom_id'            => $request->class_room,
                'an_exception_id'         => $request->an_exception
            ]);

            Father::where('student_id', $id)->update([
                'name'          => $request->parent_name,
                'email'         => $request->parent_email,
                'password'      => Hash::make('1231234'),
                'phone'         => $request->phone_parent,
                'address'       => $request->parent_address,
                'job'           => $request->parent_job
            ]);
            PaymentStatus::where('student_id', $id)->update([
                'total_fees'      => $request->total_fees,
                'payment_status'  => $request->payment_status,
                'description'     => $request->description
            ]);
            session()->flash('edit', 'تم تعديل بنجاح');
            return back();
        }else {
            $id  = $request->id;
           Student::where('id', $id)->update([
                'name'               => $request->name,
                'gender'                          => $request->gender,
                'address'                         => $request->address,
                'medical_situation'               => $request->medical_situation,
                'Medical_situation_file'          => 'default',
                'chargeFor_id'                    => $request->charge_for,
                'classRoom_id'                    => $request->class_room,
                'an_exception_id'                 => $request->an_exception
            ]);
            Father::where('student_id', $id)->update([
                'name'          => $request->parent_name,
                'email'         => $request->parent_email,
                'password'      => Hash::make('1231234'),
                'phone'         => $request->phone_parent,
                'address'       => $request->parent_address,
                'job'           => $request->parent_job
            ]);
            PaymentStatus::where('student_id', $id)->update([
                'total_fees'      => $request->total_fees,
                'payment_status'  => $request->payment_status,
                'description'     => $request->description
            ]);
            session()->flash('edit', 'تم تعديل بنجاح');
            return back();
        }
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
