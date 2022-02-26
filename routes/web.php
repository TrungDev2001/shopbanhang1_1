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
    return redirect()->route('home.index');
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
    Route::get('/chart_data_truycap', [
        'as' => 'chart_data_truycap',
        'uses' =>  'dashboardController@chart_data_truycap'
    ]);
    Route::get('/chart-data-area-doanhthu-daily', [
        'as' => 'chart_data_area_doanhthu_daily',
        'uses' =>  'dashboardController@chart_data_area_doanhthu_daily'
    ]);
    Route::get('/chart-data-area-doanhthu-month', [
        'as' => 'chart_data_area_doanhthu_month',
        'uses' =>  'dashboardController@chart_data_area_doanhthu_month'
    ]);
    Route::get('/chart-data-area-doanhthu-yearly', [
        'as' => 'chart_data_area_doanhthu_yearly',
        'uses' =>  'dashboardController@chart_data_area_doanhthu_yearly'
    ]);
});
Route::prefix('category')->group(function () {
    Route::get('/', [
        'as' => 'category.index',
        'uses' => 'CategoryController@index',
        'middleware' => 'can:category-list'
    ]);
    Route::post('/store', [
        'as' => 'category.store',
        'uses' => 'CategoryController@store',
        'middleware' => 'can:category-add'
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
            'middleware' => 'can:category-delete'
        ]);
        Route::get('/edit/{id}', [
            'uses' =>  'CategoryController@edit',
            'middleware' => 'can:category-edit'
        ]);
        Route::post('/update/{id}', [
            'uses' =>  'CategoryController@update',
            'middleware' => 'can:category-edit'
        ]);
    });
});

Route::prefix('brands')->group(function () {
    Route::get('/', [
        'as' => 'brands.index',
        'uses' =>  'BrandController@index',
        'middleware' => 'can:brand-list'
    ]);
    Route::get('/fetchBrands', [
        'uses' => 'BrandController@fetchBrands',
    ]);
    Route::get('/show/{id}', [
        'uses' => 'BrandController@show',
    ]);
    Route::post('/store', [
        'uses' => 'BrandController@store',
        'middleware' => 'can:brand-add'
    ]);
    Route::get('/edit/{id}', [
        'uses' => 'BrandController@edit',
    ]);
    Route::post('/update/{id}', [
        'uses' => 'BrandController@update',
        'middleware' => 'can:brand-edit'
    ]);
    Route::delete('/delete/{id}', [
        'uses' => 'BrandController@destroy',
        'middleware' => 'can:brand-delete'
    ]);
});

Route::prefix('sliders')->group(function () {
    Route::get('/', [
        'as' => 'sliders.index',
        'uses' => 'SliderController@index',
        'middleware' => 'can:slider-list'
    ]);
    Route::get('/petchSlider', [
        'uses' => 'SliderController@petchSlider'
    ]);
    Route::post('/store', [
        'uses' => 'SliderController@store',
        'middleware' => 'can:slider-add'
    ]);
    Route::get('/edit/{id}', [
        'uses' => 'SliderController@edit',
    ]);
    Route::post('/update/{id}', [
        'uses' => 'SliderController@update',
        'middleware' => 'can:slider-edit'
    ]);
    Route::delete('/delete/{id}', [
        'uses' => 'SliderController@destroy',
        'middleware' => 'can:slider-delete'
    ]);
});

