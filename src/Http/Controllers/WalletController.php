<?php

namespace Shultz\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    public function mobilerecharge ( Request $request ) {
        $user = Auth::user();
        $rechargeamount = $request->input('amount');
        $tel            = $request->input('tel');
        $operator       = $request->input('oprator');
        $fromwallet     = $request->input('fromwallet');
        $encrypted_data = Wallet::recharge_mobile($user, $rechargeamount, 'INR', $tel, $operator, $fromwallet);
        $access_code    = 'AVOQ72EH49BC73QOCB';

        return view('ccavredirectform', compact('encrypted_data', 'access_code'));

    }

    public function walletrecharge ( Request $request ) {
        $user           = Auth::user();
        $amount         = $request->input('amount');
        $encrypted_data = Wallet::recharge_wallet($user, 'INR', $amount);
        $access_code    = 'AVOQ72EH49BC73QOCB';

        return view('ccavredirectform', compact('encrypted_data', 'access_code'));

    }

    public function mobilerechargemiddle ( Request $request ) {
        $prepaidprovider = $request->input('oprator');
        $type            = $request->input('type');
        $operatorname    = Opcode::where('opcode', $request->input('oprator'))->first()->name;
        $prepaidamount   = $request->input('amount');
        $tel             = $request->input('tel');
        $fromwallet      = $request->input('fromwallet');

        return view('forms.rechargemobileform', compact('prepaidprovider', 'prepaidamount', 'tel', 'fromwallet', 'operatorname', 'type'));
    }
}

