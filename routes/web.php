<?php

Route::group(['prefix' => '/'], function () {

    Route::get('/', [
        'uses' => 'MainController@index',
        'as' => 'beranda'
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
