<?php
$namespace  = 'Shultzer\RupeebizCcavenue\Controller';
Route::group([
  'namespace' => $namespace,
], function()
{
    Route::middleware('auth')->group(function()
    {
        Route::get('/myprofile', 'userController@myprofile');
        Route::get('/myhistory', 'userController@myhistory');
        Route::get('/auto-recharge', 'userController@autoRecharge');
        Route::post('/auto-recharge-store', 'userController@autoRechargeStore');
        Route::get('/show-pre-recharge', 'userController@showPreAutoRecharge');
        Route::get('/myprofile/wallet', 'userController@wallet');
        Route::post('/walletrecharge', 'HomeController@walletrecharge');
        Route::post('/mobilerecharge', 'HomeController@mobilerecharge');
        Route::post('/mobilerechargemiddle', 'HomeController@mobilerechargemiddle');

    });
    Route::post('/walletrechargeresponse', '\App\Classes\Wallet@gateway_Response_Handler_wallet');
    Route::post('/mobilerechargeresponse', '\App\Classes\Wallet@gateway_Response_Handler_mobile');
});