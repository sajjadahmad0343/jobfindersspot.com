<?php
use Illuminate\Support\Facades\Route;
Route::group(['middleware'=>'verified', 'complete_profile'],function() {
    Route::group(['prefix'=>config('companies.companies_route_prefix')],function(){
        Route::get('/'.config('companies.companies_category_route_prefix').'/{slug}', 'CompanyController@index')->name('companies.category.index');
        Route::get('/','CompanyController@index')->name('companies.index');// Companies Page
        Route::get('/{slug}','CompanyController@detail')->name('companies.detail');// Companies Detail

        Route::post('/contact/store','CompanyController@storeContact')->name("company.contact.store");
    });
    Route::group(['middleware'=>['auth', 'verified']],function() {
        Route::get('/user/company/profile', 'ManageCompanyController@companyProfile')->name("user.company.profile");
        Route::post('/user/company/update', 'ManageCompanyController@companyUpdate')->name("user.company.update");
    });
});
