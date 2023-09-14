<?php
use Illuminate\Support\Facades\Route;
Route::group(['middleware'=>['verified', 'complete_profile']],function() {
    //Contact
    Route::get('/contact','ContactController@index')->name("contact.index");
    Route::post('/contact/store','ContactController@store')->name("contact.store");

});