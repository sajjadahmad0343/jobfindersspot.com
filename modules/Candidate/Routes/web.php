<?php
use Illuminate\Support\Facades\Route;
Route::group(['middleware'=>['verified','complete_profile']],function() {
    Route::group(['prefix'=>config('candidate.candidate_route_prefix')],function(){
        Route::get('/'.config('candidate.candidate_category_route_prefix').'/{slug}', 'CategoryController@index')->name('candidate.category.index');
        Route::get('/','CandidateController@index')->name('candidate.index');// Candidates Page
        Route::get('/{slug}','CandidateController@detail')->name('candidate.detail');// Detail
        Route::post('/contact/store','CandidateController@storeContact')->name("candidate.contact.store");
    });

    //Route::get('category/{slug}','CategoryController@index')->name('category.index');// Detail
    Route::group(['middleware' => ['auth','verified','complete_profile']],function() {
        Route::get('/user/applied-jobs', 'ManageCandidateController@appliedJobs')->name('user.applied_jobs');
        Route::get('/user/my-applied/delete/{id}','ManageCandidateController@deleteJobApplied')->name('user.myApplied.delete');
    });
});

