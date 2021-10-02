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

Auth::routes(['verify' => true]);

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('kabupaten/kecamatan/{id}', 'StoreController@getKecamatan');
Route::get('kecamatan/desa/{id}', 'StoreController@getDesa');

Route::get('/', 'BerandaController@index')->name('home');
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::get('home', 'DashboardController@dashboard')->name('dashboard');

    Route::get('profile', 'DashboardController@profile')->name('profile');
    Route::put('profile', 'DashboardController@profileUpdate')->name('profile.update');
    Route::put('foto-profile', 'DashboardController@updateFotoProfile')->name('profile.foto');

    Route::get('lap-transaksi', 'DashboardController@lapTransaksi')->name('dashboard.lapTransaksi');
    Route::get('lap-pesanan', 'DashboardController@lapPesanan')->name('dashboard.lapPesanan');
    Route::get('lap-user', 'DashboardController@lapUser')->name('dashboard.lapUser');
    Route::get('transaksi_pdf', 'DashboardController@cetak_transaksi')->name('dashboard.cetakTransaksi');
    Route::get('pesanan_pdf', 'DashboardController@cetak_pesanan')->name('dashboard.cetakPesanan');
    Route::get('user_pdf', 'DashboardController@cetak_user')->name('dashboard.cetakUser');

    Route::group(['middleware' => 'auth.isAdmin'], function () {
        Route::get('settings', 'SettingController@index')->name('setting');

        Route::get('users', 'UsersController@index')->name('user.index');
        Route::get('users/create', 'UsersController@create')->name('user.create');
        Route::post('users', 'UsersController@store')->name('user.store');
        Route::get('user-datatable', 'UsersController@getData')->name('user.getdata');
        Route::get('user/edit/{id}', 'UsersController@edit')->name('user.edit');
        Route::put('user/update/{id}', 'UsersController@update')->name('user.update');
        Route::get('user/{id}/delete', 'UsersController@destroy')->name('user.delete');
    });

    Route::group(['middleware' => 'role:isAdmin,isPemilik'], function () {
        Route::get('transaksi', 'TransaksiController@index')->name('transaksi.index');
        Route::get('transaksi/create', 'TransaksiControler@create')->name('transaksi.create');
        Route::post('create', 'TransaksiController@store')->name('transaksi.store');
        Route::get('transaksi/data', 'TransaksiController@getData')->name('transaksi.getdata');

        Route::get('rekening', 'RekeningController@index')->name('rekening.index');
        Route::get('rekening/create', 'RekeningController@create')->name('rekening.create');
        Route::post('rekening', 'RekeningController@store')->name('rekening.store');
        Route::get('data-rekening', 'RekeningController@getData')->name('rekening.getdata');
        Route::get('rekening/edit/{id}', 'RekeningController@edit')->name('rekening.edit');
        Route::put('rekening/update/{id}', 'RekeningController@update')->name('rekening.update');
        Route::get('rekening/{id}/delete', 'RekeningController@destroy')->name('rekening.delete');

        Route::get('toko', 'StoreController@index')->name('toko.index');
        Route::get('toko/create', 'StoreController@create')->name('toko.create');
        Route::post('toko', 'StoreController@store')->name('toko.store');
        Route::get('data-toko', 'StoreController@getData')->name('toko.getdata');
        Route::get('toko/edit/{id}', 'StoreController@edit')->name('toko.edit');
        Route::put('toko/update/{id}', 'StoreController@update')->name('toko.update');
        Route::get('toko/{id}/delete', 'StoreController@destroy')->name('toko.delete');
        Route::get('toko/hapus/{id}', 'StoreController@delete')->name('toko.hapus');
    });

    Route::group(['middleware' => 'role:isPemilik'], function () {
        Route::get('order', 'OrderController@index')->name('order.index');
        Route::get('order/create', 'OrderController@create')->name('order.create');
        // Route::post('create', 'OrderController@store')->name('order.store');
        Route::get('data-order', 'OrderController@getData')->name('order.getdata');
        Route::get('order/edit/{id}', 'OrderController@edit')->name('order.edit');
        Route::put('order/update/{id}', 'OrderController@update')->name('order.update');

        Route::get('product', 'ProductController@index')->name('product.index');
        Route::get('product/create', 'ProductController@create')->name('product.create');
        Route::post('create', 'ProductController@store')->name('product.store');
        Route::get('data-product', 'ProductController@getData')->name('product.getdata');
        Route::get('product/view/{id}', 'ProductController@show')->name('product.show');
        Route::get('product/edit/{id}', 'ProductController@edit')->name('product.edit');
        Route::put('product/update/{id}', 'ProductController@update')->name('product.update');
        Route::get('product/{id}/delete', 'ProductController@destroy')->name('product.delete');
    });

    Route::group(['prefix' => 'p', 'middleware' => 'role:isPelanggan'], function () {
        Route::get('home', 'HomeController@index')->name('home');
        Route::post('filter-produk', 'HomeController@filterProduk')->name('filter.produk');
        Route::post('filter-toko', 'HomeController@filterStore')->name('filter.store');

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'OrderController@order')->name('po.index');
            Route::get('create/{id}', 'OrderController@createOrder')->name('po.create');
            Route::get('add/', 'OrderController@buatOrder')->name('po.add');
            Route::get('data-order', 'OrderController@getDataPelanggan')->name('po.getdatapelanggan');
            Route::post('create', 'OrderController@saveOrder')->name('order.store');

            Route::post('checkout-order', 'OrderController@saveCheckout')->name('po.checkout');
            Route::get('edit-order/{id}', 'OrderController@editOrder')->name('po.editOrder');
            Route::put('update-order/{id}', 'OrderController@updateOrder')->name('po.updateOrder');
        });

        Route::group(['prefix' => 'history'], function () {
            Route::get('/', 'HistoryController@index')->name('history.index');
            Route::get('data-history', 'HistoryController@getData')->name('history.getdata');
        });

        Route::group(['prefix' => 'store'], function () {
            Route::get('/', 'StoreController@indexStore')->name('store.index');
            Route::get('create', 'StoreController@createStore')->name('store.create');
            Route::post('/', 'StoreController@storeStore')->name('store.store');
            Route::get('data-detail/{id}', 'StoreController@getDataDetail')->name('store.getdatadetail');
            Route::get('detail/{id}', 'StoreController@detailStore')->name('store.detail');
            Route::get('edit/{id}', 'StoreController@editStore')->name('store.edit');
            Route::put('update/{id}', 'StoreController@updateStore')->name('store.update');
            Route::get('{id}/delete', 'StoreController@delete')->name('store.delete');
        });

        Route::group(['prefix' => 'produk'], function () {
            Route::get('view/{id}', 'HomeController@show')->name('product.lihat');
        });
    });
});
