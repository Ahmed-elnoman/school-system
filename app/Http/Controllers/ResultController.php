<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $classRooms  = ClassRoom::all();
        $subjects  = Subject::all();
        $students  = Student::all();
        $exams     = Exam::all();
        $results   = Result::all();
        $subject_names = Subject::all('id','name');

        return view('admin.content.results.index', compact('classRooms', 'subject_names','subjects', 'results','students', 'exams'));
    }

    public function searchNew(Request $request){
        $id         = $request->class_name;
        $class_name = ClassRoom::where('id', $id)->first();
        $students  = Student::where('classRoom_id', $id)->get();
        $exams     = Exam::where('class_room_id', $id)->get();
        // $results   = Result::all();

        $subject_names = Exam::all('id','name');

        return view('admin.content.results.show_result',
        compact('class_name', 'subject_names', 'students', 'exams'));
    }


    public function resultTime($id) {
        $subject_name = Subject::where('id', $id)->first();
        $data['charge'] = Exam::where("name", $subject_name)
        ->get(['id', 'date']);

        return response()->json($data);
    }
    public function store(Request $request) {
        return $request;
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