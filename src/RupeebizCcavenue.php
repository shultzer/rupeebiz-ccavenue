<?php

namespace Shultzer\RupeebizCcavenue;
use GuzzleHttp\Client;

class RupeebizCcavenue
{
    public static function recharge_mobile ( $user, $rechargeamount, $currency, $tel, $operator, $fromwallet ) {
        $user_wallet = $user->wallet;
        $order_id    = 'ZAP_' . time();
        if ( (bool) $fromwallet ) {
            if ( $rechargeamount > $user_wallet ) {
                //store recharge transaction
                self::store_recharge_transaction($user, $operator, $order_id, $currency, $rechargeamount, $tel);
                $amount_for_gateway = $rechargeamount - $user_wallet;
                $transaction        = new Transaction([
                  'order_id' => $order_id,
                  'currency' => $currency,
                  'amount'   => $amount_for_gateway,
                ]);
                $user->transactions()->save($transaction);
                //redirect to gateway with difference
                $merchant_data = static::make_merchant_data($user, $order_id, $amount_for_gateway, config('wallet.mobile_redirecturl'), config('wallet.cancel_redirecturl'), $tel, $rechargeamount, $operator);

                return self::redirect_to_gateway($merchant_data);

            }
            else {
                session()->flash('opcode', $operator);
                // store info about transaction
                self::store_recharge_transaction($user, $operator, $order_id, $currency, $rechargeamount, $tel);
                //call api with amount

                $response = self::call_api_recharge($tel, $operator, $rechargeamount, $order_id, '', $operator);
                // if recharge mobile is successful - reduce wallet amount
                //dd($response);
                self::check_response_status($response, $user, $rechargeamount);
            }
        }
        else {
            //redirect to gateway
            $amount_for_gateway = $rechargeamount - $user_wallet;
            $transaction        = new Transaction([
              'order_id' => $order_id,
              'currency' => $currency,
              'amount'   => $amount_for_gateway,
            ]);
            $user->transactions()->save($transaction);
            $merchant_data = static::make_merchant_data($user, $order_id, $rechargeamount, config('wallet.mobile_redirecturl'), config('wallet.cancel_redirecturl'), $tel, $rechargeamount, $operator);

            return self::redirect_to_gateway($merchant_data);

        }
    }

    public static function store_recharge_transaction ( $user, $operator, $order_id, $currency, $rechargeamount, $tel ) {
        $operators = self::getoperators();
        foreach ( $operators as $key => $item ) {
            if ( is_integer(array_search($operator, $item)) ) {
                $opslug = $key;
            }
        }
        switch ( $opslug ) {
            case'bankingop':
                $mobiletransaction = new Bankingtransaction([
                  'order_id' => $order_id,
                  'currency' => $currency,
                  'amount'   => $rechargeamount,
                  'mn'       => $tel,
                ]);
                break;

            case'broadband':
                $mobiletransaction = new Broadbandtransaction([
                  'order_id' => $order_id,
                  'currency' => $currency,
                  'amount'   => $rechargeamount,
                  'mn'       => $tel,
                ]);
                break;

            case'datacard':
                $mobiletransaction = new Datacardtransaction([
                  'order_id' => $order_id,
                  'currency' => $currency,
                  'amount'   => $rechargeamount,
                  'mn'       => $tel,
                ]);
                break;

            case'dthconn':
                $mobiletransaction = new Dthconntransaction([
                  'order_id' => $order_id,
                  'currency' => $currency,
                  'amount'   => $rechargeamount,
                  'mn'       => $tel,
                ]);
                break;

            case'electricity':
                $mobiletransaction = new Electricitytransaction([
                  'order_id' => $order_id,
                  'currency' => $currency,
                  'amount'   => $rechargeamount,
                  'mn'       => $tel,
                ]);
                break;

            case'gas':
                $mobiletransaction = new Gastransaction([
                  'order_id' => $order_id,
                  'currency' => $currency,
                  'amount'   => $rechargeamount,
                  'mn'       => $tel,
                ]);
                break;

            case'insurance':
                $mobiletransaction = new Insurancetransaction([
                  'order_id' => $order_id,
                  'currency' => $currency,
                  'amount'   => $rechargeamount,
                  'mn'       => $tel,
                ]);
                break;

            case'landline':
                $mobiletransaction = new Landlinetransaction([
                  'order_id' => $order_id,
                  'currency' => $currency,
                  'amount'   => $rechargeamount,
                  'mn'       => $tel,
                ]);
                break;

            case'dth':
                $mobiletransaction = new Dthtransaction([
                  'order_id' => $order_id,
                  'currency' => $currency,
                  'amount'   => $rechargeamount,
                  'mn'       => $tel,
                ]);
                break;

            case'postpaid':
                $mobiletransaction = new Postpaidtransaction([
                  'order_id' => $order_id,
                  'currency' => $currency,
                  'amount'   => $rechargeamount,
                  'mn'       => $tel,
                ]);
                break;

            case'prepaid':
                $mobiletransaction = new Mobiletransaction([
                  'order_id' => $order_id,
                  'currency' => $currency,
                  'amount'   => $rechargeamount,
                  'mn'       => $tel,
                ]);
                break;

            case'waterbill':
                $mobiletransaction = new Watertransaction([
                  'order_id' => $order_id,
                  'currency' => $currency,
                  'amount'   => $rechargeamount,
                  'mn'       => $tel,
                ]);
                break;

        }
        $user->mobiletransactions()->save($mobiletransaction);

        return $mobiletransaction;
    }

