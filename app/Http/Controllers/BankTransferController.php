<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\BankTransfer;
use DB;

class BankTransferController extends Controller
{
    public function index()
    {
        $meta_title   = "Bank Transfer Settings";
        $bankTransfer = DB::table('bank_transfer_settings')->first();
        $adminInfo    = DB::table('admins')->first();

        if(is_null($bankTransfer)):
            abort(403, 'Bank Transfer settings not found!');
        endif;

        return view('admin.pages.payments.bank-transfer', compact('meta_title', 'bankTransfer', 'adminInfo'));
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_name'   => ['required'],
            'account_number' => ['required'],
            'bank_name'      => ['required'],
            'sort_code'      => ['nullable'],
            'iban'           => ['required'],
            'bic_swift'      => ['required'],
            'message'        => ['nullable'],
        ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $bankTransferSettings = BankTransfer::first();

        if(is_null($bankTransferSettings)):
            abort(403, 'Bank Transfer settings not found!');
        endif;

        $bankTransferSettings->fill($request->all());
        $bankTransferSettings->save();

        return redirect()->back()->with('message', 'The Bank Transfer Settings has been updated successfully!');
    }
}
