<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TimeTable;
use Illuminate\Http\Request;
use SebastianBergmann\Template\Template;

class TimeTableController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $subjects    = Subject::all();
        $classRooms  = ClassRoom::all();
        $teachers    = Teacher::all();
        $times       = TimeTable::all();

        return view('admin.content.time_table.index',
        compact('subjects', 'classRooms', 'teachers', 'times'));
    }

    public function show(Request $request){
        $class_id    = $request->class_name;
        $classname   = ClassRoom::where('id', $class_id)->first('name');
        $timeTable = TimeTable::where('classRoom_id', $class_id)->get();

        $subjects    = Subject::all();
        $teachers    = Teacher::all();

        return view('admin.content.time_table.show_time_table', compact( 'classname','timeTable', 'subjects', 'teachers'));
    }

    public function store(Request $request) {
        $class_id = ClassRoom::where('name', $request->class_name)->first();

        TimeTable::create([
            'day'          => $request->date,
            'time'         => $request->time,
            'subject_id'   => $request->subject_name,
            'classRoom_id' => $class_id->id,
            'teacher_id'   => $request->teacher_name
        ]);
        session()->flash('Add', 'تم اضافة بنجاح');
        return back();
    }

    public function print($name){
        // this name is name of class name
        $class_id   = ClassRoom::where('name', $name)->first();

        $time_table = TimeTable::where('classRoom_id', $class_id->id)->get();
        return view('admin.content.time_table.print_time_table', compact('time_table', 'class_id'));
    }


}