Route::prefix('products')->group(function () {
    Route::get('/', [
        'as' => 'products.index',
        'uses' => 'ProductController@index',
        'middleware' => 'can:product-list'
    ]);
    Route::get('/categoryBrands', [
        'uses' => 'ProductController@categoryBrands'
    ]);
    Route::get('/create', [
        'as' => 'products.create',
        'uses' => 'ProductController@create',
        'middleware' => 'can:product-add'
    ]);
    Route::post('/store', [
        'as' => 'products.store',
        'uses' => 'ProductController@store',
        'middleware' => 'can:product-add'
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
        'uses' => 'ProductController@edit_cover',
        'middleware' => 'can:product-edit'
    ]);
    Route::post('/update/{id}', [
        'as' => 'products.update',
        'uses' => 'ProductController@update'
    ]);
    Route::post('/update_cover/{id}', [
        'as' => 'products.update_cover',
        'uses' => 'ProductController@update_cover',
    ]);
    Route::post('/updateImageDetail', [
        'uses' => 'ProductController@updateImageDetail',
    ]);
    Route::post('/addImageDetail/{id}', [
        'as' => 'products.addImageDetail',
        'uses' => 'ProductController@addImageDetail',
    ]);
    Route::delete('/deleteImageDetail/{id}', [
        'uses' => 'ProductController@destroyImageDetail',
    ]);
    Route::delete('/delete/{id}', [
        'uses' => 'ProductController@destroy',
        'middleware' => 'can:product-delete'
    ]);
    Route::get('edit_cover/editDocument/{id}', [
        'as' => 'products.editDocument',
        'uses' => 'ProductController@editDocument',
    ]);
    Route::delete('edit_cover/deleteDocument/{name}/{path}', [
        'as' => 'products.deleteDocument',
        'uses' => 'ProductController@deleteDocument',
    ]);
    Route::get('edit_cover/download-document/{path}', [
        'as' => 'products.download_document',
        'uses' => 'ProductController@download_document',
    ]);
    Route::post('edit_cover/add-document/{id}', [
        'as' => 'products.add_document',
        'uses' => 'ProductController@add_document',
    ]);
});

Route::prefix('Ads')->group(function () {
    Route::get('/', [
        'as' => 'ads.index',
        'uses' => 'AdsController@index',
        'middleware' => 'can:ads-list'
    ]);
    Route::post('/store', [
        'uses' => 'AdsController@store',
        'middleware' => 'can:ads-add'
    ]);
    Route::get('/fetchAds', [
        'uses' => 'AdsController@fetchAds'
    ]);
    Route::get('/edit/{id}', [
        'uses' => 'AdsController@edit'
    ]);
    Route::post('/update/{id}', [
        'uses' => 'AdsController@update',
        'middleware' => 'can:ads-edit'
    ]);
    Route::delete('/delete/{id}', [
        'uses' => 'AdsController@destroy',
        'middleware' => 'can:ads-delete'
    ]);
});

Route::prefix('manageOrder')->group(function () {
    Route::get('/', [
        'as' => 'manageOrder.index',
        'uses' => 'ManageOrderController@index',
        'middleware' => 'can:manageOrder-list'
    ]);
    Route::get('/petchDataOder', [
        'as' => 'manageOrder.petch',
        'uses' => 'ManageOrderController@petchDataOder'
    ]);
    Route::get('/show/{id}', [
        'as' => 'manageOrder.show',
        'uses' => 'ManageOrderController@show',
        'middleware' => 'can:manageOrder-show'
    ]);
    Route::get('/print/{id}', [
        'as' => 'manageOrder.print',
        'uses' => 'ManageOrderController@print',
        'middleware' => 'can:manageOrder-print'
    ]);
    Route::post('/update/{id}', [
        'as' => 'manageOrder.update',
        'uses' => 'ManageOrderController@update',
        'middleware' => 'can:manageOrder-edit'
    ]);
});

Route::prefix('voucher')->group(function () {
    Route::get('/', [
        'as' => 'voucher.index',
        'uses' => 'VoucherController@index',
        'middleware' => 'can:voucher-list'
    ]);
    Route::get('/petchDataVoucher', [
        'as' => 'voucher.petch',
        'uses' => 'VoucherController@petchDataVoucher'
    ]);
    Route::post('/addVoucher', [
        'as' => 'voucher.store',
        'uses' => 'VoucherController@store',
        'middleware' => 'can:voucher-add'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'voucher.edit',
        'uses' => 'VoucherController@edit'
    ]);
    Route::post('/update/{id}', [
        'as' => 'voucher.update',
        'uses' => 'VoucherController@update',
        'middleware' => 'can:voucher-edit'
    ]);
    Route::delete('/delete/{id}', [
        'as' => 'voucher.delete',
        'uses' => 'VoucherController@destroy',
        'middleware' => 'can:voucher-delete'
    ]);
    Route::post('/send-gift-KH-vip/{voucher_id}', [
        'as' => 'voucher.send_gift_kh_vip',
        'uses' => 'VoucherController@send_gift_kh_vip'
    ]);
    Route::get('/test', [
        'uses' => 'VoucherController@test'
    ]);
});