    public static function getoperators () {
        $key = 'opcode';

        return [
          'bankingop'   => Bankingoperator::pluck($key)->toarray(),
          'broadband'   => Broadbandoperator::pluck($key)->toarray(),
          'datacard'    => Datacardoperator::pluck($key)->toarray(),
          'dthconn'     => Dthconnectionoperator::pluck($key)->toarray(),
          'electricity' => Electricityoperator::pluck($key)->toarray(),
          'gas'         => Gasoperator::pluck($key)->toarray(),
          'insurance'   => Insuranceoperator::pluck($key)->toarray(),
          'landline'    => Landlineoperator::pluck($key)->toarray(),
          'dth'         => Operator::pluck($key)->toarray(),
          'postpaid'    => Postpaidoperator::pluck($key)->toarray(),
          'prepaid'     => Prepaidoperator::pluck($key)->toarray(),
          'waterbill'   => Waterbilloperator::pluck($key)->toarray(),
        ];
    }

    protected static function make_merchant_data ( $user, $order_id, $amount_for_gateway, $redirect_url, $cancel_url, $number_for_recharge = '', $total_amount = '', $opcode = '' ) {
        //dd($user,$amount_for_gateway,$redirect_url);
        //TODO: pass merchant parqams
        return 'billing_name=' . $user->name . '&billing_address=' . $user->address . '&billing_city=' . $user->city . '&billing_state=' . $user->state . '&billing_zip=' . $user->zip_code . '&billing_country=' . $user->country . '&billing_tel=' . $user->mobile . '&billing_email=' . $user->email . '&merchant_id=112068&order_id=' . $order_id . '&currency=INR&redirect_url=' . $redirect_url . '&cancel_url=' . $cancel_url . '&language=EN&amount=' . $amount_for_gateway . '&merchant_param1=' . $total_amount . '&merchant_param2=' . $number_for_recharge . '&merchant_param3=' . $opcode;

    }

    private static function redirect_to_gateway ( $merchant_data ) {

        $encrypted_data = self::encrypt($merchant_data, config('wallet.working_key')); // Method for encrypting the data.

        return $encrypted_data;
    }

    protected static function encrypt ( $plainText, $key ) {
        $secretKey  = self::hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode   = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
        $blockSize  = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
        $plainPad   = self::pkcs5_pad($plainText, $blockSize);
        if ( mcrypt_generic_init($openMode, $secretKey, $initVector) != -1 ) {
            $encryptedText = mcrypt_generic($openMode, $plainPad);
            mcrypt_generic_deinit($openMode);

        }

        return bin2hex($encryptedText);
    }

    protected static function hextobin ( $hexString ) {
        $length    = strlen($hexString);
        $binString = "";
        $count     = 0;
        while ( $count < $length ) {
            $subString    = substr($hexString, $count, 2);
            $packedString = pack("H*", $subString);
            if ( $count == 0 ) {
                $binString = $packedString;
            }

            else {
                $binString .= $packedString;
            }

            $count += 2;
        }

        return $binString;
    }

    protected static function pkcs5_pad ( $plainText, $blockSize ) {
        $pad = $blockSize - ( strlen($plainText) % $blockSize );

        return $plainText . str_repeat(chr($pad), $pad);
    }

