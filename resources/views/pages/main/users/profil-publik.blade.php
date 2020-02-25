@extends('layouts.mst')
@section('title', 'Profil: '.$user->name.' | '.env('APP_TITLE'))
@push('styles')
    <link rel="stylesheet" href="{{asset('css/card.css')}}">
    <style>
        blockquote {
            background: unset;
            border-color: unset;
            color: unset;
        }

        [data-scrollbar] {
            max-height: 350px;
        }
    </style>
@endpush
@section('content')
    <div class="breadcrumbs" style="background-image: url('{{$user->get_bio->latar_belakang != null ?
    asset('storage/users/latar_belakang/'.$user->get_bio->latar_belakang) : asset('images/slider/beranda-proyek.jpg')}}')">
        <div class="breadcrumbs-overlay"></div>
        <div class="page-title">
            <h2>{{$user->name}}</h2>
            <p>{{$user->get_bio->status != "" ? $user->get_bio->status : $user->username}}</p>
        </div>
    </div>

    <section class="none-margin" style="padding: 40px 0 40px 0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                    <!-- personal -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="img-card">
                                    <img style="width: 100%" alt="Avatar" src="{{$user->get_bio->foto== "" ?
                                    asset('images/faces/thumbs50x50/'.rand(1,6).'.jpg') :
                                    asset('storage/users/foto/'.$user->get_bio->foto)}}">
                                </div>

                                <div class="card-content">
                                    <div class="card-title text-center">
                                        <a href="{{route('user.profil')}}">
                                            <h4 class="aj_name" style="color: #122752">{{$user->name}}</h4></a>
                                        <small style="text-transform: none">{{$user->get_bio->status
                                        != "" ? $user->get_bio->status : 'Status (-)'}}</small>
                                    </div>
                                    <div class="card-title">
                                        <table style="font-size: 14px;">
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
                                                <td><i class="fa fa-map-marker-alt"></i></td>
                                                <td>&nbsp;</td>
                                                <td>
                                                    @if($user->get_bio->kota_id != "" && $user->get_bio->kewarganegaraan != "")
                                                        {{$user->get_bio->get_kota->nama.', '.$user->get_bio->get_kota->get_provinsi->nama.', '.$user->get_bio->kewarganegaraan}}
                                                    @else
                                                        Kabupaten/Kota, Provinsi (-)
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-home"></i></td>
                                                <td>&nbsp;</td>
                                                <td>
                                                    @if($user->get_bio->alamat != "" && $user->get_bio->kode_pos != "")
                                                        {{$user->get_bio->alamat.' - '.$user->get_bio->kode_pos}}
                                                    @else
                                                        Alamat (-)
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                        <hr style="margin: 10px 0">
                                        <table style="font-size: 14px; margin-top: 0">
                                            <tr>
                                                <td><i class="fa fa-calendar-check"></i></td>
                                                <td>&nbsp;Bergabung Sejak</td>
                                                <td>
                                                    : {{$user->created_at->format('j F Y')}}
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
                                <div class="card-content">
                                    <div class="card-title">
                                        <small>Bahasa</small>
                                        <hr class="mt-0">
                                        <div style="font-size: 14px; margin-top: 0">
                                            @if($user->get_bahasa->count() == 0)
                                                <p>{{$user->name}} belum menambahkan kemampuan berbahasanya, baik bahasa
                                                    daerah maupun bahasa asing.</p>
                                            @else
                                                <div data-scrollbar>
                                                    @foreach($user->get_bahasa as $row)
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- skill -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-title">
                                        <small>Skill</small>
                                        <hr class="mt-0">
                                        <div style="font-size: 14px; margin-top: 0">
                                            @if($user->get_skill->count() == 0)
                                                <p>{{$user->name}} belum menambahkan skill atau kemampuan yang
                                                    dikuasainya.</p>
                                            @else
                                                <div data-scrollbar>
                                                    @foreach($user->get_skill as $row)
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <!-- summary -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-title">
                                        <small>Summary</small>
                                        <hr class="mt-0">
                                        <blockquote data-scrollbar>
                                            {!!$user->get_bio->summary != "" ? $user->get_bio->summary :
                                            '<p>'.$user->name.' belum menuliskan <em>summary</em> atau ringkasan resumenya.</p>'!!}
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- rating -->
                    <div class="row">
                        <!-- rating klien -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-title">
                                        <small>Rating Klien</small>
                                        <hr class="mt-0">
                                        <table style="font-size: 14px; margin-top: 0">
                                            <tr>
                                                <td><i class="fa fa-comments"></i></td>
                                                <td>&nbsp;</td>
                                                <td style="text-transform: none">
                                                    <span style="color: #ffc100">
                                            @if(round($rating_klien * 2) / 2 == 1)
                                                            <i class="fa fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_klien * 2) / 2 == 2)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_klien * 2) / 2 == 3)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_klien * 2) / 2 == 4)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_klien * 2) / 2 == 5)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        @elseif(round($rating_klien * 2) / 2 == 0.5)
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_klien * 2) / 2 == 1.5)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_klien * 2) / 2 == 2.5)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_klien * 2) / 2 == 3.5)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_klien * 2) / 2 == 4.5)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @endif </span>
                                                    <b>{{$rating_klien}}</b> ({{$total_ulasan_klien}} ulasan)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-trophy"></i></td>
                                                <td>&nbsp;</td>
                                                <td>{{$user->get_bio->total_bintang_klien}} poin
                                                    <span style="text-transform: none">(#{{$user->get_rank_klien().' dari '.$total_user}})</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-business-time"></i></td>
                                                <td>&nbsp;</td>
                                                <td>{{$user->get_project->count()}} proyek</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- rating pekerja -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-title">
                                        <small>Rating Pekerja</small>
                                        <hr class="mt-0">
                                        <table style="font-size: 14px; margin-top: 0">
                                            <tr>
                                                <td><i class="fa fa-comments"></i></td>
                                                <td>&nbsp;</td>
                                                <td style="text-transform: none">
                                                    <span style="color: #ffc100">
                                                        @if(round($rating_pekerja * 2) / 2 == 1)
                                                            <i class="fa fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_pekerja * 2) / 2 == 2)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_pekerja * 2) / 2 == 3)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_pekerja * 2) / 2 == 4)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_pekerja * 2) / 2 == 5)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        @elseif(round($rating_pekerja * 2) / 2 == 0.5)
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_pekerja * 2) / 2 == 1.5)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_pekerja * 2) / 2 == 2.5)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_pekerja * 2) / 2 == 3.5)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="far fa-star"></i>
                                                        @elseif(round($rating_pekerja * 2) / 2 == 4.5)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @endif </span>
                                                    <b>{{$rating_pekerja}}</b> ({{$total_ulasan_pekerja}} ulasan)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-trophy"></i></td>
                                                <td>&nbsp;</td>
                                                <td>{{$user->get_bio->total_bintang_pekerja}} poin
                                                    <span style="text-transform: none">(#{{$user->get_rank_pekerja().' dari '.$total_user}})</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-business-time"></i></td>
                                                <td>&nbsp;</td>
                                                <td>{{$user->get_service->count()}} layanan</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ulasan -->
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(function () {
            Scrollbar.initAll();
        });
    </script>
@endpush
