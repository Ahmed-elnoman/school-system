<?php

namespace App\Http\Controllers;

use App\Models\AnException;
use Illuminate\Http\Request;

class AnExceptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {
      $data = $request->validate([
            'type'            => ['required', 'string'],
            'description'     => ['required'],
            'discount_rate'                => ['required']
        ],[
            'type.required'   => __('حقل النوع الاستثناء اجباري'),
            'type.string'     => __('حقل النوع الاستثناء يجب ان يكون نص'),

            'description.required'     => __('حقل الوصف الاستثناء اجباري'),

            'discount_rate.required'                => __('حقل نسبة الخصم اجباري'),
        ]);

        AnException::create($data);
        session()->flash('Add', 'تم اضافة حالة الاستثناء بنجاح');
        return back();
    }


    public function update(Request $request) {
        // return $request;
       $data = $request->validate([
            'type'            => ['required', 'string'],
            'description'     => ['required'],
            'discount_rate'                => ['required']
        ],[
            'type.required'   => __('حقل النوع الاستثناء اجباري'),
            'type.string'     => __('حقل النوع الاستثناء يجب ان يكون نص'),

            'description.required'     => __('حقل الوصف الاستثناء اجباري'),

            'discount_rate.required'                => __('حقل نسبة الخصم اجباري'),
        ]);

        $id = $request->id;
        AnException::where('id' , $id)->update($data);
        session()->flash('edit', 'تم تعديل حالة الاستثناء بنجاح');
        return back();
    }


    public function delete(Request $request) {

        $id =  $request->id;

        AnException::destroy($id);
        session()->flash('delete', 'تم علمية حذف الاستثناء');
        return back();
    }
}
