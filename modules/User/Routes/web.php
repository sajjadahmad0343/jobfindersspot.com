<?php

use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Route;
Auth::routes(['verify' => true]);

Route::get('user/profile','UserController@profile')->name("user.profile.index")->middleware(['auth','verified']);
Route::post('user/profile','UserController@profileUpdate')->name("user.profile.update")->middleware(['auth','verified']);

Route::group(['prefix'=>'user','middleware' => ['auth','verified','complete_profile']],function(){
    Route::post('/reloadChart','UserController@reloadChart');
  
    Route::get('/profile/change-password','PasswordController@changePassword')->name("user.change_password");
    Route::post('/profile/change-password','PasswordController@changePasswordUpdate')->name("user.change_password.update");
    Route::get('/booking-history','UserController@bookingHistory')->name("user.booking_history");
    Route::get('/enquiry-report','UserController@enquiryReport')->name("vendor.enquiry_report");
    Route::get('/enquiry-report/bulkEdit/{id}','UserController@enquiryReportBulkEdit')->name("vendor.enquiry_report.bulk_edit");

    Route::post('/wishlist','UserWishListController@handleWishList')->name("user.wishList.handle");
    Route::get('/bookmark','UserWishListController@index')->name("user.wishList.index");
    Route::post('/wishlist/remove','UserWishListController@remove')->name("user.wishList.remove");

    Route::get('/following-employers','UserWishListController@followingEmployers')->name("user.following.employers");

//    Route::group(['prefix'=>'verification'],function(){
//        Route::match(['get'],'/','VerificationController@index')->name("user.verification.index");
//        Route::match(['get'],'/update','VerificationController@update')->name("user.verification.update");
//        Route::post('/store','VerificationController@store')->name("user.verification.store");
//        Route::post('/send-code-verify-phone','VerificationController@sendCodeVerifyPhone')->name("user.verification.phone.sendCode");
//        Route::post('/verify-phone','VerificationController@verifyPhone')->name("user.verification.phone.field");
//    });

    Route::group(['prefix'=>'/booking'],function(){
        Route::get('{code}/invoice','BookingController@bookingInvoice')->name('user.booking.invoice');
        Route::get('{code}/ticket','BookingController@ticket')->name('user.booking.ticket');
    });

    Route::match(['get'],'/upgrade-vendor','UserController@upgradeVendor')->name("user.upgrade_vendor");

    Route::get('wallet','WalletController@wallet')->name('user.wallet');
    Route::get('wallet/buy','WalletController@buy')->name('user.wallet.buy');
    Route::post('wallet/buyProcess','WalletController@buyProcess')->name('user.wallet.buyProcess');

    Route::get('chat','ChatController@index')->name('user.chat');
});

Route::group(['prefix'=>config('chatify.path'),'middleware'=>['auth', 'verified', 'complete_profile']],function(){
    Route::get('/', 'ChatController@iframe')->name(config('chatify.path'));
    Route::post('search','ChatController@search')->name('search');
    Route::post('getContacts', 'ChatController@getContacts')->name('contacts.get');
    Route::post('idInfo', 'ChatController@idFetchData');
});

Route::group(['prefix'=>'profile'],function(){
    Route::match(['get'],'/{id}','ProfileController@profile')->name("user.profile");
    Route::match(['get'],'/{id}/reviews','ProfileController@allReviews')->name("user.profile.reviews");
    Route::match(['get'],'/{id}/services','ProfileController@allServices')->name("user.profile.services");
});

//Newsletter
Route::post('newsletter/subscribe','UserController@subscribe')->name('newsletter.subscribe');


Route::get('/user/my-plan','PlanController@myPlan')->name('user.plan')->middleware(['auth', 'verified', 'complete_profile']);
Route::get('/plan','PlanController@index')->name('plan');
Route::get('/user/plan/buy/{id}','PlanController@buy')->name('user.plan.buy')->middleware(['auth', 'verified', 'complete_profile']);


//Contact
Route::group(['middleware'=>['auth', 'verified','complete_profile']],function() {
    Route::get('/user/my-contact', 'ContactController@myContact')->name("user.my-contact");
});
