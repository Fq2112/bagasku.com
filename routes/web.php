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

    Route::get('profil/{username}', [
        'uses' => 'MainController@profilUser',
        'as' => 'profil.user'
    ]);

    Route::get('proyek/{username}/{judul}', [
        'uses' => 'MainController@detailProyek',
        'as' => 'detail.proyek'
    ]);

    Route::get('layanan/{username}/{judul}', [
        'uses' => 'MainController@detailLayanan',
        'as' => 'detail.layanan'
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

Route::group(['prefix' => 'akun'], function () {

    Route::get('cek/{username}', [
        'uses' => 'Auth\RegisterController@cekUsername',
        'as' => 'cek.username'
    ]);

    Route::post('masuk', [
        'uses' => 'Auth\LoginController@login',
        'as' => 'login'
    ]);

    Route::post('keluar', [
        'uses' => 'Auth\LoginController@logout',
        'as' => 'logout'
    ]);

    Route::group(['namespace' => 'Pages\Users', 'middleware' => ['auth','user']], function () {

        Route::get('dashboard', [
            'uses' => 'UserController@dashboard',
            'as' => 'user.dashboard'
        ]);

        Route::get('pengaturan', [
            'uses' => 'UserController@pengaturan',
            'as' => 'user.pengaturan'
        ]);

        Route::put('pengaturan/update', [
            'uses' => 'UserController@updatePengaturan',
            'as' => 'user.update.pengaturan'
        ]);

        Route::group(['prefix' => 'profil'], function () {

            Route::get('/', [
                'uses' => 'UserController@profil',
                'as' => 'user.profil'
            ]);

            Route::put('update', [
                'uses' => 'UserController@updateProfil',
                'as' => 'user.update.profil'
            ]);

            Route::group(['prefix' => 'portofolio'], function () {

                Route::post('tambah', [
                    'uses' => 'UserController@tambahPortofolio',
                    'as' => 'tambah.portofolio'
                ]);

                Route::put('update', [
                    'uses' => 'UserController@updatePortofolio',
                    'as' => 'update.portofolio'
                ]);

                Route::get('hapus/{id}', [
                    'uses' => 'UserController@hapusPortofolio',
                    'as' => 'hapus.portofolio'
                ]);

            });

            Route::group(['prefix' => 'bahasa'], function () {

                Route::post('tambah', [
                    'uses' => 'UserController@tambahBahasa',
                    'as' => 'tambah.bahasa'
                ]);

                Route::put('update', [
                    'uses' => 'UserController@updateBahasa',
                    'as' => 'update.bahasa'
                ]);

                Route::get('hapus/{id}', [
                    'uses' => 'UserController@hapusBahasa',
                    'as' => 'hapus.bahasa'
                ]);

            });

            Route::group(['prefix' => 'skill'], function () {

                Route::post('tambah', [
                    'uses' => 'UserController@tambahSkill',
                    'as' => 'tambah.skill'
                ]);

                Route::put('update', [
                    'uses' => 'UserController@updateSkill',
                    'as' => 'update.skill'
                ]);

                Route::get('hapus/{id}', [
                    'uses' => 'UserController@hapusSkill',
                    'as' => 'hapus.skill'
                ]);

            });

        });

    });

});

Route::group(['namespace' => 'Pages\Admins', 'prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::get('/', [
        'uses' => 'AdminController@index',
        'as' => 'admin.dashboard'
    ]);

});
