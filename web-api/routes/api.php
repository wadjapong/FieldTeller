<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {
    //All Users
    Route::prefix('users')->group(function () {
        Route::get('get/all', 'Api\v1\AuthController@get_both_users');

        Route::prefix('roles')->group(function () {
            Route::get('get', 'Api\v1\RolesController@index');
            Route::post('create', 'Api\v1\RolesController@store');
            Route::delete('remove/{id}', 'Api\v1\RolesController@destroy');
            Route::put('edit/{id}', 'Api\v1\RolesController@store'); 
            Route::post('assign', 'Api\v1\UserRolesController@store'); 
            Route::get('user_role/get', 'Api\v1\UserRolesController@index');

            Route::prefix('permissions')->group(function () {
                // Route::post('assign', 'Api\v1\RolePermissionsController@store');
                Route::post('assign', 'Api\v1\RolePermissionsController@store'); 
            Route::get('get/{role_id}', 'Api\v1\RolePermissionsController@index');
            }); 
        });
        Route::get('permissions/get', 'Api\v1\UserPermissionsController@index');
    });

    //A User
    Route::prefix('user')->group(function () {
        Route::get('get', 'Api\v1\AuthController@index');
        Route::post('create', 'Api\v1\AuthController@register');
        Route::delete('remove/{id}', 'Api\v1\AuthController@destroy');
        Route::put('restore/{id}', 'Api\v1\AuthController@restore');
        Route::delete('deactivate/{id}', 'Api\v1\AuthController@terminate');
        Route::get('abilities', 'Api\v1\AbilitiesController@index');
        Route::get('permissions/{id}', 'Api\v1\AuthController@get_user_permissions');
    });

    //Distributor routes
    Route::prefix('distributors')->group(function () {
        Route::prefix('account')->group(function () {
            Route::get('get', 'Api\v1\DistributorsController@index');
            Route::post('create', 'Api\v1\DistributorsController@store');
            Route::put('edit/{id}', 'Api\v1\DistributorsController@store');
            Route::delete('remove/{id}', 'Api\v1\DistributorsController@destroy');
            Route::post('topup', 'Api\v1\DistributorsController@topup_vending_account');
            Route::get('topup', 'Api\v1\DistributorsController@get_account_topups');
            Route::post('float_transfer', 'Api\v1\DistributorsController@transfer_float');
            Route::get('float_transfer', 'Api\v1\DistributorsController@get_float_transfers');
            Route::post('float_sale', 'Api\v1\DistributorsController@sell_float');
            Route::get('float_sale', 'Api\v1\DistributorsController@get_float_sales');
        });
        Route::post('search/{keyword}', 'Api\v1\DistributorsController@search');
        Route::post('reports', 'Api\v1\DistributorsController@reports');
    });
    
    //Field Tellers routes
    Route::prefix('field_tellers')->group(function () {
        Route::prefix('account')->group(function () {
            Route::get('get', 'Api\v1\FieldTellersController@index');
            Route::post('create', 'Api\v1\FieldTellersController@store');
            Route::put('edit/{id}', 'Api\v1\FieldTellersController@store');
            Route::delete('remove/{id}', 'Api\v1\FieldTellersController@destroy');
            Route::post('pair_merchant', 'Api\v1\FieldTellersController@pair_to_merchant');
            Route::get('pair_merchant', 'Api\v1\FieldTellersController@get_merchant_pairs');
            Route::post('float_transfer', 'Api\v1\FieldTellersController@transfer_float');
            Route::get('float_transfer', 'Api\v1\FieldTellersController@get_float_transfers');
            Route::post('commission_settlement', 'Api\v1\FieldTellersController@commission_settlement');
            Route::get('commission_settlement', 'Api\v1\FieldTellersController@get_commission_settlements');
        });
        Route::post('search/{keyword}', 'Api\v1\FieldTellersController@search');
        Route::post('reports', 'Api\v1\FieldTellersController@reports');
    });
    
    //Merchants routes
    Route::prefix('merchants')->group(function () {
        Route::prefix('account')->group(function () {
            Route::get('get', 'Api\v1\MerchantsController@index');
            Route::post('create', 'Api\v1\MerchantsController@store');
            Route::put('edit/{id}', 'Api\v1\MerchantsController@store');
            Route::delete('remove/{id}', 'Api\v1\MerchantsController@destroy');
            Route::post('schedule_pickup', 'Api\v1\MerchantsController@schedule_cash_pickup');
            Route::get('schedule_pickup', 'Api\v1\MerchantsController@get_pickup_schedules');
            Route::post('request_pickup', 'Api\v1\MerchantsController@request_cash_pickup');
            Route::get('request_pickup', 'Api\v1\MerchantsController@get_pickup_requests');
            Route::post('commission_settlement', 'Api\v1\MerchantsController@commission_settlement');
            Route::get('commission_settlement', 'Api\v1\MerchantsController@get_commission_settlements');
        });
        Route::post('search/{keyword}', 'Api\v1\MerchantsController@search');
        Route::post('reports', 'Api\v1\MerchantsController@reports');
    });
});