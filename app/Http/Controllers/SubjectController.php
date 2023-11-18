<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $subjects = Subject::all();
        $levels   = ClassRoom::all();

        return view('admin.content.subjects.index', compact('subjects', 'levels'));
    }

    public function store(Request $request) {
        Subject::create([
            'name'   => $request->subject_name,
            'grade'  => $request->level
        ]);
        session()->flash('Add', 'تم اضافة المادة بنجاح');
        return back();
    }

    public function update(Request $request) {
        $id   = $request->id;

        Subject::where('id', $id)->update([
            'name'   => $request->subject_name,
            'grade'  => $request->subject_grade
        ]);
        session()->flash('edit', 'تم تعديل المادة بنجاح');
        return back();
    }
}
