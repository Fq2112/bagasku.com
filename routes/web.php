<?php

Route::group(['prefix' => '/', 'namespace' => 'Pages'], function () {

    Route::get('/', [
        'uses' => 'MainController@index',
        'as' => 'beranda'
    ]);

    Route::group(['prefix' => 'cari'], function () {

        Route::get('/', [
            'uses' => 'CariController@cariData',
            'as' => 'cari.data'
        ]);

        Route::get('data', [
            'uses' => 'CariController@getCariData',
            'as' => 'get.cari.data'
        ]);

    });

    Route::group(['namespace' => 'Users', 'prefix' => 'profil/{username}'], function () {

        Route::get('/', [
            'uses' => 'UserController@profilUser',
            'as' => 'profil.user'
        ]);

        Route::post('hire-me', [
            'middleware' => ['auth', 'user', 'user.bio'],
            'uses' => 'UserController@userHireMe',
            'as' => 'user.hire-me'
        ]);

        Route::post('invite-to-bid', [
            'middleware' => ['auth', 'user', 'user.bio'],
            'uses' => 'UserController@userInviteToBid',
            'as' => 'user.invite-to-bid'
        ]);

    });

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
            'uses' => 'DashboardController@dashboard',
            'as' => 'user.dashboard'
        ]);

        Route::get('proyek', [
            'uses' => 'DashboardController@proyek',
            'as' => 'user.proyek'
        ]);

        Route::get('layanan', [
            'uses' => 'DashboardController@layanan',
            'as' => 'user.layanan'
        ]);

        Route::get('pengaturan', [
            'uses' => 'AkunController@pengaturan',
            'as' => 'user.pengaturan'
        ]);

        Route::put('pengaturan/update', [
            'uses' => 'AkunController@updatePengaturan',
            'as' => 'user.update.pengaturan'
        ]);

        Route::group(['prefix' => 'profil'], function () {

            Route::get('/', [
                'uses' => 'AkunController@profil',
                'as' => 'user.profil'
            ]);

            Route::put('update', [
                'uses' => 'AkunController@updateProfil',
                'as' => 'user.update.profil'
            ]);

            Route::group(['prefix' => 'portofolio'], function () {

                Route::post('tambah', [
                    'uses' => 'AkunController@tambahPortofolio',
                    'as' => 'tambah.portofolio'
                ]);

                Route::put('update', [
                    'uses' => 'AkunController@updatePortofolio',
                    'as' => 'update.portofolio'
                ]);

                Route::get('hapus/{id}', [
                    'uses' => 'AkunController@hapusPortofolio',
                    'as' => 'hapus.portofolio'
                ]);

            });

            Route::group(['prefix' => 'bahasa'], function () {

                Route::post('tambah', [
                    'uses' => 'AkunController@tambahBahasa',
                    'as' => 'tambah.bahasa'
                ]);

                Route::put('update', [
                    'uses' => 'AkunController@updateBahasa',
                    'as' => 'update.bahasa'
                ]);

                Route::get('hapus/{id}', [
                    'uses' => 'AkunController@hapusBahasa',
                    'as' => 'hapus.bahasa'
                ]);

            });

            Route::group(['prefix' => 'skill'], function () {

                Route::post('tambah', [
                    'uses' => 'AkunController@tambahSkill',
                    'as' => 'tambah.skill'
                ]);

                Route::put('update', [
                    'uses' => 'AkunController@updateSkill',
                    'as' => 'update.skill'
                ]);

                Route::get('hapus/{id}', [
                    'uses' => 'AkunController@hapusSkill',
                    'as' => 'hapus.skill'
                ]);

            });

        });

    });

});
