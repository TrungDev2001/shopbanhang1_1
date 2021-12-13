<?php

use App\Models\Role;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/admin', function () {
//     return view('admin.dashboard');
// });
Route::prefix('admin')->group(function () {
    Route::get('/', [
        'as' => 'home.index',
        'uses' =>  'dashboardController@index'
    ]);
    Route::get('/profile', [
        'as' => 'home.SettingsProfile',
        'uses' =>  'dashboardController@SettingsProfile'
    ]);
    Route::post('/update/{id}', [
        'as' => 'SettingsProfile.update',
        'uses' =>  'dashboardController@updateProfile'
    ]);
    Route::post('/updateAvatar/{id}', [
        'as' => 'AvatarProfile.update',
        'uses' =>  'dashboardController@updateAvatar'
    ]);
});
Route::prefix('category')->group(function () {
    Route::get('/', [
        'as' => 'category.index',
        'uses' => 'CategoryController@index'
    ]);
    Route::post('/store', [
        'as' => 'category.store',
        'uses' => 'CategoryController@store'
    ]);

    Route::post('/export-excel', [
        'as' => 'category.export',
        'uses' => 'CategoryController@export_excel'
    ]);
    Route::post('/import-excel', [
        'as' => 'category.import',
        'uses' => 'CategoryController@import_excel'
    ]);

    Route::prefix('ajax')->group(function () {
        Route::get('/activeCategory', [
            'uses' =>  'CategoryController@activeCategory',
        ]);
        Route::post('/nameCategory/{id}', [
            'as' => 'category.ajaxNameCategory',
            'uses' => 'CategoryController@ajaxNameCategory'
        ]);
        Route::post('/activeCategory/{id}', [
            'as' => 'category.ajaxActiveCategory',
            'uses' => 'CategoryController@ajaxActiveCategory'
        ]);
        Route::delete('/delete/{id}', [
            'uses' =>  'CategoryController@destroy',
        ]);
        Route::get('/edit/{id}', [
            'uses' =>  'CategoryController@edit',
        ]);
        Route::post('/update/{id}', [
            'uses' =>  'CategoryController@update',
        ]);
    });
});

Route::prefix('brands')->group(function () {
    Route::get('/', [
        'as' => 'brands.index',
        'uses' =>  'BrandController@index'
    ]);
    Route::get('/fetchBrands', [
        'uses' => 'BrandController@fetchBrands',
    ]);
    Route::get('/show/{id}', [
        'uses' => 'BrandController@show',
    ]);
    Route::post('/store', [
        'uses' => 'BrandController@store',
    ]);
    Route::get('/edit/{id}', [
        'uses' => 'BrandController@edit',
    ]);
    Route::post('/update/{id}', [
        'uses' => 'BrandController@update',
    ]);
    Route::delete('/delete/{id}', [
        'uses' => 'BrandController@destroy',
    ]);
});

Route::prefix('sliders')->group(function () {
    Route::get('/', [
        'as' => 'sliders.index',
        'uses' => 'SliderController@index'
    ]);
    Route::get('/petchSlider', [
        'uses' => 'SliderController@petchSlider'
    ]);
    Route::post('/store', [
        'uses' => 'SliderController@store',
    ]);
    Route::get('/edit/{id}', [
        'uses' => 'SliderController@edit',
    ]);
    Route::post('/update/{id}', [
        'uses' => 'SliderController@update',
    ]);
    Route::delete('/delete/{id}', [
        'uses' => 'SliderController@destroy',
    ]);
});

Route::prefix('products')->group(function () {
    Route::get('/', [
        'as' => 'products.index',
        'uses' => 'ProductController@index'
    ]);
    Route::get('/categoryBrands', [
        'uses' => 'ProductController@categoryBrands'
    ]);
    Route::get('/create', [
        'as' => 'products.create',
        'uses' => 'ProductController@create'
    ]);
    Route::post('/store', [
        'as' => 'products.store',
        'uses' => 'ProductController@store'
    ]);
    Route::get('/fetchProduct', [
        'uses' => 'ProductController@fetchProduct'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'products.edit',
        'uses' => 'ProductController@edit'
    ]);
    Route::get('/edit_cover/{id}', [
        'as' => 'products.edit_cover',
        'uses' => 'ProductController@edit_cover'
    ]);
    Route::post('/update/{id}', [
        'as' => 'products.update',
        'uses' => 'ProductController@update'
    ]);
    Route::post('/update_cover/{id}', [
        'as' => 'products.update_cover',
        'uses' => 'ProductController@update_cover'
    ]);
    Route::post('/updateImageDetail', [
        'uses' => 'ProductController@updateImageDetail'
    ]);
    Route::post('/addImageDetail/{id}', [
        'as' => 'products.addImageDetail',
        'uses' => 'ProductController@addImageDetail'
    ]);
    Route::delete('/deleteImageDetail/{id}', [
        'uses' => 'ProductController@destroyImageDetail'
    ]);
    Route::delete('/delete/{id}', [
        'uses' => 'ProductController@destroy'
    ]);
});

