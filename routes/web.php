<?php

Route::group(['prefix' => '/'], function () {

    Route::get('/', [
        'uses' => 'MainController@index',
        'as' => 'beranda'
    ]);

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
