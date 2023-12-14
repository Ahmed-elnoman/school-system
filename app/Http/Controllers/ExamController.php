<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $exams    = Exam::all();
        $subjects = Subject::all();
        $classes  = ClassRoom::all();
        return view('admin.content.exams.index', compact('exams', 'subjects', 'classes'));
    }

    public function store(Request $request) {

        $request->validate([
            'subject'    => 'required',
            'exam_date'  => 'required|date',
            'exam_time'  => 'required'
        ],
        [
            'subject.required'       => 'الارجاء ادخال اسم المادة',
            'exam_date.required'     => 'الارجاء ادخال تاريخ الامتحان',
            'exam_date.date'         => 'يجب ان يكون الاتاريخ من نوع التاريح'
        ]
        );
        //
        $subject_name = Subject::where('id', $request->subject)->first();
        //
        Exam::create([
            'name'           => $subject_name->name,
            'date'           => $request->exam_date,
            'time'           => $request->exam_time,
            'class_room_id'  => $request->class_name
        ]);
        session()->flash('Add', 'تم اضافة المادة بنجاح');
        return back();

    }
}