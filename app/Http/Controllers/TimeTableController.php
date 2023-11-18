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

    public function store(Request $request) {
        TimeTable::create([
            'day'          => $request->date,
            'time'         => $request->time,
            'subject_id'   => $request->subject_name,
            'classRoom_id' => $request->class_room_name,
            'teacher_id'   => $request->teacher_name
        ]);
        session()->flash('Add', 'تم اضافة بنجاح');
        return back();
    }
}
