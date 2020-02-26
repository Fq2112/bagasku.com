@extends('layouts.mst')
@section('title', 'Sunting Profil: '.$user->name.' | '.env('APP_TITLE'))
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/card.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui/jquery-ui.min.css')}}">
    <style>
        blockquote {
            background: unset;
            border-color: unset;
            color: unset;
        }

        .has-feedback .form-control-feedback {
            width: 36px;
            height: 36px;
            line-height: 36px;
        }

        .image-upload > input {
            display: none;
        }

        .image-upload label {
            cursor: pointer;
            width: 100%;
        }

        .note-placeholder {
            text-transform: none;
        }

        [data-scrollbar] {
            max-height: 350px;
        }
    </style>
@endpush
@section('content')
    <section class="none-margin" style="padding: 40px 0 40px 0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                    <!-- foto profil -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <form class="form-horizontal" role="form" method="POST" id="form-ava"
                                      enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('put') }}
                                    <div class="img-card image-upload">
                                        <label for="file-input">
                                            <img style="width: 100%" class="show_ava" alt="Avatar" src="{{$user->get_bio->foto
                                            == "" ? asset('images/faces/thumbs50x50/'.rand(1,6).'.jpg') :
                                            asset('storage/users/foto/'.$user->get_bio->foto)}}" data-placement="bottom"
                                                 data-toggle="tooltip" title="Klik disini untuk mengubah foto Anda!">
                                        </label>
                                        <input id="file-input" name="foto" type="file" accept="image/*">
                                        <div id="progress-upload">
                                            <div class="progress-bar progress-bar-info progress-bar-striped active"
                                                 role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                 aria-valuemax="100" style="background-color: #122752;z-index: 20">
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="card-content">
                                    <div class="card-title text-center">
                                        <a href="{{route('user.profil')}}">
                                            <h4 class="aj_name" style="color: #122752">{{$user->name}}</h4></a>
                                        <small class="show_status" style="text-transform: none">{{$user->get_bio->status
                                        != "" ? $user->get_bio->status : 'Status (-)'}}</small>
                                    </div>
                                    <div class="card-title">
                                        <form id="form-status" class="form-horizontal" role="form" method="POST">
                                            @csrf
                                            {{method_field('PUT')}}
                                            <input type="hidden" name="check_form" value="status">
                                            <div id="show_status_settings" class="row"
                                                 style="color: #122752;cursor: pointer;font-size: 14px">
                                                <div class="col-md-12 text-right">
                                                    <i class="fa fa-edit mr-2"></i>UBAH STATUS
                                                </div>
                                            </div>
                                            <div id="status_settings" style="display: none">
                                                <div class="row form-group has-feedback">
                                                    <div class="col-md-12">
                                                        <input id="status" type="text" class="form-control"
                                                               name="status" value="{{$user->get_bio->status}}"
                                                               placeholder="Tulis status Anda disini&hellip;">
                                                        <span
                                                            class="glyphicon glyphicon-bullhorn form-control-feedback"></span>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <button id="btn_save_status"
                                                                class="btn btn-link btn-sm btn-block"
                                                                type="submit" style="border: 1px solid #ccc">
                                                            <i class="fa fa-bullhorn mr-2"></i>SIMPAN PERUBAHAN
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <a href="{{route('profil.user', ['username' => $user->username])}}"
                                           id="btn_mode_publik" class="btn btn-link btn-sm btn-block"
                                           style="border: 1px solid #ccc">Lihat Mode Publik</a>
                                        <hr style="margin: 10px 0">
                                        <table class="stats" style="font-size: 14px; margin-top: 0">
                                            <tr>
                                                <td><i class="fa fa-calendar-check"></i></td>
                                                <td>&nbsp;Bergabung Sejak</td>
                                                <td>
                                                    : {{$user->created_at->formatLocalized('%d %B %Y')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-clock"></i></td>
                                                <td>&nbsp;Update Terakhir</td>
                                                <td style="text-transform: none;">
                                                    : {{$user->updated_at->diffForHumans()}}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
                                    <input type="hidden" name="id">
                                    <div class="card-content">
                                        <div class="card-title">
                                            <small id="show_lang_settings">Bahasa
                                                <span class="pull-right" style="cursor: pointer; color: #122752">
                                            <i class="fa fa-language"></i>&ensp;Tambah</span>
                                            </small>
                                            <hr class="mt-0">
                                            <div id="stats_lang" style="font-size: 14px; margin-top: 0">
                                                @if(count($bahasa) == 0)
                                                    <p align="justify">Kemampuan berbahasa Anda, baik bahasa daerah
                                                        maupun bahasa asing.</p>
                                                @else
                                                    <div data-scrollbar>
                                                        @foreach($bahasa as $row)
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="media">
                                                                        <div class="media-left media-middle"
                                                                             style="width: 25%">
                                                                            <img class="media-object" alt="icon"
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
                                                                                <table
                                                                                    style="font-size: 12px;margin-top: 0">
                                                                                    <tr data-toggle="tooltip"
                                                                                        title="Tingkatan">
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
                                                            <input class="form-control" type="text"
                                                                   placeholder="Nama bahasa"
                                                                   name="nama" maxlength="100" id="nama_bahasa"
                                                                   required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label class="form-control-label" for="tingkatan_bahasa">Tingkatan
                                                            <span
                                                                class="required">*</span></label>
                                                        <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-chart-line"></i></span>
                                                            <select class="form-control" id="tingkatan_bahasa"
                                                                    name="tingkatan"
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
                                                        <button type="reset" class="btn btn-link"
                                                                style="border: 1px solid #ccc">CANCEL
                                                        </button>
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
                                    <input type="hidden" name="id">
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
                                                        Akuntansi, Pengembangan Aplikasi, Manajemen Waktu, Kreativitas,
                                                        dll.</p>
                                                @else
                                                    <div data-scrollbar>
                                                        @foreach($skill as $row)
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="media">
                                                                        <div class="media-left media-middle"
                                                                             style="width: 25%">
                                                                            <img class="media-object" alt="icon"
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
                                                                                <table
                                                                                    style="font-size: 12px;margin-top: 0">
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
                                                            <input class="form-control" type="text"
                                                                   placeholder="Nama skill"
                                                                   name="nama" maxlength="100" id="nama_skill" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label class="form-control-label" for="tingkatan_skill">Tingkatan
                                                            <span
                                                                class="required">*</span></label>
                                                        <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-chart-line"></i></span>
                                                            <select class="form-control" id="tingkatan_skill"
                                                                    name="tingkatan"
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
                                                        <button type="reset" class="btn btn-link"
                                                                style="border: 1px solid #ccc">CANCEL
                                                        </button>
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
                <div class="col-lg-8 col-md-6 col-sm-12">
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
                                        <div id="progress-upload2">
                                            <div class="progress-bar progress-bar-info progress-bar-striped active"
                                                 role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                 aria-valuemax="100"
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
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-id-card"></i></span>
                                                            <input id="name" type="text" class="form-control"
                                                                   name="name"
                                                                   placeholder="Nama lengkap" value="{{$user->name}}"
                                                                   required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label class="form-control-label" for="tgl_lahir">Tanggal Lahir
                                                            <span
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
                                                        <label class="form-control-label" for="jenis_kelamin">Jenis
                                                            Kelamin
                                                            <span class="required">*</span></label>
                                                        <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-transgender"></i></span>
                                                            <select id="jenis_kelamin" class="form-control"
                                                                    name="jenis_kelamin"
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
                                                        <label class="form-control-label"
                                                               for="kewarganegaraan">Kewarganegaraan</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-flag"></i></span>
                                                            <select id="kewarganegaraan" class="form-control"
                                                                    name="kewarganegaraan">
                                                                <option></option>
                                                                @foreach($negara as $row)
                                                                    <option value="{{$row->nama}}" {{$user->get_bio
                                                            ->kewarganegaraan == $row->nama ? 'selected' : ''}}>{{$row->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label class="form-control-label" for="website">Website</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                                            <input id="website" placeholder="http://example.com"
                                                                   type="text"
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
                                                        <span
                                                            class="glyphicon glyphicon-check form-control-feedback"></span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label class="form-control-label" for="hp">No. HP/Telp. <span
                                                                class="required">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                            <input id="hp" placeholder="08123xxxxxxx" type="text"
                                                                   maxlength="13"
                                                                   class="form-control" name="hp"
                                                                   value="{{$user->get_bio->hp}}"
                                                                   onkeypress="return numberOnly(event, false)"
                                                                   required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label class="form-control-label" for="kota_id">Kabupaten/Kota
                                                            <span class="required">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-map-marked-alt"></i></span>
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
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-home"></i></span>
                                                            <textarea id="alamat" style="resize:vertical" name="alamat"
                                                                      placeholder="Alamat lengkap" class="form-control"
                                                                      required>{{$user->get_bio->alamat}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label class="form-control-label" for="kode_pos">Kode
                                                            Pos</label>
                                                        <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-address-card"></i></span>
                                                            <input id="kode_pos" placeholder="612xx" type="text"
                                                                   class="form-control" name="kode_pos" maxlength="5"
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
                                                <textarea id="summary" name="summary"
                                                          class="form-control">{{$user->get_bio->summary}}</textarea>
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
                    <!-- portofolio -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <form class="form-horizontal" role="form" method="POST" id="form-portofolio"
                                      action="{{route('tambah.portofolio')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_method">
                                    <input type="hidden" name="id">
                                    <div class="card-content">
                                        <div class="card-title">
                                            <small id="show_portofolio_settings">Portofolio
                                                <span class="pull-right" style="cursor: pointer; color: #122752">
                                                    <i class="fa fa-briefcase"></i>&ensp;Tambah
                                                </span>
                                            </small>
                                            <hr class="mt-0">
                                            <div id="stats_portofolio"
                                                 style="font-size: 14px; margin-top: 0">
                                                @if(count($portofolio) == 0)
                                                    <p align="justify">Hal-hal yang pernah Anda buat/kerjakan, misalnya
                                                        Desain Grafis, Aplikasi Desktop/Web/Mobile, 2D/3D Modeling, dll.
                                                    </p>
                                                @else
                                                    <div data-scrollbar>
                                                        @foreach($portofolio as $row)
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="media">
                                                                        <div class="media-left media-middle"
                                                                             style="width: 25%">
                                                                            <img class="media-object" alt="icon"
                                                                                 src="{{asset('storage/users/portofolio/'.$row->foto)}}">
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <p class="media-heading">
                                                                                <i class="fa fa-briefcase"></i>&nbsp;
                                                                                <small
                                                                                    style="text-transform: uppercase">{{$row->judul}}
                                                                                    <sub>{{$row->tahun}}</sub>
                                                                                </small>
                                                                                <span class="pull-right">
                                                                                <a style="color: #122752;cursor: pointer;"
                                                                                   onclick="suntingPortofolio('{{$row->id}}',
                                                                                       '{{$row->foto}}','{{$row->judul}}',
                                                                                       '{{$row->deskripsi}}','{{$row->tahun}}',
                                                                                       '{{$row->tautan}}')">SUNTING&ensp;<i
                                                                                        class="fa fa-edit"></i></a>
                                                                                <small style="color: #7f7f7f">&nbsp;&#124;&nbsp;</small>
                                                                                <a href="{{route('hapus.portofolio',
                                                                                ['id' => encrypt($row->id)])}}"
                                                                                   class="delete-data"
                                                                                   style="color: #122752;">
                                                                                    <i class="fa fa-eraser"></i>&ensp;HAPUS</a>
                                                                            </span>
                                                                            </p>
                                                                            <blockquote
                                                                                style="font-size: 12px;text-transform: none">
                                                                                <p align="justify">{{$row->deskripsi}}</p>
                                                                                @if($row->tautan != "")
                                                                                    <hr style="margin: 0 0 10px 0">
                                                                                    Tautan:
                                                                                    <a href="{{$row->tautan}}"
                                                                                       target="_blank">{{$row->tautan}}
                                                                                    </a>
                                                                                @endif
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

                                            <div id="portofolio_settings" style="display: none">
                                                <div class="row form-group has-feedback">
                                                    <div class="col-md-12">
                                                        <label for="txt_attach" class="form-control-label">Foto <span
                                                                class="required">*</span></label>
                                                        <input type="file" name="foto" accept="image/*"
                                                               id="attach-files" style="display: none;">
                                                        <div class="input-group">
                                                            <input type="text" id="txt_attach" style="cursor: pointer"
                                                                   class="browse_files form-control" readonly
                                                                   placeholder="Unggah foto disini..."
                                                                   data-toggle="tooltip" data-placement="top"
                                                                   title="Ekstensi yang diizinkan: jpg, jpeg, gif, png. Ukuran yang diizinkan: < 5 MB">
                                                            <span class="input-group-btn">
                                                                <button
                                                                    class="browse_files btn btn-link btn-sm btn-block"
                                                                    type="button" style="border: 1px solid #ccc">
                                                                    <i class="fa fa-search"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group has-feedback">
                                                    <div class="col-md-12">
                                                        <label for="judul" class="form-control-label">Judul <span
                                                                class="required">*</span></label>
                                                        <input id="judul" type="text" name="judul" class="form-control"
                                                               placeholder="Judul" required>
                                                        <span
                                                            class="glyphicon glyphicon-text-width form-control-feedback"></span>
                                                    </div>
                                                </div>
                                                <div class="row form-group has-feedback">
                                                    <div class="col-md-12">
                                                        <label for="deskripsi" class="form-control-label">Deskripsi
                                                            <span
                                                                class="required">*</span></label>
                                                        <textarea id="deskripsi" name="deskripsi" class="form-control"
                                                                  placeholder="Tulis deskripsi singkatnya disini..."
                                                                  required></textarea>
                                                        <span
                                                            class="glyphicon glyphicon-text-height form-control-feedback"></span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-3 has-feedback">
                                                        <label for="tahun" class="form-control-label">Tahun <span
                                                                class="required">*</span></label>
                                                        <input id="tahun" class="form-control yearpicker" name="tahun"
                                                               type="text" placeholder="yyyy" required>
                                                        <span
                                                            class="glyphicon glyphicon-calendar form-control-feedback"></span>
                                                    </div>
                                                    <div class="col-md-9 has-feedback">
                                                        <label for="tautan" class="form-control-label">Tautan</label>
                                                        <input id="tautan" type="text" name="tautan"
                                                               class="form-control" placeholder="http://example.com">
                                                        <span
                                                            class="glyphicon glyphicon-globe form-control-feedback"></span>
                                                    </div>
                                                </div>
                                                <div class="row form-group" id="btn_cancel_portofolio">
                                                    <div class="col-lg-12">
                                                        <button type="reset" class="btn btn-link"
                                                                style="border: 1px solid #ccc">CANCEL
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-read-more">
                                        <button id="btn_save_portofolio" class="btn btn-link btn-block" disabled>
                                            <i class="fa fa-briefcase"></i>&nbsp;SIMPAN PERUBAHAN
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>
    <script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
    <script>
        $(function () {
            $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
            $('.yearpicker').datepicker({
                dateFormat: "yy",
                yearRange: "c-100:c",
                changeMonth: false,
                changeYear: true,
                showButtonPanel: false,
                closeText: 'Select',
                currentText: 'This year',
                onChangeMonthYear: function (dateText, inst) {
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).val($.datepicker.formatDate("yy", new Date(year, 0, 1)));
                    $(this).datepicker('hide');
                },
                beforeShow: function (input, inst) {
                    if ($(this).val() != '') {
                        var tmpyear = $(this).val();
                        $(this).datepicker('option', 'defaultDate', new Date(tmpyear, 0, 1));
                    }
                }
            }).focus(function () {
                $(".ui-datepicker-month").hide();
                $(".ui-datepicker-calendar").hide();
                $(".ui-datepicker-current").hide();
                $(".ui-datepicker-prev").hide();
                $(".ui-datepicker-next").hide();
                $("#ui-datepicker-div").position({
                    my: "left top",
                    at: "left bottom",
                    of: $(this)
                });
            });

            $("#jenis_kelamin, #tingkatan_bahasa, #tingkatan_skill, #kewarganegaraan").select2({
                placeholder: "-- Pilih --",
                allowClear: true,
                width: '100%',
            });

            $("#kota_id").select2({
                data: [
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
                ],
                placeholder: "-- Pilih --",
                allowClear: true,
                width: '100%',
            }).val('{{$user->get_bio->kota_id}}').trigger('change');

            $("#summary").summernote({
                placeholder: 'Tulis summary Anda disini...',
                tabsize: 2,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });

        $("#show_status_settings").on('click', function () {
            $("#status_settings").toggle(300);
            $("#btn_mode_publik").toggle(300);
        });

        $("#show_lang_settings, #btn_cancel_lang button").on('click', function () {
            $("#btn_cancel_lang").hide();
            $("#nama_bahasa").val(null);
            $("#tingkatan_bahasa").val(null).trigger('change');
            $("#lang_settings").toggle(300);
            $("#stats_lang").toggle(300);
            if ($("#btn_save_lang").attr('disabled')) {
                $("#btn_save_lang").removeAttr('disabled');
            } else {
                $("#btn_save_lang").attr('disabled', 'disabled');
            }
            $("#form-lang").attr('action', '{{route('tambah.bahasa')}}');
            $("#form-lang input[name='_method']").val('POST');
        });

        $("#show_skill_settings, #btn_cancel_skill button").on('click', function () {
            $("#btn_cancel_skill").hide();
            $("#nama_skill").val(null);
            $("#tingkatan_skill").val(null).trigger('change');
            $("#skill_settings").toggle(300);
            $("#stats_skill").toggle(300);
            if ($("#btn_save_skill").attr('disabled')) {
                $("#btn_save_skill").removeAttr('disabled');
            } else {
                $("#btn_save_skill").attr('disabled', 'disabled');
            }
            $("#form-skill").attr('action', '{{route('tambah.skill')}}');
            $("#form-skill input[name='_method']").val('POST');
        });

        $("#show_background_settings").on('click', function () {
            $("#input-background").trigger('click');
        });

        $("#show_personal_data_settings").on('click', function () {
            $("#personal_data_settings").toggle(300);
            $("#stats_personal_data").toggle(300);
            if ($("#btn_save_personal_data").attr('disabled')) {
                $("#btn_save_personal_data").removeAttr('disabled');
            } else {
                $("#btn_save_personal_data").attr('disabled', 'disabled');
            }
        });

        $("#show_contact_settings").on('click', function () {
            $("#contact_settings").toggle(300);
            $("#stats_contact").toggle(300);
            if ($("#btn_save_contact").attr('disabled')) {
                $("#btn_save_contact").removeAttr('disabled');
            } else {
                $("#btn_save_contact").attr('disabled', 'disabled');
            }
        });

        $("#show_summary_settings").on('click', function () {
            $("#summary_settings").toggle(300);
            $("#stats_summary").toggle(300);
            if ($("#btn_save_summary").attr('disabled')) {
                $("#btn_save_summary").removeAttr('disabled');
            } else {
                $("#btn_save_summary").attr('disabled', 'disabled');
            }
        });

        $("#show_portofolio_settings, #btn_cancel_portofolio button").on('click', function () {
            $("#btn_cancel_portofolio").hide();
            $("#txt_attach, #judul, #deskripsi, #tahun, #tautan").val(null);
            $("#txt_attach[data-toggle=tooltip]").attr('data-original-title',
                'Ekstensi yang diizinkan: jpg, jpeg, gif, png. Ukuran yang diizinkan: < 5 MB');
            $("#portofolio_settings").toggle(300);
            $("#stats_portofolio").toggle(300);
            if ($("#btn_save_portofolio").attr('disabled')) {
                $("#btn_save_portofolio").removeAttr('disabled');
            } else {
                $("#btn_save_portofolio").attr('disabled', 'disabled');
            }
            $("#form-portofolio").attr('action', '{{route('tambah.portofolio')}}');
            $("#form-portofolio input[name='_method']").val('POST');
        });

        $("#website").on("keyup", function () {
            var $uri = $(this).val().substr(0, 4) != 'http' ? 'http://' + $(this).val() : $(this).val();
            $(this).val($uri);
        });

        $("#tautan").on("keyup", function () {
            var $uri = $(this).val().substr(0, 4) != 'http' ? 'http://' + $(this).val() : $(this).val();
            $(this).val($uri);
        });

        function suntingBahasa(id, nama, tingkatan) {
            $("#form-lang").attr("action", "{{route('update.bahasa')}}");
            $("#form-lang input[name='_method']").val('PUT');
            $("#form-lang input[name='id']").val(id);
            $("#lang_settings").toggle(300);
            $("#stats_lang").toggle(300);
            if ($("#btn_save_lang").attr('disabled')) {
                $("#btn_save_lang").removeAttr('disabled');
            } else {
                $("#btn_save_lang").attr('disabled', 'disabled');
            }
            $("#btn_cancel_lang").show();

            $('#nama_bahasa').val(nama);
            $('#tingkatan_bahasa').val(tingkatan).trigger("change");
        }

        function suntingSkill(id, nama, tingkatan) {
            $("#form-skill").attr("action", "{{route('update.skill')}}");
            $("#form-skill input[name='_method']").val('PUT');
            $("#form-skill input[name='id']").val(id);
            $("#skill_settings").toggle(300);
            $("#stats_skill").toggle(300);
            if ($("#btn_save_skill").attr('disabled')) {
                $("#btn_save_skill").removeAttr('disabled');
            } else {
                $("#btn_save_skill").attr('disabled', 'disabled');
            }
            $("#btn_cancel_skill").show();

            $('#nama_skill').val(nama);
            $('#tingkatan_skill').val(tingkatan).trigger("change");
        }

        function suntingPortofolio(id, foto, judul, deskripsi, tahun, tautan) {
            $("#form-portofolio").attr("action", "{{route('update.portofolio')}}");
            $("#form-portofolio input[name='_method']").val('PUT');
            $("#form-portofolio input[name='id']").val(id);
            $("#portofolio_settings").toggle(300);
            $("#stats_portofolio").toggle(300);
            if ($("#btn_save_portofolio").attr('disabled')) {
                $("#btn_save_portofolio").removeAttr('disabled');
            } else {
                $("#btn_save_portofolio").attr('disabled', 'disabled');
            }
            $("#btn_cancel_portofolio").show();

            $("#txt_attach").val(foto);
            $('#judul').val(judul);
            $('#deskripsi').val(deskripsi);
            $('#tahun').val(tahun);
            $('#tautan').val(tautan);
        }

        $("#form-status").on("submit", function (e) {
            $.ajax({
                type: 'POST',
                url: '{{route('user.update.profil')}}',
                data: new FormData($("#form-status")[0]),
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data != "") {
                        swal('Update Status', 'Status Anda berhasil diperbarui!', 'success');
                        $(".show_status").text(data);
                    } else {
                        swal('Update Status', 'Status Anda berhasil dihapus!', 'success');
                        $(".show_status").text('Status (-)');
                    }

                    $("#show_status_settings").click();
                },
                error: function () {
                    swal('Oops...', 'Terjadi suatu kesalahan! Silahkan segarkan browser Anda.', 'error');
                }
            });
            return false;
        });

        $(".browse_files").on('click', function () {
            $("#attach-files").trigger('click');
        });

        $("#attach-files").on('change', function () {
            var files = $(this).prop("files"), names = $.map(files, function (val) {
                return val.name;
            });
            $("#txt_attach").val(names);
            $("#txt_attach[data-toggle=tooltip]").attr('data-original-title', names);
        });

        $("#form-portofolio").on('submit', function (e) {
            e.preventDefault();
            if ($("#form-portofolio input[name='_method']").val() != 'PUT' && !$("#attach-files").val()) {
                swal('PERHATIAN!', 'Foto portofolio tidak boleh kosong!', 'warning');
            } else {
                $(this)[0].submit();
            }
        });

        document.getElementById("file-input").onchange = function () {
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
                                    url: '{{route('user.update.pengaturan')}}',
                                    data: new FormData($("#form-ava")[0]),
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
                                        $(".show_ava").attr('src', data);
                                        swal('SUKSES!', 'Foto Anda berhasil diperbarui!', 'success');
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

        document.getElementById("input-background").onchange = function () {
            var files_size = this.files[0].size,
                max_file_size = 2000000, allowed_file_types = ['image/png', 'image/gif', 'image/jpeg', 'image/pjpeg'],
                file_name = $(this).val().replace(/C:\\fakepath\\/i, ''),
                progress_bar_id = $("#progress-upload2 .progress-bar");

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
                                                $("#progress-upload2").css("display", "block");
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
                                        $(".show_background").attr('src', '{{asset('storage/users/latar_belakang')}}/' + data);
                                        $("#show_background_name").html("&nbsp;" + data);

                                        swal('SUKSES!', 'Latar belakang profil Anda berhasil diperbarui!', 'success');
                                        $("#progress-upload2").css("display", "none");
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

        function humanFileSize(size) {
            var i = Math.floor(Math.log(size) / Math.log(1024));
            return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
        }
    </script>
@endpush
