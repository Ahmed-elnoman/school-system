<?php

namespace App\Http\Controllers;

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
        return view('admin.content.exams.index', compact('exams', 'subjects'));
    }

    public function store(Request $request) {
        Exam::create([
            'name'   => $request->subject,
            'date'   => $request->subject_date
        ]);
        session()->flash('Add', 'تم اضافة المادة بنجاح');
        return back();
    }
}
