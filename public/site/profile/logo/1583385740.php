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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });

    
        
}); 

#====== phone verifiction ======#
Route::get('/user/verifi/{phone}','AuthController@verifiction');

#====== Update user info  ======#
Route::put('/user/update/{id}','ProfileController@update');

// ==============================================//

#====== List All Products ======#
Route::get('/products/list/with_paginate', 'ProductsController@index');
Route::get('/products/list/without_paginate', 'ProductsController@products_without_paginate');
#====== List single Product ======#
Route::get('/product/{id}','ProductsController@show');
#====== List Last added Products ======#
Route::get('/products/lastAdded','lastAddedController@index');


 

 
#====== List All Category ======#
Route::get('/category/list', 'categoryController@index');
Route::get('/category/list/sub/{parent_id}', 'categoryController@getSubCategory');
Route::get('/category/list/subSub/{parent_id}', 'categoryController@getSubSubCategory');


// ==============================================================//

#====== List All Factory's ======#
Route::get('/factory/list', 'factoryController@index');

// ==============================================================//

#====== Get By Category | Factory ======#
Route::get('/fillter/category/{cat_id}', 'fillterController@fillterByCategory');
Route::get('/fillter/factory/{factory_id}', 'fillterController@fillterByFactory');
// search by product name or by factory name
Route::get('/fillter/getProductsByNameOrFactory/{query}','fillterController@getByProductsByNameOrFactory');

// get factory by category
Route::get('/fillter/getFactorys/{cat_id}','fillterController@getFactorysByCategory');
// ==============================================================//

#====== Show Favorite List ======#
Route::get('/favorite/list/{user_id}', 'favoriteController@index');
#====== Add Product to Favorite List ======#
Route::post('/favorite/add', 'favoriteController@store');
#====== Delete From Favorite List ======#
Route::delete('/favorite/delete/{user_id}/{product_id}', 'favoriteController@destroy');


// ==============================================================//
#====== to get my Orders ======#
Route::get('/order/list/{user_phone}', 'OrdersController@index');
// ============= get order ================================//
Route::get('/order/show/{id}', 'OrdersController@show');
#====== Add new Order ======#
Route::post('/order/add', 'OrdersController@store');  


// ==============================================================//
#====== to get all Sliders ======#
Route::get('/sliders/list', 'SlidersController@index');


// ==============================================================//
#====== to get app settings ======#
Route::get('/app/sittings', 'appSettingsController@index');

// ==================================================================//
# ==== Feedback =================#
Route::post('/feedback','sendMessageController@postSendAsJson');


