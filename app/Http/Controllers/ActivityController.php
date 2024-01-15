<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index() {
        $activites = Activity::all();

        return view('admin.content.activity.index', compact('activites'));
    }

    public function store(Request $request) {
        if($request->file('file')){
            $file = $request->file('file');
            $fileName = $file->hashName();

            $location  = 'Image/Activity';

            $file->move($location , $fileName);

            $path = url('Image/Activity/', $fileName);
            Activity::create($request->only(['name', 'description', $path]));
            // Activity::create([
            //     'name'          => $request->activity_name,
            //     'description'   => $request->,
            //     'file'          => $path
            // ]);
            session()->flash('Add', 'تم اضافة بنجاح');
            return back();
        }
    }

    public function delete(Request $request) {
        $id = $request->id;
        Activity::destroy($id);
        session()->flash('delete', 'تم الحذف بنجاح');
        return back();
    }
}