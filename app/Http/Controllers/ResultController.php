<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $subjects  = Subject::all();
        $students  = Student::all();
        $exams     = Exam::all();
        $results   = Result::all();

        return view('admin.content.results.index', compact( 'results','subjects', 'students', 'exams'));
    }

    public function store(Request $request) {
        Result::create([
            'student_id'   => $request->student,
            'subject_id'   => $request->subject,
            'exam_id'      => $request->exam,
            'marks'        => $request->marks
        ]);
        session()->flash('Add', 'تم اضافة النتيجة بنجاح');
        return back();
    }

    public function update(Request $request) {
        $id  = $request->id;

        Result::where('id', $id)->update([
            'marks'        => $request->result_marks
        ]);
        session()->flash('edit', 'تم تعديل درجة النتيجة  بنجاح');
        return back();
    }

    public function print($student_id) {
        $student_result = Result::where('student_id', $student_id)->get();

        return view('admin.content.results.print_result', compact('student_result'));
    }
}