Route::prefix('Ads')->group(function () {
    Route::get('/', [
        'as' => 'ads.index',
        'uses' => 'AdsController@index'
    ]);
    Route::post('/store', [
        'uses' => 'AdsController@store'
    ]);
    Route::get('/fetchAds', [
        'uses' => 'AdsController@fetchAds'
    ]);
    Route::get('/edit/{id}', [
        'uses' => 'AdsController@edit'
    ]);
    Route::post('/update/{id}', [
        'uses' => 'AdsController@update'
    ]);
    Route::delete('/delete/{id}', [
        'uses' => 'AdsController@destroy'
    ]);
});

Route::prefix('manageOrder')->group(function () {
    Route::get('/', [
        'as' => 'manageOrder.index',
        'uses' => 'ManageOrderController@index'
    ]);
    Route::get('/petchDataOder', [
        'as' => 'manageOrder.petch',
        'uses' => 'ManageOrderController@petchDataOder'
    ]);
    Route::get('/show/{id}', [
        'as' => 'manageOrder.show',
        'uses' => 'ManageOrderController@show'
    ]);
    Route::get('/print/{id}', [
        'as' => 'manageOrder.print',
        'uses' => 'ManageOrderController@print'
    ]);
    Route::post('/update/{id}', [
        'as' => 'manageOrder.update',
        'uses' => 'ManageOrderController@update'
    ]);
});

Route::prefix('voucher')->group(function () {
    Route::get('/', [
        'as' => 'voucher.index',
        'uses' => 'VoucherController@index'
    ]);
    Route::get('/petchDataVoucher', [
        'as' => 'voucher.petch',
        'uses' => 'VoucherController@petchDataVoucher'
    ]);
    Route::post('/addVoucher', [
        'as' => 'voucher.store',
        'uses' => 'VoucherController@store'
    ]);
    Route::delete('/delete/{id}', [
        'as' => 'voucher.delete',
        'uses' => 'VoucherController@destroy'
    ]);


    //thuchanhLTWeb
    Route::get('/thuchanh', [
        'as' => 'thuchanh.index',
        'uses' => 'VoucherController@thuchanh'
    ]);
});

Route::prefix('transport_fee')->group(function () {
    Route::get('/', [
        'as' => 'transport_fee.index',
        'uses' => 'Transport_feeController@index'
    ]);
    Route::get('/create', [
        'as' => 'transport_fee.create',
        'uses' => 'Transport_feeController@create'
    ]);
    Route::get('/petchDataTransportFee', [
        'as' => 'transport_fee.petch',
        'uses' => 'Transport_feeController@petchDataTransportFee'
    ]);
    Route::post('/store', [
        'as' => 'transport_fee.store',
        'uses' => 'Transport_feeController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'transport_fee.update',
        'uses' => 'Transport_feeController@update'
    ]);
    Route::delete('/delete/{id}', [
        'as' => 'transport_fee.delete',
        'uses' => 'Transport_feeController@destroy'
    ]);
});

Route::prefix('CategoryPost')->group(function () {
    Route::get('/', [
        'as' => 'CategoryPost.index',
        'uses' => 'CategoryPostController@index'
    ]);
    Route::post('/store', [
        'as' => 'CategoryPost.store',
        'uses' => 'CategoryPostController@store'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'CategoryPost.edit',
        'uses' => 'CategoryPostController@edit'
    ]);
    Route::post('/update/{id}', [
        'as' => 'CategoryPost.update',
        'uses' => 'CategoryPostController@update'
    ]);
    Route::delete('/delete/{id}', [
        'as' => 'CategoryPost.delete',
        'uses' => 'CategoryPostController@destroy'
    ]);
});

Route::prefix('Post')->group(function () {
    Route::get('/', [
        'as' => 'Post.index',
        'uses' => 'PostController@index'
    ]);
    Route::get('/fetchPost', [
        'as' => 'Post.fetchPost',
        'uses' => 'PostController@fetchPost'
    ]);
    Route::get('/create', [
        'as' => 'Post.create',
        'uses' => 'PostController@create'
    ]);
    Route::post('/store', [
        'as' => 'Post.store',
        'uses' => 'PostController@store'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'Post.edit',
        'uses' => 'PostController@edit'
    ]);
    Route::post('/update/{id}', [
        'as' => 'Post.update',
        'uses' => 'PostController@update'
    ]);
    Route::delete('/delete/{id}', [
        'as' => 'Post.destroy',
        'uses' => 'PostController@destroy'
    ]);
});

Route::prefix('Video')->group(function () {
    Route::get('/', [
        'as' => 'Video.index',
        'uses' => 'VideoController@index'
    ]);
    Route::get('/fetchVideo', [
        'as' => 'Video.fetchVideo',
        'uses' => 'VideoController@fetchVideo'
    ]);
    Route::post('/store', [
        'as' => 'Video.store',
        'uses' => 'VideoController@store'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'Video.edit',
        'uses' => 'VideoController@edit'
    ]);
    Route::post('/update/{id}', [
        'as' => 'Video.update',
        'uses' => 'VideoController@update'
    ]);
    Route::delete('/delete/{id}', [
        'as' => 'Video.destroy',
        'uses' => 'VideoController@destroy'
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
