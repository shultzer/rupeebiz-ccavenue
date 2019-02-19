<?php
$namespace  = 'Shultzer\RupeebizCcavenue\Controller';
Route::group([
  'namespace' => $namespace,
], function()
{
    Route::get('/walletrecharge', 'WalletController@walletrecharge');
});