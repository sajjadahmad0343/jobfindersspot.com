<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=> ['auth', 'verified', 'complete_profile']],function() {
    Route::get('user/payout/', 'PayoutController@candidateIndex')->name('payout.candidate.index');
    Route::post('payout/account/store', 'PayoutController@storePayoutAccount')->name('payout.candidate.account.store');
});