    protected static function call_api_recharge ( $tel, $operator, $amt, $reqid, $f1 = '', $f2 = '' ) {
        $client = new Client();
        $uri    = 'https://www.rupeebiz.com/apiservice.asmx/Recharge?apiToken=0cd96c2de62047c59e7d06e54c323257&mn=' . $tel . '&op=' . $operator . '&amt=' . $amt . '&reqid=' . $reqid . '&field1=' . $f1 . '&field2=' . $f2;
        $res    = $client->get($uri);
        $body   = simplexml_load_string($res->getBody());

        return $body;
    }

    protected static function check_response_status ( $response, $user, $rechargeamount ) {
        $operator = session('opcode');
        $status   = (string) $response->status;
        $remark   = (string) $response->remark;

        self::store_recharge_transaction_final($response, $status, $remark, $operator);

        session()->flash('status', $status . ' ' . $remark);
        $tourl = 'status=' . $status . ' ' . $remark;
        if ( $status == 'SUCCESS' ) {
            $amount       = $user->wallet;
            $user->wallet = $amount - $rechargeamount;
            $user->save();
            header('Location:http://www.zapwallet.in?' . $tourl);
            die;
        }
        elseif ( $status == 'FAILED' ) {

            header('Location:http://www.zapwallet.in?' . $tourl);
            die;

        }
        elseif ( $status == 'PENDING' ) {
            $amount       = $user->wallet;
            $user->wallet = $amount - $rechargeamount;
            $user->save();
            header('Location:http://www.zapwallet.in?' . $tourl);
            die;
        }
        elseif ( $status == 'REFUND' ) {
            header('Location:http://www.zapwallet.in?' . $tourl);
            die;
        }
        else {
            header('Location:http://www.zapwallet.in?' . $tourl);
            die;

        }
    }

    protected static function store_recharge_transaction_final ( $response, $status, $remark, $operator ) {
        $operators = self::getoperators();
        foreach ( $operators as $key => $item ) {
            if ( is_integer(array_search($operator, $item)) ) {
                $opslug = $key;
            }
        }
        switch ( $opslug ) {
            case'bankingop':
                $mobiletransaction         = Bankingtransaction::where('order_id', (string) $response->reqid)->first();
                $mobiletransaction->status = $status;
                $mobiletransaction->remark = $remark;
                $mobiletransaction->save();
                break;
            case'broadband':
                $mobiletransaction         = Broadbandtransaction::where('order_id', (string) $response->reqid)
                                                                 ->first();
                $mobiletransaction->status = $status;
                $mobiletransaction->remark = $remark;

                $mobiletransaction->save();

                break;
            case'datacard':
                $mobiletransaction         = Datacardtransaction::where('order_id', (string) $response->reqid)->first();
                $mobiletransaction->status = $status;
                $mobiletransaction->remark = $remark;

                $mobiletransaction->save();

                break;
            case'dthconn':
                $mobiletransaction         = Dthconntransaction::where('order_id', (string) $response->reqid)->first();
                $mobiletransaction->status = $status;
                $mobiletransaction->remark = $remark;

                $mobiletransaction->save();
                break;
            case'electricity':
                $mobiletransaction         = Electricitytransaction::where('order_id', (string) $response->reqid)
                                                                   ->first();
                $mobiletransaction->status = $status;
                $mobiletransaction->remark = $remark;

                $mobiletransaction->save();
                break;
            case'gas':
                $mobiletransaction         = Gastransaction::where('order_id', (string) $response->reqid)->first();
                $mobiletransaction->status = $status;
                $mobiletransaction->remark = $remark;

                $mobiletransaction->save();

                break;
            case'insurance':
                $mobiletransaction         = Insurancetransaction::where('order_id', (string) $response->reqid)
                                                                 ->first();
                $mobiletransaction->status = $status;
                $mobiletransaction->remark = $remark;

                $mobiletransaction->save();
                break;
            case'landline':
                $mobiletransaction         = Landlinetransaction::where('order_id', (string) $response->reqid)->first();
                $mobiletransaction->status = $status;
                $mobiletransaction->remark = $remark;

                $mobiletransaction->save();

                break;
            case'dth':
                $mobiletransaction         = Dthtransaction::where('order_id', (string) $response->reqid)->first();
                $mobiletransaction->status = $status;
                $mobiletransaction->remark = $remark;

                $mobiletransaction->save();

                break;
            case'postpaid':
                $mobiletransaction         = Postpaidtransaction::where('order_id', (string) $response->reqid)->first();
                $mobiletransaction->status = $status;
                $mobiletransaction->remark = $remark;

                $mobiletransaction->save();
                break;
            case'prepaid':
                $mobiletransaction         = Mobiletransaction::where('order_id', (string) $response->reqid)->first();
                $mobiletransaction->status = $status;
                $mobiletransaction->remark = $remark;

                $mobiletransaction->save();

                break;
            case'waterbill':
                $mobiletransaction         = Watertransaction::where('order_id', (string) $response->reqid)->first();
                $mobiletransaction->status = $status;
                $mobiletransaction->remark = $remark;

                $mobiletransaction->save();

                break;

        }

        return $mobiletransaction;
    }

