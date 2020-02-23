@section('title', 'Sunting Profil: '.$user->name.' | '.env('APP_TITLE'))
@push('styles')
    <link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.css')}}">
    <style>
        [data-scrollbar] {
            max-height: 350px;
        }
    </style>
@endpush
@extends('layouts.auth.mst_user')
@section('inner-content')
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 text-center" data-aos="fade-down">
            <!-- foto profil -->
            <div class="row">
                <div class="col-lg-12">
                    @include('layouts.auth.partials._form-foto-user')
                </div>
            </div>
            <!-- bahasa -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form class="form-horizontal" role="form" method="POST" id="form-lang"
                              action="{{route('tambah.bahasa')}}">
                            @csrf
                            <input type="hidden" name="_method">
                            <div class="card-content">
                                <div class="card-title">
                                    <small id="show_lang_settings">Bahasa
                                        <span class="pull-right" style="cursor: pointer; color: #122752">
                                            <i class="fa fa-language"></i>&ensp;Tambah</span>
                                    </small>
                                    <hr class="mt-0">
                                    <div id="stats_lang" style="font-size: 14px; margin-top: 0">
                                        @if(count($bahasa) == 0)
                                            <p>Kemampuan berbahasa Anda, baik bahasa daerah maupun bahasa asing.<br><br>
                                            </p>
                                        @else
                                            <div data-scrollbar>
                                                @foreach($bahasa as $row)
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="media">
                                                                <div class="media-left media-middle">
                                                                    <img width="64" class="media-object"
                                                                         src="{{asset('images/lang.png')}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <p class="media-heading">
                                                                        <i class="fa fa-language"></i>&nbsp;
                                                                        <small
                                                                            style="text-transform: uppercase">{{$row->nama}}</small>
                                                                        <span class="pull-right">
                                                                                <a style="color: #122752;cursor: pointer;"
                                                                                   onclick="suntingBahasa('{{$row->id}}',
                                                                                       '{{$row->nama}}','{{$row->tingkatan}}')">
                                                                                   SUNTING&ensp;<i
                                                                                        class="fa fa-edit"></i></a>
                                                                                <small style="color: #7f7f7f">&nbsp;&#124;&nbsp;</small>
                                                                                <a href="{{route('hapus.bahasa',
                                                                                ['id' => encrypt($row->id)])}}"
                                                                                   class="delete-data"
                                                                                   style="color: #122752;">
                                                                                    <i class="fa fa-eraser"></i>&ensp;HAPUS
                                                                                </a>
                                                                            </span>
                                                                    </p>
                                                                    <blockquote
                                                                        style="font-size: 12px;text-transform: none">
                                                                        <table style="font-size: 12px;margin-top: 0">
                                                                            <tr data-toggle="tooltip" title="Tingkatan">
                                                                                <td>
                                                                                    <i class="fa fa-chart-line"></i>
                                                                                </td>
                                                                                <td>&nbsp;</td>
                                                                                <td align="justify">
                                                                                    {{ucfirst($row->tingkatan)}}
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </blockquote>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div id="lang_settings" style="display: none">
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="nama_bahasa">Bahasa <span
                                                        class="required">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-language"></i></span>
                                                    <input class="form-control" type="text" placeholder="Nama bahasa"
                                                           name="nama" maxlength="100" id="nama_bahasa" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="tingkatan_bahasa">Tingkatan <span
                                                        class="required">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-chart-line"></i></span>
                                                    <select class="form-control" id="tingkatan_bahasa" name="tingkatan"
                                                            required>
                                                        <option></option>
                                                        <option value="dasar">Dasar</option>
                                                        <option value="percakapan">Percakapan</option>
                                                        <option value="lancar">Lancar</option>
                                                        <option value="asli">Asli (Native)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group" id="btn_cancel_lang">
                                            <div class="col-lg-12">
                                                <input type="reset" value="CANCEL" class="btn btn-default">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-read-more">
                                <button id="btn_save_lang" class="btn btn-link btn-block" disabled>
                                    <i class="fa fa-language"></i>&nbsp;SIMPAN PERUBAHAN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- skill -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form class="form-horizontal" role="form" method="POST" id="form-skill"
                              action="{{route('tambah.skill')}}">
                            @csrf
                            <input type="hidden" name="_method">
                            <div class="card-content">
                                <div class="card-title">
                                    <small id="show_skill_settings">Skill
                                        <span class="pull-right" style="cursor: pointer; color: #122752">
                                                    <i class="fa fa-user-secret"></i>&ensp;Tambah
                                                </span>
                                    </small>
                                    <hr class="mt-0">
                                    <div id="stats_skill"
                                         style="font-size: 14px; margin-top: 0">
                                        @if(count($skill) == 0)
                                            <p align="justify">Hal-hal yang Anda kuasai, misalnya Analisis Data,
                                                Akuntansi, Pengembangan Aplikasi, Manajemen Waktu, Kreativitas, dll.</p>
                                        @else
                                            <div data-scrollbar>
                                                @foreach($skill as $row)
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="media">
                                                                <div class="media-left media-middle">
                                                                    <img width="64" class="media-object"
                                                                         src="{{asset('images/skill.png')}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <p class="media-heading">
                                                                        <i class="fa fa-user-secret"></i>&nbsp;
                                                                        <small
                                                                            style="text-transform: uppercase">{{$row->nama}}</small>
                                                                        <span class="pull-right">
                                                                                <a style="color: #122752;cursor: pointer;"
                                                                                   onclick="suntingSkill('{{$row->id}}',
                                                                                       '{{$row->nama}}','{{$row->tingkatan}}')">
                                                                                    SUNTING&ensp;<i
                                                                                        class="fa fa-edit"></i></a>
                                                                                <small style="color: #7f7f7f">&nbsp;&#124;&nbsp;</small>
                                                                                <a href="{{route('hapus.skill', ['id' => encrypt($row->id)])}}"
                                                                                   class="delete-data"
                                                                                   style="color: #122752;">
                                                                                    <i class="fa fa-eraser"></i>&ensp;HAPUS</a>
                                                                            </span>
                                                                    </p>
                                                                    <blockquote
                                                                        style="font-size: 12px;text-transform: none">
                                                                        <table style="font-size: 12px;margin-top: 0">
                                                                            <tr>
                                                                                <td>
                                                                                    <i class="fa fa-chart-line"></i>
                                                                                </td>
                                                                                <td>&nbsp;</td>
                                                                                <td align="justify">
                                                                                    {{ucfirst($row->tingkatan)}}
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </blockquote>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div id="skill_settings" style="display: none">
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="nama_skill">Skill <span
                                                        class="required">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-user-secret"></i></span>
                                                    <input class="form-control" type="text" placeholder="Nama skill"
                                                           name="nama" maxlength="100" id="nama_skill" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="tingkatan_skill">Tingkatan <span
                                                        class="required">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-chart-line"></i></span>
                                                    <select class="form-control" id="tingkatan_skill" name="tingkatan"
                                                            required>
                                                        <option></option>
                                                        <option value="pemula">Pemula</option>
                                                        <option value="menengah">Menengah</option>
                                                        <option value="ahli">Ahli</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group" id="btn_cancel_skill">
                                            <div class="col-lg-12">
                                                <input type="reset" value="CANCEL" class="btn btn-default">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-read-more">
                                <button id="btn_save_skill"
                                        class="btn btn-link btn-block" disabled>
                                    <i class="fa fa-user-secret"></i>&nbsp;SIMPAN PERUBAHAN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12" data-aos="fade-down">
            <!-- latar belakang -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" method="POST" id="form-background" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('put') }}
                            <div class="img-card image-upload">
                                <label for="input-background">
                                    <img style="width: 100%" class="show_background" alt="Background"
                                         src="{{$user->get_bio->latar_belakang != null ?
                                         asset('storage/users/latar_belakang/'.$user->get_bio->latar_belakang) :
                                         asset('images/slider/beranda-proyek.jpg')}}" data-toggle="tooltip"
                                         title="Klik disini untuk mengubah gambar latar belakang Anda!">
                                </label>
                                <input id="input-background" name="latar_belakang" type="file" accept="image/*">
                                <div id="progress-upload">
                                    <div class="progress-bar progress-bar-info progress-bar-striped active"
                                         role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                         style="background-color: #122752;z-index: 20">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-content">
                            <div class="card-title">
                                <small id="show_background_settings">
                                    Latar Belakang
                                    <span class="pull-right"
                                          style="cursor: pointer; color: #122752"><i class="fa fa-edit"></i>&nbsp;SUNTING</span>
                                </small>
                                <hr class="mt-0">
                                <blockquote style="text-transform: none">
                                    <table style="font-size: 14px; margin-top: 0">
                                        <tr>
                                            <td><i class="fa fa-image"></i></td>
                                            <td id="show_background_name">
                                                &nbsp;{{$user->get_bio->latar_belakang != "" ? $user->get_bio->latar_belakang : '(kosong)'}}
                                            </td>
                                        </tr>
                                    </table>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- personal & kontak -->
            <div class="row">
                <!-- personal -->
                <div class="col-lg-6">
                    <div class="card">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{route('user.update.profil')}}">
                            @csrf
                            {{ method_field('put') }}
                            <input type="hidden" name="check_form" value="personal">
                            <div class="card-content">
                                <div class="card-title">
                                    <small id="show_personal_data_settings">Personal
                                        <span class="pull-right" style="cursor: pointer; color: #122752">
                                            <i class="fa fa-edit"></i>&nbsp;SUNTING</span>
                                    </small>
                                    <hr class="mt-0">
                                    <table style="font-size: 14px; margin-top: 0" id="stats_personal_data">
                                        <tr>
                                            <td><i class="fa fa-id-card"></i></td>
                                            <td>&nbsp;</td>
                                            <td>{{$user->name}}</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-birthday-cake"></i></td>
                                            <td>&nbsp;</td>
                                            <td>
                                                {{$user->get_bio->tgl_lahir == "" ? 'Tanggal lahir (-)' :
                                                \Carbon\Carbon::parse($user->get_bio->tgl_lahir)->format('j F Y')}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-transgender"></i></td>
                                            <td>&nbsp;</td>
                                            <td>{{$user->get_bio->jenis_kelamin != "" ? $user->get_bio->jenis_kelamin : 'Jenis kelamin (-)'}}</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-flag"></i></td>
                                            <td>&nbsp;</td>
                                            <td>{{$user->get_bio->kewarganegaraan != "" ? $user->get_bio->kewarganegaraan : 'Kewarganegaraan (-)'}}</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-globe"></i></td>
                                            <td>&nbsp;</td>
                                            <td style="text-transform: none">
                                                {{$user->get_bio->website != "" ? $user->get_bio->website : 'Website (-)'}}
                                            </td>
                                        </tr>
                                    </table>

                                    <div id="personal_data_settings" style="display: none">
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="name">Nama Lengkap <span
                                                        class="required">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                                    <input id="name" type="text" class="form-control" name="name"
                                                           placeholder="Nama lengkap" value="{{$user->name}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="tgl_lahir">Tanggal Lahir <span
                                                        class="required">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-birthday-cake"></i>
                                                    </span>
                                                    <input id="tgl_lahir" class="form-control datepicker"
                                                           name="tgl_lahir" type="text" placeholder="yyyy-mm-dd"
                                                           value="{{$user->get_bio->tgl_lahir}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="jenis_kelamin">Jenis Kelamin
                                                    <span class="required">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-transgender"></i></span>
                                                    <select id="jenis_kelamin" class="form-control" name="jenis_kelamin"
                                                            required>
                                                        <option></option>
                                                        <option value="pria" {{$user->get_bio->jenis_kelamin ==
                                                        "pria" ? 'selected' : ''}}>Pria
                                                        </option>
                                                        <option value="wanita" {{$user->get_bio->jenis_kelamin ==
                                                        "wanita" ? 'selected' : ''}}>Wanita
                                                        </option>
                                                        <option value="lainnya"{{$user->get_bio->jenis_kelamin ==
                                                        "lainnya" ? 'selected' : ''}}>Lainnya
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="kewarganegaraan">Kewarganegaraan</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                                                    <select id="kewarganegaraan" class="form-control" name="kewarganegaraan">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="website">Website</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                                    <input id="website" placeholder="http://example.com" type="text"
                                                           class="form-control" name="website" maxlength="191"
                                                           value="{{$user->get_bio->website}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-read-more">
                                <button id="btn_save_personal_data" class="btn btn-link btn-block" disabled>
                                    <i class="fa fa-user"></i>&nbsp;SIMPAN PERUBAHAN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- kontak -->
                <div class="col-lg-6">
                    <div class="card">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{route('user.update.profil')}}">
                            @csrf
                            {{ method_field('put') }}
                            <input type="hidden" name="check_form" value="kontak">
                            <div class="card-content">
                                <div class="card-title">
                                    <small id="show_contact_settings">Kontak
                                        <span class="pull-right" style="cursor: pointer; color: #122752">
                                            <i class="fa fa-edit"></i>&nbsp;SUNTING</span>
                                    </small>
                                    <hr class="mt-0">
                                    <table style="font-size: 14px; margin-top: 0" id="stats_contact">
                                        <tr>
                                            <td><i class="fa fa-envelope"></i></td>
                                            <td>&nbsp;</td>
                                            <td style="text-transform: none">{{$user->email}}</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-phone"></i></td>
                                            <td>&nbsp;</td>
                                            <td>{{$user->get_bio->hp != "" ? $user->get_bio->hp : 'No. HP/Telp. (-)'}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-map-marked-alt"></i></td>
                                            <td>&nbsp;</td>
                                            <td>{{$user->get_bio->kota_id != "" ? $user->get_bio->get_kota->nama.', '.
                                            $user->get_bio->get_kota->get_provinsi->nama : 'Kabupaten/Kota (-)'}}</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-home"></i></td>
                                            <td>&nbsp;</td>
                                            <td>{{$user->get_bio->alamat != "" ? $user->get_bio->alamat : 'Alamat (-)'}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-address-card"></i></td>
                                            <td>&nbsp;</td>
                                            <td>{{$user->get_bio->kode_pos != "" ? $user->get_bio->kode_pos :
                                                    'Kode pos (-)'}}</td>
                                        </tr>
                                    </table>

                                    <div id="contact_settings" style="display: none">
                                        <div class="row form-group has-feedback">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="email">Email Utama
                                                    (terverifikasi)</label>
                                                <input id="email" value="{{$user->email}}" type="email"
                                                       class="form-control" disabled>
                                                <span class="glyphicon glyphicon-check form-control-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="hp">No. HP/Telp. <span
                                                        class="required">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                    <input id="hp" placeholder="08123xxxxxxx" type="text" maxlength="13"
                                                           class="form-control" name="hp" value="{{$user->get_bio->hp}}"
                                                           onkeypress="return numberOnly(event, false)" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="kota_id">Kabupaten/Kota
                                                    <span class="required">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-map-marked-alt"></i></span>
                                                    <select id="kota_id" class="form-control" name="kota_id"
                                                            required>
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="alamat">Alamat <span
                                                        class="required">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                                    <textarea id="alamat" style="resize:vertical" name="alamat"
                                                              placeholder="Alamat lengkap" class="form-control"
                                                              required>{{$user->get_bio->alamat}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="kode_pos">Kode Pos</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-address-card"></i></span>
                                                    <input id="kode_pos" placeholder="612xx" type="text"
                                                           class="form-control" name="zip_code" maxlength="5"
                                                           onkeypress="return numberOnly(event, false)"
                                                           value="{{$user->get_bio->kode_pos}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-read-more">
                                <button id="btn_save_contact" class="btn btn-link btn-block" disabled>
                                    <i class="fa fa-address-book"></i>&nbsp;SIMPAN PERUBAHAN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- summary -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{route('user.update.profil')}}">
                            @csrf
                            {{ method_field('put') }}
                            <input type="hidden" name="check_form" value="summary">
                            <div class="card-content">
                                <div class="card-title">
                                    <small id="show_summary_settings">Summary
                                        <span class="pull-right" style="cursor: pointer; color: #122752">
                                            <i class="fa fa-edit"></i>&nbsp;SUNTING</span>
                                    </small>
                                    <hr class="mt-0">
                                    <blockquote id="stats_summary" data-scrollbar>
                                        {!!$user->get_bio->summary != "" ? $user->get_bio->summary :
                                        '<p align="justify">Sebuah <em>summary</em> atau ringkasan resume adalah '.
                                        'pengantar singkat dan tajam yang meng-<em>highlight</em> skill Anda. '.
                                        'Raihlah perhatian klien Anda sebanyak mungkin!</p>'!!}
                                    </blockquote>

                                    <div id="summary_settings" style="display: none">
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <textarea id="summary" name="summary" class="form-control"
                                                          placeholder="Tulis summary Anda disini&hellip;">{{$user->get_bio->summary}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-read-more">
                                <button id="btn_save_summary"
                                        class="btn btn-link btn-block" disabled>
                                    <i class="fa fa-comment-dots"></i>&nbsp;SIMPAN PERUBAHAN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    @include('layouts.auth.partials._scripts')
    <script src="{{asset('vendor/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        var kota = [
                @foreach($provinsi as $prov)
            {
                id: '{{$prov->id}}',
                text: '{{$prov->nama}}',
                children: [
                    @foreach($prov->get_kota as $kota)
                    {
                        id: '{{$kota->id}}',
                        text: '{{$kota->nama}}'
                    },
                    @endforeach
                ]
            },
                @endforeach
        ];

        var negara = [
                @foreach($negara as $row)
            {
                id: '{{$row->id}}',
                text: '{{$row->nama}}'
            },
            @endforeach
        ];

        $(function () {
            $("#kewarganegaraan").select2({
                data: negara,
                placeholder: "-- Pilih --",
                allowClear: true,
                width: '100%',
            });

            $("#kota_id").select2({
                data: kota,
                placeholder: "-- Pilih --",
                allowClear: true,
                width: '100%',
            });
        });

        $("#kota_id").val();

        document.getElementById("input-background").onchange = function () {
            var files_size = this.files[0].size,
                max_file_size = 2000000, allowed_file_types = ['image/png', 'image/gif', 'image/jpeg', 'image/pjpeg'],
                file_name = $(this).val().replace(/C:\\fakepath\\/i, ''),
                progress_bar_id = $("#progress-upload .progress-bar");

            if (!window.File && window.FileReader && window.FileList && window.Blob) {
                swal('PERHATIAN!', "Browser yang Anda gunakan tidak support! Silahkan perbarui atau gunakan browser yang lainnya.", 'warning');

            } else {
                if (files_size > max_file_size) {
                    swal('ERROR!', "Ukuran total " + file_name + " adalah " + humanFileSize(files_size) +
                        ", ukuran file yang diperbolehkan adalah " + humanFileSize(max_file_size) +
                        ", coba unggah file yang ukurannya lebih kecil!", 'error');

                } else {
                    $(this.files).each(function (i, ifile) {
                        if (ifile.value !== "") {
                            if (allowed_file_types.indexOf(ifile.type) === -1) {
                                swal('ERROR!', "Tipe file " + file_name + " tidak support!", 'error');

                            } else {
                                $.ajax({
                                    type: 'POST',
                                    url: '{{route('user.update.profil')}}',
                                    data: new FormData($("#form-background")[0]),
                                    contentType: false,
                                    processData: false,
                                    mimeType: "multipart/form-data",
                                    xhr: function () {
                                        var xhr = $.ajaxSettings.xhr();
                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function (event) {
                                                var percent = 0;
                                                var position = event.loaded || event.position;
                                                var total = event.total;
                                                if (event.lengthComputable) {
                                                    percent = Math.ceil(position / total * 100);
                                                }
                                                //update progressbar
                                                $("#progress-upload").css("display", "block");
                                                progress_bar_id.css("width", +percent + "%");
                                                progress_bar_id.text(percent + "%");
                                                if (percent == 100) {
                                                    progress_bar_id.removeClass("progress-bar-info");
                                                    progress_bar_id.addClass("progress-bar");
                                                } else {
                                                    progress_bar_id.removeClass("progress-bar");
                                                    progress_bar_id.addClass("progress-bar-info");
                                                }
                                            }, true);
                                        }
                                        return xhr;
                                    },
                                    success: function (data) {
                                        var url = 'url("{{asset('storage/users/latar_belakang')}}/' + data + '")';
                                        $(".show_background").css('background-image', url);
                                        $("#show_background_name").html("&nbsp;" + data);

                                        swal('SUKSES!', 'Latar belakang profil Anda berhasil diperbarui!', 'success');
                                        $("#progress-upload").css("display", "none");
                                    },
                                    error: function () {
                                        swal('Oops...', 'Terjadi suatu kesalahan!  Silahkan segarkan browser Anda.', 'error');
                                    }
                                });
                                return false;
                            }
                        } else {
                            swal('Oops...', 'Tidak ada file yang dipilih!', 'error');
                        }
                    });
                }
            }
        };
    </script>
@endpush
