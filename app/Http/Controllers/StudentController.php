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
        $request->validate([
            'name'                     => 'required|string',
            'parent_name'              => 'required|string',
            'address'                  => 'required|string',
            'phone_parent'             => 'required|numeric|min:10',
            'good'                     => 'string',
            'medical_situation_file'   => 'file',
            'parent_email'             => 'required|email',
            'parent_address'           => 'required|string',
            'parent_job'               => 'required|string',
            'total_fees'               => 'required|numeric',
            'payment_status'           => 'required'
        ], [
            'name.required'            => 'الارجاء ادخال اسم التلميذ',
            'name.string'              => 'يجب ان يكون اسم التلميذ من نوع نص',

            'parent_name.required'     => 'الارجاء ادخال اسم ولي امر التلميذ',
            'parent_name.string'       => 'يجب ان يكون اسم ولي امر من نوع نص',

            'address.required'         => 'الارجاء ادخال عنوان التلميذ ',
            'address.string'           => 'عنوان التلميذ يجب ان يكون من نوع نص',

            'phone_parent.required'    => 'الارجاء ادخال رقم ولي امر التلميذ ',
            'phone_parent.min'         => 'الرقم ناقص يجب ان يكون عشرة ارقام',

            'parent_email.required'    => 'الارجاء ادخال البريد الالكتروني ',

            'parent_address.required'  => 'الارجاء ادخال عنوان ولي امر التلميذ ',
            'parent_address.string'    => 'عنوان ولي امر يجب ان يكون من نوع نص',

            'parent_job.required'      => 'الارجاء ادخال الامسمي الوظيفي لولي امر التلميذ',

            'total_fees'               => 'الارجاء ادخال الرسوم النهاية',

             'payment_status'          => 'الارجاء ادخال حالة الدفعة',

        ]);


        $ifGood = $request->good;
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

            session()->flash('Add', 'تم التسجيل بنجاح');
            return back();
        }
        else {

            if($request->an_exception){
                $student = Student::create([
                    'name'                            => $request->name,
                    'gender'                          => $request->gender,
                    'address'                         => $request->address,
                    'medical_situation'               => $ifGood,
                    'Medical_situation_file'          => 'default',
                    'chargeFor_id'                    => $request->charge_for,
                    'classRoom_id'                    => $request->class_room,
                    'an_exception_id'                 => $request->an_exception
                ]);
            }else{

                $student = Student::create([
                    'name'                            => $request->name,
                    'gender'                          => $request->gender,
                    'address'                         => $request->address,
                    'medical_situation'               => $ifGood,
                    'Medical_situation_file'          => 'default',
                    'chargeFor_id'                    => $request->charge_for,
                    'classRoom_id'                    => $request->class_room
                ]);
            }

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

        $request->validate([
            'name'                     => 'required|string',
            'parent_name'              => 'required|string',
            'address'                  => 'required|string',
            'phone_parent'             => 'required|numeric|min:10',
            'good'                     => 'string',
            'medical_situation_file'   => 'file',
            'parent_email'             => 'required|email',
            'parent_address'           => 'required|string',
            'parent_job'               => 'required|string',
            'total_fees'               => 'required|numeric',
            'payment_status'           => 'required'
        ], [
            'name.required'            => 'الارجاء ادخال اسم التلميذ',
            'name.string'              => 'يجب ان يكون اسم التلميذ من نوع نص',

            'parent_name.required'     => 'الارجاء ادخال اسم ولي امر التلميذ',
            'parent_name.string'       => 'يجب ان يكون اسم ولي امر من نوع نص',

            'address.required'         => 'الارجاء ادخال عنوان التلميذ ',
            'address.string'           => 'عنوان التلميذ يجب ان يكون من نوع نص',

            'phone_parent.required'    => 'الارجاء ادخال رقم ولي امر التلميذ ',
            'phone_parent.min'         => 'الرقم ناقص يجب ان يكون عشرة ارقام',

            'parent_email.required'    => 'الارجاء ادخال البريد الالكتروني ',

            'parent_address.required'  => 'الارجاء ادخال عنوان ولي امر التلميذ ',
            'parent_address.string'    => 'عنوان ولي امر يجب ان يكون من نوع نص',

            'parent_job.required'      => 'الارجاء ادخال الامسمي الوظيفي لولي امر التلميذ',

            'total_fees'               => 'الارجاء ادخال الرسوم النهاية',

             'payment_status'          => 'الارجاء ادخال حالة الدفعة',

        ]);

        $ifGood = $request->good;
        if($request->file('medical_situation_file')) {
            $medical_situation_file = $request->file('medical_situation_file');
            $rel_name               = $medical_situation_file->hashName();
            $location = 'Image/Student/Medical_situation_file/' . $request->name . '/';


            $medical_situation_file->move($location , $rel_name);
            $filePath = url('Image/Student/Medical_situation_file/'. $request->name . '/', $rel_name);
            Student::where('id', $id)->update([
                'name'                            => $request->name,
                'gender'                          => $request->gender,
                'address'                         => $request->address,
                'medical_situation'               => $request->medical_situation,
                'medical_situation_file'          => $filePath,
                'chargeFor_id'                    => $request->charge_for,
                'classRoom_id'                    => $request->class_room,
                'an_exception_id'                 => $request->an_exception,

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
                'description'     => $request->description,
            ]);
            session()->flash('edit', 'تم تعديل بنجاح');
            return back();
        }else {
            $id  = $request->id;
            if($request->an_exception){
                Student::where('id', $id)->update([
                    'name'                            => $request->name,
                    'gender'                          => $request->gender,
                    'address'                         => $request->address,
                    'medical_situation'               => $ifGood,
                    'Medical_situation_file'          => 'default',
                    'chargeFor_id'                    => $request->charge_for,
                    'classRoom_id'                    => $request->class_room
                ]);
            }else{
                Student::where('id', $id)->update([
                    'name'                            => $request->name,
                    'gender'                          => $request->gender,
                    'address'                         => $request->address,
                    'medical_situation'               => $ifGood,
                    'Medical_situation_file'          => 'default',
                    'chargeFor_id'                    => $request->charge_for,
                    'classRoom_id'                    => $request->class_room
                ]);
            }

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