Route::prefix('transport_fee')->group(function () {
    Route::get('/', [
        'as' => 'transport_fee.index',
        'uses' => 'Transport_feeController@index',
        'middleware' => 'can:transportFee-list'
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
        'uses' => 'Transport_feeController@store',
        'middleware' => 'can:transportFee-add'
    ]);
    Route::post('/update/{id}', [
        'as' => 'transport_fee.update',
        'uses' => 'Transport_feeController@update',
        'middleware' => 'can:transportFee-edit'
    ]);
    Route::delete('/delete/{id}', [
        'as' => 'transport_fee.delete',
        'uses' => 'Transport_feeController@destroy',
        'middleware' => 'can:transportFee-delete'
    ]);
});

Route::prefix('CategoryPost')->group(function () {
    Route::get('/', [
        'as' => 'CategoryPost.index',
        'uses' => 'CategoryPostController@index',
        'middleware' => 'can:categoryPost-list'
    ]);
    Route::post('/store', [
        'as' => 'CategoryPost.store',
        'uses' => 'CategoryPostController@store',
        'middleware' => 'can:categoryPost-add'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'CategoryPost.edit',
        'uses' => 'CategoryPostController@edit'
    ]);
    Route::post('/update/{id}', [
        'as' => 'CategoryPost.update',
        'uses' => 'CategoryPostController@update',
        'middleware' => 'can:categoryPost-edit'
    ]);
    Route::delete('/delete/{id}', [
        'as' => 'CategoryPost.delete',
        'uses' => 'CategoryPostController@destroy',
        'middleware' => 'can:categoryPost-delete'
    ]);
});

Route::prefix('Post')->group(function () {
    Route::get('/', [
        'as' => 'Post.index',
        'uses' => 'PostController@index',
        'middleware' => 'can:post-list'
    ]);
    Route::get('/fetchPost', [
        'as' => 'Post.fetchPost',
        'uses' => 'PostController@fetchPost'
    ]);
    Route::get('/create', [
        'as' => 'Post.create',
        'uses' => 'PostController@create',
        'middleware' => 'can:post-add'
    ]);
    Route::post('/store', [
        'as' => 'Post.store',
        'uses' => 'PostController@store',
        'middleware' => 'can:post-add'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'Post.edit',
        'uses' => 'PostController@edit',
        'middleware' => 'can:post-edit'
    ]);
    Route::post('/update/{id}', [
        'as' => 'Post.update',
        'uses' => 'PostController@update',
        'middleware' => 'can:post-edit'
    ]);
    Route::delete('/delete/{id}', [
        'as' => 'Post.destroy',
        'uses' => 'PostController@destroy',
        'middleware' => 'can:post-delete'
    ]);
});

Route::prefix('Video')->group(function () {
    Route::get('/', [
        'as' => 'Video.index',
        'uses' => 'VideoController@index',
        'middleware' => 'can:video-list'
    ]);
    Route::get('/fetchVideo', [
        'as' => 'Video.fetchVideo',
        'uses' => 'VideoController@fetchVideo'
    ]);
    Route::post('/store', [
        'as' => 'Video.store',
        'uses' => 'VideoController@store',
        'middleware' => 'can:video-add'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'Video.edit',
        'uses' => 'VideoController@edit'
    ]);
    Route::post('/update/{id}', [
        'as' => 'Video.update',
        'uses' => 'VideoController@update',
        'middleware' => 'can:video-edit'
    ]);
    Route::delete('/delete/{id}', [
        'as' => 'Video.destroy',
        'uses' => 'VideoController@destroy',
        'middleware' => 'can:video-delete'
    ]);
});