    public static function recharge_wallet ( $user, $currency, $amount, $redirecturl = 'http://zapwallet.in/walletrechargeresponse' ) {
        $order_id      = 'ZAP_' . time();
        $merchant_data = self::make_merchant_data($user, $order_id, $amount, $redirecturl, config('wallet.cancel_redirecturl'));
        $transaction   = new Transaction([
          'order_id' => $order_id,
          'currency' => $currency,
          'amount'   => $amount,
        ]);
        $user->transactions()->save($transaction);

        return static::redirect_to_gateway($merchant_data);

    }

    public static function gateway_Response_Handler_wallet () {

        $workingKey    = 'C999793EEB3E6535C376302DF5928B87';    //Working Key should be provided here.
        $encResponse   = $_POST[ "encResp" ];      //This is the response sent by the CCAvenue Server
        $rcvdString    = self::decrypt($encResponse, $workingKey);    //Crypto Decryption used as per the specified working key.
        $decryptValues = explode('&', $rcvdString);

        $response_order_id = explode('=', $decryptValues[ 0 ])[ 1 ];
        $tracking_id       = explode('=', $decryptValues[ 1 ])[ 1 ];
        $bank_ref_no       = explode('=', $decryptValues[ 2 ])[ 1 ];
        $order_status      = explode('=', $decryptValues[ 3 ])[ 1 ];
        $failure_message   = explode('=', $decryptValues[ 4 ])[ 1 ];
        $payment_mode      = explode('=', $decryptValues[ 5 ])[ 1 ];
        $status_code       = explode('=', $decryptValues[ 7 ])[ 1 ];
        $status_message    = explode('=', $decryptValues[ 8 ])[ 1 ];
        $currency          = explode('=', $decryptValues[ 9 ])[ 1 ];
        $addtoamount       = (int) explode('=', $decryptValues[ 10 ])[ 1 ];
        $response_code     = explode('=', $decryptValues[ 38 ])[ 1 ];

        if ( $order_status === "Success" ) {
            $transaction                 = Transaction::where('order_id', $response_order_id)->first();
            $user                        = $transaction->user;
            $amount                      = (int) $user->wallet;
            $new_amount                  = $amount + $addtoamount;
            $bonus                       = self::zapbonus($new_amount);
            $new_amount                  = $bonus[ 'new_amount' ];
            $zupbucks                    = $bonus[ 'zapbucks' ];
            $user->wallet                = $new_amount;
            $user->zupbucks              = $zupbucks;
            $transaction->tracking_id    = $tracking_id;
            $transaction->tracking_id    = $tracking_id;
            $transaction->order_status   = $order_status;
            $transaction->bank_ref_no    = $bank_ref_no;
            $transaction->payment_mode   = $payment_mode;
            $transaction->status_code    = $status_code;
            $transaction->status_message = $status_message;
            $transaction->order_status   = $order_status;
            $transaction->currency       = $currency;
            $transaction->amount         = $addtoamount;
            $transaction->order_status   = $order_status;
            $transaction->response_code  = $response_code;
            $transaction->save();
            $user->save();

            return redirect()->to('/')->with('status', 'Successful charging wallet');
        }
        else if ( $order_status === "Aborted" ) {
            return redirect()->to('/')->with('status', 'Charge wallet Aborted');
        }
        else if ( $order_status === "Failure" ) {
            return redirect()->to('/')->with('status', 'Charge wallet Failure');
        }
        else {
            return redirect()->to('/')->with('status', 'Payment gateway security Error. Illegal access detected');
        }
    }

