<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Pages routes
Route::get('/', 'Frontend\PagesController@index')->name('index');
Route::get('/contact', 'Frontend\PagesController@contact')->name('contact');
Route::get('/search', 'Frontend\PagesController@search')->name('search');


//user routes
	Route::group([ 'prefix'	=>	'user' ], function(){
		Route::get('/token/{token}','Frontend\VerificationController@verify')->name('user.verification');
		Route::get('/dashboard','Frontend\UsersController@dashboard')->name('user.dashboard');
		Route::get('/profile','Frontend\UsersController@profile')->name('user.profile');
		Route::post('/profile/update/{id}','Frontend\UsersController@update')->name('user.profile.update');
		// no need to send user id for profile update.. use Auth::user() instead
	});

//cart routes
// also in api folder
	Route::group([ 'prefix'	=>	'carts' ], function(){
		Route::get('/','Frontend\CartsController@index')->name('carts');
		Route::post('/store','Frontend\CartsController@store')->name('carts.store');
		Route::post('/update/{id}','Frontend\CartsController@update')->name('carts.update');
		Route::get('/delete/{id}','Frontend\CartsController@delete')->name('carts.delete');
	});


//checkout routes
	Route::group([ 'prefix'	=>	'checkout' ], function(){
		Route::get('/','Frontend\CheckoutsController@index')->name('checkouts');
		Route::post('/store','Frontend\CheckoutsController@store')->name('checkouts.store');
	});


// Frontend Product routes
	Route::group([ 'prefix' => 'products' ], function(){

		Route::get('/', 'Frontend\ProductsController@products')->name('products');
		Route::get('/{slug}', 'Frontend\ProductsController@show')->name('products.show');

		//categories route
		Route::get('/categories', 'Frontend\CategoriesController@index')->name('categories.index');
		Route::get('/category/{id}', 'Frontend\CategoriesController@show')->name('categories.show');
	
	});



// Admin routes
	Route::group([ 'prefix'	=>	'admin' ], function(){

		Route::get('/', 'Backend\AdminPagesController@index')->name('admin.index'); 

		//Admin login routes
		Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login'); 
		Route::post('/login/submit', 'Auth\Admin\LoginController@login')->name('admin.login.submit'); 
		Route::get('/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout'); 

				//admin password email send
		Route::get('/password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request'); 
		Route::post('/password/email', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

				//admin password reset
		Route::get('/password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset'); 
		Route::post('/password/reset', 'Auth\Admin\ResetPasswordController@reset')->name('admin.password.update');


		//Admin Product routes
		Route::group([ 'prefix'	=>	'product' ], function(){

			Route::get('/', 'Backend\AdminProductsController@index')->name('admin.products');
			Route::get('/create', 'Backend\AdminProductsController@create')->name('admin.product.create');
			Route::post('/store', 'Backend\AdminProductsController@store')->name('admin.product.store');
			Route::get('/edit/{id}', 'Backend\AdminProductsController@edit')->name('admin.product.edit');
			Route::post('/update', 'Backend\AdminProductsController@update')->name('admin.product.update');
			Route::get('/delete/{id}', 'Backend\AdminProductsController@delete')->name('admin.product.delete');
		});
		//end product routes

		//Admin Order routes
		Route::group([ 'prefix'	=>	'orders' ], function(){

			Route::get('/', 'Backend\OrdersController@index')->name('admin.orders');
			Route::get('/view/{id}', 'Backend\OrdersController@show')->name('admin.order.show');
			Route::get('/delete/{id}', 'Backend\OrdersController@delete')->name('admin.order.delete');
			Route::post('/paid/{id}', 'Backend\OrdersController@paid')->name('admin.order.paid');
			Route::post('/completed/{id}', 'Backend\OrdersController@completed')->name('admin.order.completed');
			Route::post('/charge-update/{id}', 'Backend\OrdersController@chargeUpdate')->name('admin.order.charge');
			Route::get('/invoice/{id}', 'Backend\OrdersController@generateInvoice')->name('admin.order.invoice');

		});
		//end order routes


		//Admin Slider routes
		Route::group([ 'prefix'	=>	'sliders' ], function(){

			Route::get('/', 'Backend\SlidersController@index')->name('admin.sliders');
			Route::post('/store', 'Backend\SlidersController@store')->name('admin.slider.store');
			Route::post('/update/{id}', 'Backend\SlidersController@update')->name('admin.slider.update');
			Route::get('/delete/{id}', 'Backend\SlidersController@delete')->name('admin.slider.delete');

		});

	}); 




//Admin Category routes
		Route::group([ 'prefix'	=>	'category' ], function(){

			Route::get('/', 'Backend\CategoriesController@index')->name('admin.categories');
			Route::get('/create', 'Backend\CategoriesController@create')->name('admin.category.create');
			Route::post('/store', 'Backend\CategoriesController@store')->name('admin.category.store');
			Route::get('/edit/{id}', 'Backend\CategoriesController@edit')->name('admin.category.edit');
			Route::post('/update/{id}', 'Backend\CategoriesController@update')->name('admin.category.update');
			Route::get('/delete/{id}', 'Backend\CategoriesController@delete')->name('admin.category.delete');

		});

//Admin Brand routes
		Route::group([ 'prefix'	=>	'brands' ], function(){

			Route::get('/', 'Backend\BrandsController@index')->name('admin.brands');
			Route::get('/create', 'Backend\BrandsController@create')->name('admin.brand.create');
			Route::post('/store', 'Backend\BrandsController@store')->name('admin.brand.store');
			Route::get('/edit/{id}', 'Backend\BrandsController@edit')->name('admin.brand.edit');
			Route::post('/update/{id}', 'Backend\BrandsController@update')->name('admin.brand.update');
			Route::get('/delete/{id}', 'Backend\BrandsController@delete')->name('admin.brand.delete');

		});


//Admin Divisions routes
		Route::group([ 'prefix'	=>	'divisions' ], function(){

			Route::get('/', 'Backend\DivisionsController@index')->name('admin.divisions');
			Route::get('/create', 'Backend\DivisionsController@create')->name('admin.division.create');
			Route::post('/store', 'Backend\DivisionsController@store')->name('admin.division.store');
			Route::get('/edit/{id}', 'Backend\DivisionsController@edit')->name('admin.division.edit');
			Route::post('/update/{id}', 'Backend\DivisionsController@update')->name('admin.division.update');
			Route::get('/delete/{id}', 'Backend\DivisionsController@delete')->name('admin.division.delete');

		});


//Admin Districts routes
		Route::group([ 'prefix'	=>	'districts' ], function(){

			Route::get('/', 'Backend\DistrictsController@index')->name('admin.districts');
			Route::get('/create', 'Backend\DistrictsController@create')->name('admin.district.create');
			Route::post('/store', 'Backend\DistrictsController@store')->name('admin.district.store');
			Route::get('/edit/{id}', 'Backend\DistrictsController@edit')->name('admin.district.edit');
			Route::post('/update/{id}', 'Backend\DistrictsController@update')->name('admin.district.update');
			Route::get('/delete/{id}', 'Backend\DistrictsController@delete')->name('admin.district.delete');

		});

	



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// API routes

Route::get('get-district/{id}',function($id){
	return json_encode(App\Models\District::where('division_id',$id)->get());
});
