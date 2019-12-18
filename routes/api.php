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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//cart routes
	Route::group([ 'prefix'	=>	'carts' ], function(){
		Route::get('/','API\CartsController@index')->name('carts');
		Route::post('/store','API\CartsController@store')->name('carts.store');
		Route::post('/update/{id}','API\CartsController@update')->name('carts.update');
		Route::get('/delete/{id}','API\CartsController@delete')->name('carts.delete');
	});

/*
|--------------------------------------------------------------------------
| !!!!IMPORTANT!!!
|--------------------------------------------------------------------------
	!!!ADD THESE IN http/kernel.php , INSIDE protected $middlewareGroups, 'api':

	\App\Http\Middleware\EncryptCookies::class,          // <------- ADD THIS
    \Illuminate\Session\Middleware\StartSession::class, // <------ ADD THIS

    OR carts.store ROUTE WITH AUTHENTICATED USER WILL NOT WORK!!!
|
*/ 