<?php

Route::group(['namespace' => 'Pages\Admins', 'prefix' => 'sys-admin', 'middleware' => ['auth', 'admin']], function () {

    Route::get('dashboard', [
        'uses' => 'AdminController@index',
        'as' => 'admin.dashboard'
    ]);

    Route::group(['prefix' => 'account'], function () {

        Route::get('admin/show', [
            'uses' => 'AdminController@admin',
            'as' => 'admin.show.admin'
        ]);

        Route::get('user/show', [
            'uses' => 'AdminController@other',
            'as' => 'admin.show.user'
        ]);

        Route::get('user/show/{username}', [
            'uses' => 'AdminController@other_detail',
            'as' => 'admin.show.user.detail'
        ]);

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

    Route::group(['prefix' => 'kategori'], function () {
        Route::get('show', [
            'uses' => 'KategoriSubController@index',
            'as' => 'admin.show.kategori'
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

            Route::post('update',[
                'uses' => 'LokasiController@update_negara',
                'as' => 'admin.show.negara.update'
            ]);

            Route::post('{id}/delete', [
                'uses' => 'LokasiController@negaradelete',
                'as' => 'admin.show.negara.delete'
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

            Route::post('update',[
                'uses' => 'LokasiController@update_provinsi',
                'as' => 'admin.show.provinsi.update'
            ]);

            Route::post('{id}/delete', [
                'uses' => 'LokasiController@provinsidelete',
                'as' => 'admin.show.provinsi.delete'
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
