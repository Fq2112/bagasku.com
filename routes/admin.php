<?php

Route::group(['namespace' => 'Pages\Admins', 'prefix' => 'sys-admin', 'middleware' => ['auth', 'admin']], function () {

    Route::get('dashboard', [
        'uses' => 'AdminController@index',
        'as' => 'admin.dashboard'
    ]);

    Route::group(['prefix' => 'account'], function () {

        Route::get('profile', [
            'uses' => 'AdminController@editProfile',
            'as' => 'admin.edit.profile'
        ]);

        Route::put('profile/update', [
            'uses' => 'AdminController@updateProfile',
            'as' => 'admin.update.profile'
        ]);

        Route::get('settings', [
            'uses' => 'AdminController@accountSettings',
            'as' => 'admin.settings'
        ]);

        Route::put('settings/update', [
            'uses' => 'AdminController@updateAccount',
            'as' => 'admin.update.account'
        ]);

    });

    Route::group(['prefix' => 'payment'], function () {
        Route::get('profile', [
            'uses' => 'AdminController@editProfile',
            'as' => 'admin.edit.profile'
        ]);
    });

    Route::group(['prefix' => 'loc'], function () {

        Route::group(['prefix' => 'negara'], function () {
            Route::get('/', [
                'uses' => 'LokasiController@negara',
                'as' => 'admin.show.negara'
            ]);

            Route::post('store',[
                'uses' => 'LokasiController@store_negara',
                'as' => 'admin.show.negara.store'
            ]);

            Route::put('update',[
                'uses' => 'LokasiController@update_negara',
                'as' => 'admin.show.negara.update'
            ]);

        });

        Route::group(['prefix' => 'provinsi'], function () {
            Route::get('/', [
                'uses' => 'LokasiController@provinsi',
                'as' => 'admin.show.provinsi'
            ]);

            Route::post('store',[
                'uses' => 'LokasiController@store_provinsi',
                'as' => 'admin.show.provinsi.store'
            ]);

            Route::put('update',[
                'uses' => 'LokasiController@update_provinsi',
                'as' => 'admin.show.provinsi.update'
            ]);

        });
    });

    Route::group(['prefix' => 'api'], function () {
        Route::get('profile', [
            'uses' => 'AdminController@editProfile',
            'as' => 'admin.edit.profile'
        ]);
    });


});