    protected static function decrypt ( $encryptedText, $key ) {
        $secretKey     = self::hextobin(md5($key));
        $initVector    = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = self::hextobin($encryptedText);
        $openMode      = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
        mcrypt_generic_init($openMode, $secretKey, $initVector);
        $decryptedText = mdecrypt_generic($openMode, $encryptedText);
        $decryptedText = rtrim($decryptedText, "\0");
        mcrypt_generic_deinit($openMode);

        return $decryptedText;

    }

    public static function zapbonus ( $new_amount ) {
        $bonus[ 'zapbucks' ] = round($new_amount / 1000, 0, PHP_ROUND_HALF_DOWN) * 5;
        if ( $bonus[ 'zapbucks' ] >= 1000 ) {
            $bonus[ 'new_amount' ] += 100;
            $bonus[ 'zapbucks' ]   = 0;
        }
        else {
            $bonus[ 'new_amount' ] = $new_amount;
        }

        return $bonus;
    }

    public static function gateway_Response_Handler_mobile () {

        $encResponse       = $_POST[ "encResp" ];      //This is the response sent by the CCAvenue Server
        $rcvdString        = self::decrypt($encResponse, config('wallet.working_key'));    //Crypto Decryption used as per the specified working key.
        $decryptValues     = explode('&', $rcvdString);
        $response_order_id = explode('=', $decryptValues[ 0 ])[ 1 ];
        $tracking_id       = explode('=', $decryptValues[ 1 ])[ 1 ];
        $bank_ref_no       = explode('=', $decryptValues[ 2 ])[ 1 ];
        $order_status      = explode('=', $decryptValues[ 3 ])[ 1 ];
        //$failure_message   = explode('=', $decryptValues[ 4 ])[ 1 ];
        $payment_mode   = explode('=', $decryptValues[ 5 ])[ 1 ];
        $status_code    = explode('=', $decryptValues[ 7 ])[ 1 ];
        $status_message = explode('=', $decryptValues[ 8 ])[ 1 ];
        $currency       = explode('=', $decryptValues[ 9 ])[ 1 ];
        $addtoamount    = (int) explode('=', $decryptValues[ 10 ])[ 1 ];
        $response_code  = explode('=', $decryptValues[ 38 ])[ 1 ];
        //merchantparams1
        $tel = explode('=', $decryptValues[ 27 ])[ 1 ];
        //merchantparams2
        $operator = explode('=', $decryptValues[ 28 ])[ 1 ];
        //merchantparams3
        $amt = explode('=', $decryptValues[ 26 ])[ 1 ];
        //merchantparams4
        $order_id = explode('=', $decryptValues[ 29 ])[ 1 ];
        //dd($decryptValues);
        if ( $order_status === "Success" ) {
            $transaction                 = Transaction::where('order_id', $response_order_id)->first();
            $user                        = $transaction->user;
            $amount                      = (int) $user->wallet;
            $new_amount                  = $amount + $addtoamount;
            $bonus                       = self::zapbonus($new_amount);
            $new_amount                  = $bonus[ 'new_amount' ];
            $zupbucks                    = $bonus[ 'zapbucks' ];
            $user->wallet                = $new_amount;
            $user->zapbucks              = $zupbucks;
            $transaction->tracking_id    = $tracking_id;
            $transaction->tracking_id    = $tracking_id;
            $transaction->order_status   = $order_status;
            $transaction->bank_ref_no    = $bank_ref_no;
            $transaction->payment_mode   = $payment_mode;
            $transaction->status_code    = $status_code;
            $transaction->status_message = $status_message;
            $transaction->order_status   = $order_status;
            $transaction->currency       = $currency;
            $transaction->amount         = $addtoamount;
            $transaction->order_status   = $order_status;
            $transaction->response_code  = $response_code;
            $transaction->save();
            $user->save();

            $response = self::call_api_recharge($tel, $operator, $amt, $response_order_id);
            self::check_response_status($response, $user, $amt);
        }
        else if ( $order_status === "Aborted" ) {
            return redirect()->to('/')->with('status', 'Charge wallet Aborted ' . $status_message);
        }
        else if ( $order_status === "Failure" ) {
            return redirect()->to('/')->with('status', 'Charge wallet Failure ' . $status_message);
        }
        else {
            return redirect()->to('/')->with('status', $status_message);
        }
    }
}
