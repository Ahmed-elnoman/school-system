<?php

namespace App\Http\Controllers;

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
        return view('admin.content.chargeFors.index', compact('chargeFors','classRoom'));
    }

    public function store(Request $request) {
        // return $request;
        ChargeFor::create([
            'price'          => $request->charge_price,
            'classRoom_id'   => $request->charge_level
        ]);
        session()->flash('Add', 'تم اضافة بنجاح');
        return back();
    }

    public function update(Request $request) {
        return $request;
        $id   = $request->id;
        ChargeFor::where('id', $id)->update([
            'price'   => $request->charge_price,
            'classRoom_id'   => $request->charge_level
        ]);
        session()->flash('edit', 'تم تعديل بنجاح');
        return back();
    }
}
