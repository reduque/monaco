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


Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/contact/',function(){
	echo 'mailto:sales@monacofoods.com';
})->name('contact');

Route::get('our-story/', 'HomeController@our_story')->name('our_story');
Route::get('divisions/', 'HomeController@divisions')->name('divisions');
Route::get('reach-us/', 'HomeController@reach_us')->name('reach_us');
Route::post('reach-us/', 'HomeController@reach_us_enviar')->name('reach_us_enviar');
Route::get('eating-healthy-tips/', 'TipController@index')->name('tips');
Route::get('the-kitchen/', 'RecipeController@index')->name('recipes');
Route::get('the-kitchen/{slug}/', 'RecipeController@category')->name('recipes_category');

Route::get('brands/', 'ProductController@brands')->name('brands');
Route::get('brand/monaco', 'ProductController@brand_monaco')->name('brand_monaco');
Route::get('brand/{slug}', 'ProductController@brand')->name('brand');

//Route::get('line/{slug}', 'ProductController@line')->name('line');
Route::get('category/{slug}', 'ProductController@category')->name('category');
Route::get('change_line/{id}', 'ProductController@change_line')->name('change_line');
Route::get('subcategory/{slug}', 'ProductController@subcategory')->name('subcategory');
Route::get('product/{slug}', 'ProductController@product')->name('product');


Route::group(['middleware' => 'auth'], function () {
    Route::get('administracion','administracion\HomeController@index');

	Route::namespace('administracion')->prefix('admin')->group(function () {
    	Route::get('/','HomeController@index')->name('administracion_home');

	//usuarios
	    Route::get('usuarios_eliminar/{id}', 'UserController@destroy')->name('usuarios_eliminar');
	    Route::get('edit_password/{id}', 'UserController@edit_password')->name('edit_password');
	    Route::put('update_password/{id}', 'UserController@update_password')->name('update_password');
	    Route::resource('usuarios', 'UserController');

	    Route::get('banners_eliminar/{id}', 'BannerController@destroy')->name('banners_eliminar');
	    Route::resource('banners', 'BannerController');

	    Route::get('tips_eliminar/{id}', 'TipController@destroy')->name('tips_eliminar');
	    Route::resource('tips', 'TipController');

	    Route::get('recipes_eliminar/{id}', 'RecipeController@destroy')->name('recipes_eliminar');
	    Route::resource('recipes', 'RecipeController');

	    Route::get('banners_brands_eliminar/{id}', 'BannerBrandController@destroy')->name('banners_brands_eliminar');
	    Route::resource('banners_brands', 'BannerBrandController');

	    Route::get('products_eliminar/{id}', 'ProductController@destroy')->name('products_eliminar');
	    Route::resource('products', 'ProductController');

	});
});