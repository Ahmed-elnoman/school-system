<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $departments = Department::all();

        return view('admin.content.departments.index', compact('departments'));
    }

    public function store(Request $request) {
        // validator
       $data =  $request->validate([
        'name'  => 'required|string',
       ],[
        'name.required'  => 'حقل اسم القسم اجباري',
        'name.string'    => 'حقل يجب ان يكون من نوع نص'
       ]);

        Department::create($data);
        session()->flash('Add', 'تم اضافة بنجاح');
        return back();

    }

    public function update(Request $request){
        $id = $request->id;
        Department::where('id', $id)->update($request->only('name'));
        session()->flash('edit', 'تم التعديل بنجاح');
        return back();
    }

    public function delete(Request $request){
        $id = $request->id;
        Department::destroy($id);
        session()->flash('delete', 'تم الحذف بنجاح');
        return back();
    }
}