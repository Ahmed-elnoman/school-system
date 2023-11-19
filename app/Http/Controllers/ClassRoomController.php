<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        $classes = ClassRoom::all();

        return view('admin.content.classes.index', compact('classes'));
    }

    public function store(Request $request) {
        ClassRoom::create([
            'name'           => $request->class_name,
            'student_count'  => $request->student_count,
            'level'          => $request->class_level
        ]);
        session()->flash('Add', 'تم اضافة بنجاح');
        return back();
    }

    public function update(Request $request) {
        $id  = $request->id;

        ClassRoom::where('id', $id)->update([
            'name'   => $request->class_name,
            'level'  => $request->class_level
        ]);
        session()->flash('edit', 'تم التعديل بنجاح');
        return back();
    }
}
