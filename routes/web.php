<?php

Route::group(['prefix' => '/', 'namespace' => 'Pages'], function () {

    Route::get('/', [
        'uses' => 'MainController@index',
        'as' => 'beranda'
    ]);

    Route::group(['prefix' => 'cari'], function () {

        Route::get('data/{filter}/{keyword}', [
            'uses' => 'CariController@getCariData',
            'as' => 'get.cari.data'
        ]);

    });

    Route::get('tentang', [
        'uses' => 'MainController@tentang',
        'as' => 'tentang'
    ]);

    Route::get('cara-kerja', [
        'uses' => 'MainController@caraKerja',
        'as' => 'cara-kerja'
    ]);

    Route::get('ketentuan-layanan', [
        'uses' => 'MainController@ketentuanLayanan',
        'as' => 'ketentuan-layanan'
    ]);

    Route::get('kebijakan-privasi', [
        'uses' => 'MainController@kebijakanPrivasi',
        'as' => 'kebijakan-privasi'
    ]);

    Route::group(['prefix' => 'testimoni', 'middleware' => 'auth'], function () {

        Route::post('kirim', [
            'uses' => 'MainController@kirimTestimoni',
            'as' => 'kirim.testimoni'
        ]);

        Route::get('{id}/hapus', [
            'uses' => 'MainController@hapusTestimoni',
            'as' => 'hapus.testimoni'
        ]);

    });

    Route::group(['prefix' => 'kontak'], function () {

        Route::get('/', [
            'uses' => 'MainController@kontak',
            'as' => 'kontak'
        ]);

        Route::post('kirim', [
            'uses' => 'MainController@kirimKontak',
            'as' => 'kirim.kontak'
        ]);

    });

});

Route::post('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@postReset')->name('password.reset');

Auth::routes();

Route::group(['prefix' => 'akun'], function () {

    Route::post('masuk', [
        'uses' => 'Auth\LoginController@login',
        'as' => 'login'
    ]);

    Route::post('keluar', [
        'uses' => 'Auth\LoginController@logout',
        'as' => 'logout'
    ]);

    Route::group(['namespace' => 'Pages\Users', 'middleware' => 'user'], function () {

        Route::get('dashboard', [
            'middleware' => 'user.bio',
            'uses' => 'UserController@dashboard',
            'as' => 'user.dashboard'
        ]);

        Route::get('biodata', [
            'uses' => 'UserController@biodata',
            'as' => 'user.biodata'
        ]);

        Route::put('profil/update', [
            'uses' => 'UserController@updateBiodata',
            'as' => 'user.update.biodata'
        ]);

        Route::get('pengaturan', [
            'middleware' => 'user.bio',
            'uses' => 'UserController@pengaturan',
            'as' => 'user.pengaturan'
        ]);

        Route::put('pengaturan/update', [
            'uses' => 'UserController@updatePengaturan',
            'as' => 'user.update.pengaturan'
        ]);

    });

});

Route::group(['namespace' => 'Pages\Admins', 'prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::get('/', [
        'uses' => 'AdminController@index',
        'as' => 'admin.dashboard'
    ]);

});