Route::prefix('contact')->group(function () {
    Route::get('/', [
        'as' => 'contact.index',
        'uses' => 'ContactController@index',
        'middleware' => 'can:contact-list'
    ]);
    Route::get('/edit', [
        'as' => 'contact.edit',
        'uses' => 'ContactController@edit'
    ]);
    Route::post('/update', [
        'as' => 'contact.update',
        'uses' => 'ContactController@update',
        'middleware' => 'can:contact-edit'
    ]);
    Route::get('/fetch/{id}', [
        'as' => 'contact.fetch',
        'uses' => 'ContactController@fetch'
    ]);
    Route::post('/reply_contact/{id}', [
        'as' => 'contact.reply_contact',
        'uses' => 'ContactController@reply_contact',
        'middleware' => 'can:contact-reply'
    ]);
    Route::delete('/destroy/{id}', [
        'as' => 'contact.destroy',
        'uses' => 'ContactController@destroy',
        'middleware' => 'can:contact-delete'
    ]);
});

Route::prefix('document')->group(function () {
    Route::get('/', [
        'as' => 'GoogleDriveDocumentController.index',
        'uses' => 'GoogleDriveDocumentController@index',
        'middleware' => 'can:document-list'
    ]);
    Route::get('/create-document-ggDriver', [
        'as' => 'create_document',
        'uses' => 'GoogleDriveDocumentController@create_document'
    ]);
    Route::get('/paginate-document-ggDriver', [
        'as' => 'getDataPaginate',
        'uses' => 'GoogleDriveDocumentController@getDataPaginate'
    ]);
    Route::delete('/delete/{name}/{path}', [
        'as' => 'destroy',
        'uses' => 'GoogleDriveDocumentController@destroy',
        'middleware' => 'can:document-delete'
    ]);
});

//phân quyền
Route::prefix('user')->group(function () {
    Route::get('/', [
        'as' => 'UserController.index',
        'uses' => 'UserController@index',
        'middleware' => 'can:user-list'
    ]);
    Route::get('/create', [
        'as' => 'UserController.create',
        'uses' => 'UserController@create',
        'middleware' => 'can:user-add'
    ]);
    Route::post('/store', [
        'as' => 'UserController.store',
        'uses' => 'UserController@store',
        'middleware' => 'can:user-add'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'UserController.edit',
        'uses' => 'UserController@edit',
        'middleware' => 'can:user-edit'
    ]);
    Route::post('/update/{id}', [
        'as' => 'UserController.update',
        'uses' => 'UserController@update',
        'middleware' => 'can:user-edit'
    ]);
    Route::delete('/delete/{id}', [
        'as' => 'UserController.delete',
        'uses' => 'UserController@destroy',
        'middleware' => 'can:user-delete'
    ]);
});
Route::prefix('role')->group(function () {
    Route::get('/', [
        'as' => 'RoleController.index',
        'uses' => 'RoleController@index',
        'middleware' => 'can:role-list'
    ]);
    Route::get('/create', [
        'as' => 'RoleController.create',
        'uses' => 'RoleController@create',
        'middleware' => 'can:role-add'
    ]);
    Route::post('/store', [
        'as' => 'RoleController.store',
        'uses' => 'RoleController@store',
        'middleware' => 'can:role-add'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'RoleController.edit',
        'uses' => 'RoleController@edit',
        'middleware' => 'can:role-edit'
    ]);
    Route::post('/update/{id}', [
        'as' => 'RoleController.update',
        'uses' => 'RoleController@update',
        'middleware' => 'can:role-edit'
    ]);
    Route::delete('/delete/{id}', [
        'as' => 'RoleController.delete',
        'uses' => 'RoleController@destroy',
        'middleware' => 'can:role-delete'
    ]);
});
Route::prefix('permission')->group(function () {
    Route::get('/', [
        'as' => 'PermissionController.index',
        'uses' => 'PermissionController@index',
        'middleware' => 'can:permission-list'
    ]);
    Route::get('/create', [
        'as' => 'PermissionController.create',
        'uses' => 'PermissionController@create',
        'middleware' => 'can:permission-add'
    ]);
    Route::post('/store', [
        'as' => 'PermissionController.store',
        'uses' => 'PermissionController@store',
        'middleware' => 'can:permission-add'
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
