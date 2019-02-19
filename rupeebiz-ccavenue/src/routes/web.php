<?php
$namespace  = 'Shultz\Http\Controllers';
Route::group([
  'namespace' => $namespace,
], function()
{
    Route::get('/walletrecharge', 'WalletController@walletrecharge');
});