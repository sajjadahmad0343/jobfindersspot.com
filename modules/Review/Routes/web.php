<?php
use Illuminate\Support\Facades\Route;

//Review
Route::group(['middleware' => ['auth', 'verified']],function(){
    Route::get('/review',function (){ return redirect('/'); });
    Route::post('/review','ReviewController@addReview')->name('review.store');
});
