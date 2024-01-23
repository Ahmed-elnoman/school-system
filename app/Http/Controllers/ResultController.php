<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\View\View as ViewResponse;
use Illuminate\Support\Facades\Redis;
use SplDoublyLinkedList;

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
        $results   = Result::all();

        $subject_names = Exam::all();

        return view('admin.content.results.show_result',
        compact('class_name', 'subject_names', 'students', 'exams', 'id', 'results'));
    }


    public function resultTime($id) {
        $subject_name = Subject::where('id', $id)->first();
        $data['charge'] = Exam::where("name", $subject_name)
        ->get(['id', 'date']);

        return response()->json($data);
    }

    public function addResultSubject($id)  {
       $name_subject = Exam::find($id);
       $class_id     = ClassRoom::where('id', $name_subject->class_room_id)->first('id');
       $students     = Student::where('classRoom_id', $class_id->id)->get();

       return view('admin.content.results.add_result_subject', compact('name_subject', 'students'));
    }

    public function store(Request $request){
        // return $request;
        $request->validate([
            'type_result'     => 'required|string',
            'year'            => 'required|date',
            'student_id'      => 'required|integer',
            'exam_id'         => 'required',
            'marks'           => 'required|max:100 | min:0'
        ],[
            'type_result.required' => 'الحقل نوع النتيجة اجباري',
            'type_result.string'   => 'حقل النوع النتيجة يجب ان يكون من نص',

            'year.required'        => 'حقل السنة الدراسية اجباري',
            'year.date'            => 'حقل السنة الدراسية يجب ان يكون من نوع تاريج',

            'student_id.required'  => 'حقل اسم الطالب اجباري',

            'exam_id.required'     => 'حقل المادة اجباري',

            'marks'                => 'حقل الدرجة اجباري'
        ]);

        Result::create($request->only('student_id', 'exam_id', 'marks', 'year', 'type_result'));
        session()->flash('Add', 'تم اضافة درجة النتيجة  بنجاح');
        return back();
    }


    public function showStudentResult(Request $request) {
        $student_id       = $request->student_id;
        $student_name     = Student::where('id', $student_id)->first();
        $student_results  = Result::where('student_id', $student_id)->get();
        // return $student_name;
        return view('admin.content.results.show_result_by_student', compact('student_results', 'student_name'));
    }

    public function showAllResult(Request $request) {
       $allResult = Result::where('type_result', $request->type_result)->where('year',$request->year)->get();
       return view('admin.content.results.show_all_result', compact('allResult'));
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