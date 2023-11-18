<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $accounts = Account::all();

        return view('admin.content.accounts.index', compact('accounts'));
    }

    public function store(Request $request) {
        // validation
        $request->validate([
            'name'        => 'required',
            'price'       => 'required',
            'description' => 'required'
        ]);

        Account::create([
            'name'          => $request->name,
            'price'         => $request->price,
            'description'   => $request->description
        ]);
        session()->flash('Add', 'تم اضافة بنجاح');
        return back();
    }

    public function update(Request $request) {

        $id = $request->id;
        Account::where('id' , $id)->update([
            'name'           => $request->name,
            'description'    => $request->description,
            'price'          => $request->price
        ]);
        session()->flash('edit', 'تم تعديل بنجاح');
        return back();
    }

    public function delete(Request $request) {
        $id  = $request->id;

        Account::destroy($id);
        session()->flash('delete', 'تم الحذف بنجاح');
        return back();
    }

    public function print($id) {
        $account = Account::find($id);

        return view('admin.content.accounts.print_account', compact('account'));
    }
}
