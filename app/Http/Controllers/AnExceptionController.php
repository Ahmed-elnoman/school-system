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
        $request->validate([
            'type_an_exception'            => ['required', 'string'],
            'description_an_exception'     => ['required'],
            'discount_rate'                => ['required']
        ],[
            'type_an_exception.required'   => __('حقل النوع الاستثناء اجباري'),
            'type_an_exception.string'     => __('حقل النوع الاستثناء يجب ان يكون نص'),

            'description_an_exception.required'     => __('حقل الوصف الاستثناء اجباري'),

            'discount_rate.required'                => __('حقل نسبة الخصم اجباري'),
        ]);

        AnException::create([
            'type'                         => $request->type_an_exception,
            'description'                  => $request->description_an_exception,
            'discount_rate'                => $request->discount_rate
        ]);
        session()->flash('Add', 'تم اضافة حالة الاستثناء بنجاح');
        return back();
    }


    public function update(Request $request) {
        // return $request;
        $request->validate([
            'type'            => ['required', 'string'],
            'description_an_exception'     => ['required'],
            'discount_rate'                => ['required']
        ],[
            'type_an_exception.required'   => __('حقل النوع الاستثناء اجباري'),
            'type_an_exception.string'     => __('حقل النوع الاستثناء يجب ان يكون نص'),

            'description_an_exception.required'     => __('حقل الوصف الاستثناء اجباري'),

            'discount_rate.required'                => __('حقل نسبة الخصم اجباري'),
        ]);

        $id = $request->id;

        AnException::where('id' , $id)->update([
            'type'                         => $request->type,
            'description'                  => $request->description_an_exception,
            'discount_rate'                => $request->discount_rate
        ]);
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
