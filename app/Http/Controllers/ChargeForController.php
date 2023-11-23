<?php

namespace App\Http\Controllers;

use App\Models\AnException;
use App\Models\ChargeFor;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ChargeForController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $chargeFors = ChargeFor::all();
        $classRoom  = ClassRoom::all();
        $an_exceptions = AnException::all();
        return view('admin.content.chargeFors.index', compact('chargeFors','classRoom', 'an_exceptions'));
    }

    public function store(Request $request) {
        // return $request;
        ChargeFor::create([
            'total_fees'          => $request->total_fees,
            'first_payment'       => $request->first_payment,
            'second_payment'      => $request->second_payment,
            'classRoom_id'        => $request->charge_level
        ]);
        session()->flash('Add', 'تم اضافة بنجاح');
        return back();
    }

    public function update(Request $request) {
        $id   = $request->id;
        ChargeFor::where('id', $id)->update([
            'classRoom_id'     => $request->charge_level,
            'total_fees'       => $request->total_fees,
            'first_payment'    => $request->first_payment,
            'second_payment'   => $request->second_payment
        ]);
        session()->flash('edit', 'تم تعديل بنجاح');
        return back();
    }
}
