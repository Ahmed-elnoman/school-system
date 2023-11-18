<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Freeze;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $teachers    = Teacher::all();
        $departments = Department::all();

        return view('admin.content.teachers.index', compact('teachers', 'departments'));
    }

    public function store(Request $request) {
        if($request->file('file')){
            $file = $request->file('file');
            $fileName = $file->hashName();

            $location = 'Image/Teacher';

            $file->move($location , $fileName);

            $filePath = url('Image/Teacher/', $fileName);

            Teacher::create([
                'full_name' => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make('123123'),
                'image'     => $filePath,
                'gender'    => $request->gender,
                'address'   => $request->address,
                'phone'     => $request->phone,
                'department_id'  => $request->department,
                'salary'         => $request->salary,
                'join_date'      => $request->join_date
            ]);
            session()->flash('Add', 'تم اضافة بنجاح');
            return back();
        }
    }

    public function update(Request $request) {

        $id  = $request->id;

        if($request->file('file')) {
            $file  = $request->file('file');
            $fName = $file->hashName();

            $location = 'Image/Teacher';

            $file->move($location , $fName);

            $filePath = url('Image/Teacher/', $fName);

            Teacher::where('id', $id)->update([
                'full_name'       => $request->name,
                'email'           => $request->email,
                'password'        => Hash::make('123123'),
                'image'           => $filePath,
                'gender'          => $request->gender,
                'address'         => $request->address,
                'phone'           => $request->phone,
                'department_id'   => $request->department,
                'salary'          => $request->salary,
                'join_date'       => $request->join_date
            ]);
        }else {
            session()->flash('error', 'يرج اضافة صورة');
            return back();
        }

    }

    public function teacherDepart() {
        $departments = Department::all();
        return view('admin.content.teachers.department', compact('departments'));
    }

    public function freeze(Request $request)  {
        $id      = $request->id;
        $teacher = Teacher::find($id);

        Freeze::create([
            'freeze_reason' => $request->freeze_reason,
            'date'          => $request->date,
            'teacher_id'    => $teacher->id
        ]);

        session()->flash('freeze', 'تم التجميد المعلم بنجاح');
        return back();
    }

    public function getFreezes() {
        $freezes = Freeze::all();

        return view('admin.content.teachers.freeze', compact('freezes'));
    }

    public function deleteFreeze(Request $request) {
        $id   = $request->id;

        Freeze::destroy($id);
        session()->flash('delete', 'تم عملية الحذف  بنجاح');
        return back();
    }

    public function softDelete(Request $request) {
        $id   = $request->id;

        Teacher::destroy($id);
        session()->flash('delete', 'تم عملية الفصل  بنجاح');
        return back();
    }

    public function getTrashed() {
        $teacherTrashed = Teacher::onlyTrashed()->get();
        return view('admin.content.teachers.trashed', compact('teacherTrashed'));
    }

    public function withTrashed(Request $request) {
        $id   = $request->id;

        Teacher::withTrashed()->where('id', $id)->restore();
        session()->flash('restore', 'تم عملية الراجع المعلم  بنجاح');
        return back();
    }

    public function delete(Request $request) {
        $id  = $request->id;

        Teacher::withTrashed()->where('id', $id)->forceDelete();
        session()->flash('delete', 'تم عملية الحذف  بنجاح');
        return back();

    }
}
