<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// This endpoint does not need authentication.
Route::get('/public', function (Request $request) {
    return response()->json(['message' => 'Hello from a public endpoint!']);
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact administrator@udel.com'], 404);
});

Route::prefix('v1')->namespace('Api\v1')->group(function () {
    Route::middleware(['client'])->group(function() {
        Route::post('/create-account' , 'Auth\RegisterUserController@createUser');

        Route::post('/resend-confirmation-sms' , 'User\ResendTokenController@resendSMS');

        Route::post('/verify-user-account' , 'Auth\VerifyUserAccountController@verifyAccount');

        Route::post('/account/forgot-password' , 'Auth\ResetPasswordController@checkContact');

        Route::post('/account/reset-password' , 'Auth\ResetPasswordController@resetPassword');

        /*Route::prefix('system')->namespace('Admin\System')->group(function () {
            Route::resource('/category' , 'CategoryController');

            Route::resource('/size' , 'SizeController');
        });*/
    });

    Route::middleware(['auth:api' , 'verifiedUser'])->group(function() {
        Route::get('/getAuthenticatedUser' , 'User\UserProfileController@getAuthenticatedUser');

        Route::prefix('account')->namespace('User\Account')->group(function (){
            Route::patch('/{userId}' , 'AccountUpdateController@update');

            Route::delete('/{userId}' , 'AccountDeleteController@delete');

            Route::post('change-password' , 'ChangeUserPasswordController@changePassword');
        });

        Route::prefix('staff')->namespace('User\Staff')->group(function (){
           Route::post('/add' , 'AddStaffController@addStaff');
        });

        Route::resource('/roles' , 'User\Role\RoleController');

        /*Route::middleware(['userIDCardVerified'])->group(function() {
            Route::resource('request' , 'Request\RequestController');

            Route::get('user-request' , 'Request\RequestController@getUsersRequest');

            Route::post('change-request-status/{requestId}' , 'Request\RequestStatusController@changeStatus');

            Route::post('change-request-ratings/{requestId}' , 'Request\RequestRatingsController@changeRatings');

            Route::get('accept-bid/{bidId}' , 'Request\AcceptRequestBidController@acceptBid');

            Route::resource('bid' , 'Bid\BidController');

            Route::get('user-bid' , 'Bid\BidController@getUsersBid');

            Route::post('change-bid-status/{bidId}' , 'Bid\BidStatusController@changeStatus');

        });*/
    });


});
