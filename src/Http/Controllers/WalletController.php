<?php

namespace Shultz\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    public function walletrecharge (  ) {

        return view('rupeebiz-ccavenue::recharge');    }
}
