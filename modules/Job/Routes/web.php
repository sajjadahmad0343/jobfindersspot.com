<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>config('job.job_route_prefix')],function(){
    Route::get('/','JobController@index')->name('job.search');
    Route::get('/{slug}','JobController@detail');

    Route::post('/apply-job', 'JobController@applyJob')->name('job.apply-job');
    Route::get('/'.config('job.job_category_route_prefix').'/{slug}', 'JobController@categoryIndex')->name('job.category.index');
    Route::get('/'.config('job.job_location_route_prefix').'/{slug}', 'JobController@locationIndex')->name('job.location.index');
    Route::get('/{cat_slug}/{location_slug}', 'JobController@categoryLocationIndex')->name('job.category.location.index');
});

Route::group(['prefix'=> 'user', 'middleware'=>'auth'],function() {
    Route::get('/manage-jobs', 'ManageJobController@manageJobs')->name('user.manage.jobs');
    Route::get('/new-job', 'ManageJobController@createJob')->name('user.create.job');
    Route::get('/edit-job/{id}', 'ManageJobController@editJob')->name('user.edit.job');
    Route::post('/store-job/{id}', 'ManageJobController@storeJob')->name('user.store.job');
    Route::get('/delete-job/{id}', 'ManageJobController@deleteJob')->name('user.delete.job');
});

Route::group(['prefix'=> 'user', 'middleware'=>'auth'],function(){
    Route::get('/applicants', 'ManageJobController@applicants')->name('user.applicants');
    Route::get('/applicants/create','ManageJobController@applicantsCreate')->name('user.applicants.create');
    Route::post('/applicants/store','ManageJobController@applicantsStore')->name('user.applicants.store');
    Route::get('/applicants/{status}/{id}','ManageJobController@applicantsChangeStatus')->name('user.applicants.changeStatus');
    Route::get('/applicants/delete/{id}','ManageJobController@applicantsDelete')->name('user.applicants.delete');
    Route::get('/applicants/export','ManageJobController@applicantsExport')->name('user.applicants.export');

});
