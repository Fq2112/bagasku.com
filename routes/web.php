<?php

Route::group(['prefix' => '/'], function () {

    Route::get('/', [
        'uses' => 'MainController@index',
        'as' => 'beranda'
    ]);

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

Route::group(['namespace' => 'Auth', 'prefix' => 'account'], function () {

    Route::post('login', [
        'uses' => 'LoginController@login',
        'as' => 'login'
    ]);

    Route::post('logout', [
        'uses' => 'LoginController@logout',
        'as' => 'logout'
    ]);

    Route::get('activate', [
        'uses' => 'ActivationController@activate',
        'as' => 'activate'
    ]);

});
