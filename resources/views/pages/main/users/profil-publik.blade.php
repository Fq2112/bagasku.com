@extends('layouts.mst')
@section('title', 'Profil: '.$user->name.' | '.env('APP_TITLE'))
@push('styles')
    <link rel="stylesheet" href="{{asset('css/card.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-tabs-responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/grid-list.css')}}">
    <link rel="stylesheet" href="{{asset('css/list-accordion.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/lightgallery/dist/css/lightgallery.min.css')}}">
    <style>
        blockquote {
            background: unset;
            border-color: unset;
            color: unset;
        }

        [data-scrollbar] {
            max-height: 350px;
        }

        .content-area {
            position: relative;
            cursor: pointer;
            overflow: hidden;
            margin: 1em auto;
        }

        .custom-overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            background: rgba(0, 0, 0, 0.7);
            opacity: 0;
            transition: all 400ms ease-in-out;
            height: 100%;
        }

        .custom-overlay:hover {
            opacity: 1;
        }

        .custom-text {
            position: absolute;
            top: 50%;
            left: 10px;
            right: 10px;
            transform: translateY(-50%);
            color: #eee;
        }

        .content-area img {
            transition: transform .5s ease;
        }

        .content-area:hover img {
            transform: scale(1.2);
        }

        .lg-backdrop {
            z-index: 9999999;
        }

        .lg-outer {
            z-index: 10000000;
        }

        .lg-sub-html h4 {
            color: #eee;
        }

        .lg-sub-html p {
            color: #bbb;
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
                                            <tr>
                                                <td><i class="fa fa-globe"></i></td>
                                                <td>&nbsp;</td>
                                                <td>
                                                    @if($user->get_bio->website != "")
                                                        <a href="{{$user->get_bio->website}}" target="_blank"
                                                           style="text-transform: none">{{$user->get_bio->website}}</a>
                                                    @else
                                                        Website (-)
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
                                <div class="card-content">
                                    <div class="card-title">
                                        <small>Bahasa</small>
                                        <hr class="mt-0">
                                        <div style="font-size: 14px; margin-top: 0">
                                            @if(count($bahasa) == 0)
                                                <p>{{$user->name}} belum menambahkan kemampuan berbahasanya, baik bahasa
                                                    daerah maupun bahasa asing.</p>
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
                                            @if(count($skill) == 0)
                                                <p>{{$user->name}} belum menambahkan skill atau kemampuan yang
                                                    dikuasainya.</p>
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
                                                    <b>{{round($rating_klien * 2) / 2}}</b> ({{count($ulasan_klien)}}
                                                    ulasan)
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
                                                    <b>{{round($rating_pekerja * 2) / 2}}</b>
                                                    ({{count($ulasan_pekerja)}}
                                                    ulasan)
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
                                                <td><i class="fa fa-tools"></i></td>
                                                <td>&nbsp;</td>
                                                <td>{{$user->get_service->count()}} layanan</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tabs portofolio, proyek, layanan, ulasan klien, ulasan pekerja -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">
                                    <li role="presentation" class="active">
                                        <a class="nav-item nav-link" href="#proyek" id="proyek-tab" role="tab"
                                           data-toggle="tab" aria-controls="proyek" aria-expanded="true">
                                            <i class="fa fa-business-time mr-2"></i>TUGAS/PROYEK
                                            <span class="badge badge-secondary">{{count($proyek) > 999 ? '999+' :
                                            count($proyek)}}</span></a>
                                    </li>
                                    <li role="presentation" class="next">
                                        <a class="nav-item nav-link" href="#layanan" id="layanan-tab" role="tab"
                                           data-toggle="tab" aria-controls="layanan" aria-expanded="true">
                                            <i class="fa fa-tools mr-2"></i>LAYANAN
                                            <span class="badge badge-secondary">{{count($layanan) > 999 ? '999+' :
                                            count($layanan)}}</span></a>
                                    </li>
                                    <li role="presentation" class="next">
                                        <a class="nav-item nav-link" href="#portofolio" id="portofolio-tab" role="tab"
                                           data-toggle="tab" aria-controls="portofolio" aria-expanded="true">
                                            <i class="fa fa-briefcase mr-2"></i>PORTOFOLIO
                                            <span class="badge badge-secondary">{{count($portofolio) > 999 ? '999+' :
                                            count($portofolio)}}</span></a>
                                    </li>
                                    <li role="presentation" class="next">
                                        <a class="nav-item nav-link" href="#ulasan" id="ulasan-tab"
                                           role="tab" data-toggle="tab" aria-controls="ulasan"
                                           aria-expanded="true"><i class="fa fa-comments mr-2"></i>ULASAN
                                            <span class="badge badge-secondary">{{count($ulasan_klien) +
                                            count($ulasan_pekerja) > 999 ? '999+' : count($ulasan_klien) + count($ulasan_pekerja)}}
                                            </span></a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="proyek"
                                         aria-labelledby="proyek-tab" style="border: none">
                                        @if(count($proyek) > 0)
                                            <div class="row">
                                                @foreach($proyek as $row)
                                                    <div class="list-item">
                                                        <a href="{{route('detail.proyek', ['username' =>
                                                            $user->username, 'judul' => $row->get_judul_uri()])}}">
                                                            <div class="icon">
                                                                <img alt="Thumbnail" src="{{$row->thumbnail != "" ?
                                                                asset('storage/proyek/thumbnail/'.$row->thumbnail) :
                                                                asset('images/slider/beranda-proyek.jpg')}}">
                                                            </div>
                                                            <div class="list-content">
                                                                <p class="list-price">
                                                                    <sub class="list-category">Total bid: <span>{{$row->get_tawaran->count()}} bid</span></sub>
                                                                    <br>Rp{{number_format($row->harga,2,',','.')}}
                                                                    <span class="list-date"><i
                                                                            class="fa fa-calendar-week"></i>{{$row->waktu_pengerjaan}} hari</span>
                                                                    <br><sub class="list-category">Kategori {{$row->get_sub
                                                                    ->get_kategori->nama}}:
                                                                        <span>{{$row->get_sub->nama}}</span>
                                                                    </sub>
                                                                </p>
                                                                <div class="title">{{$row->judul}}</div>
                                                                <div class="rounded"></div>
                                                                {!!\Illuminate\Support\Str::words($row->deskripsi, 10, '...')!!}
                                                            </div>
                                                            <div class="item-arrow">
                                                                <i class="fa fa-long-arrow-alt-right"
                                                                   aria-hidden="true"></i>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p>{{$user->name}} belum menambahkan tugas/proyeknya.</p>
                                        @endif
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="layanan"
                                         aria-labelledby="layanan-tab" style="border: none">
                                        @if(count($layanan) > 0)
                                            <div class="row">
                                                @foreach($layanan as $row)
                                                    <div class="list-item">
                                                        <a href="{{route('detail.layanan', ['username' =>
                                                            $user->username, 'judul' => $row->get_judul_uri()])}}">
                                                            <div class="icon">
                                                                <img alt="Thumbnail" src="{{$row->thumbnail != "" ?
                                                                    asset('storage/layanan/thumbnail/'.$row->thumbnail) :
                                                                    asset('images/slider/beranda-pekerja.jpg')}}">
                                                            </div>
                                                            <div class="list-content">
                                                                <p class="list-price">
                                                                    Rp{{number_format($row->harga,2,',','.')}}<span
                                                                        class="list-date"><i
                                                                            class="fa fa-calendar-week"></i>{{$row->hari_pengerjaan}} hari</span>
                                                                    <br><sub class="list-category">Kategori {{$row->get_sub
                                                                        ->get_kategori->nama}}:
                                                                        <span>{{$row->get_sub->nama}}</span>
                                                                    </sub>
                                                                </p>
                                                                <div class="title">{{$row->judul}}</div>
                                                                <div class="rounded"></div>
                                                                {!!\Illuminate\Support\Str::words($row->deskripsi, 10, '...')!!}
                                                            </div>
                                                            <div class="item-arrow">
                                                                <i class="fa fa-long-arrow-alt-right"
                                                                   aria-hidden="true"></i>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p>{{$user->name}} belum menambahkan layanannya.</p>
                                        @endif
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="portofolio"
                                         aria-labelledby="portofolio-tab" style="border: none">
                                        @if(count($portofolio) > 0)
                                            <div class="row" id="lightgallery">
                                                @foreach($portofolio as $row)
                                                    <div data-aos="fade-down" class="col-md-4 item"
                                                         data-src="{{asset('storage/users/portofolio/'.$row->foto)}}"
                                                         data-sub-html="<h4>{{$row->tahun.': '.$row->judul}}</h4><p>{{$row->deskripsi}}</p>">
                                                        <div class="content-area">
                                                            <img src="{{asset('storage/users/portofolio/'.$row->foto)}}"
                                                                 alt="Thumbnail" class="img-responsive">
                                                            <div class="custom-overlay">
                                                                <div class="custom-text">
                                                                    <b>{{$row->tahun}}</b><br>
                                                                    {{\Illuminate\Support\Str::words($row->judul,5,'...')}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p>{{$user->name}} belum menambahkan portofolionya.</p>
                                        @endif
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="ulasan"
                                         aria-labelledby="ulasan-tab" style="border: none">
                                        <ul id="accordion" class="static-menu">
                                            <li>
                                                <div class="link">
                                                    <i class="fa fa-chevron-right"></i>SEBAGAI KLIEN
                                                    <span
                                                        class="badge badge-secondary ml-2">{{count($ulasan_klien)}}</span>
                                                </div>
                                                <ul class="sub-menu">
                                                    @if(count($ulasan_klien) > 0)
                                                        @foreach($ulasan_klien as $row)
                                                            <li>
                                                                <a href="{{route('profil.user',['username' => $row->get_user->username])}}">
                                                                    <div class="media">
                                                                        <div class="media-left media-middle"
                                                                             style="width: 13%">
                                                                            <img alt="avatar" src="{{$row->get_user->get_bio->foto
                                                                        == "" ? asset('images/faces/thumbs50x50/'.rand(1,6).'.jpg') :
                                                                        asset('storage/users/foto/'.$row->get_user->get_bio->foto)}}"
                                                                                 class="media-object img-thumbnail"
                                                                                 style="border-radius: 100%">
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <p class="media-heading">
                                                                                <i class="fa fa-hard-hat sub-menu-name mr-2"
                                                                                   style="color: #4d4d4d"></i>
                                                                                <b class="sub-menu-name">{{$row->get_user->name}}</b>
                                                                                <i class="fa fa-star"
                                                                                   style="color: #ffc100;margin: 0 0 0 .5rem"></i>
                                                                                <b>{{round($row->bintang * 2) / 2}}</b>
                                                                                <span class="pull-right"
                                                                                      style="color: #999">
                                                                                <i class="fa fa-clock"
                                                                                   style="color: #aaa;margin: 0"></i>
                                                                                {{$row->created_at->diffForHumans()}}
                                                                            </span>
                                                                            </p>
                                                                            <blockquote class="sub-menu-blockquote">
                                                                                {!! $row->deskripsi !!}
                                                                            </blockquote>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        <li style="border: none">
                                                            {{$user->name}} belum mendapatkan ulasan sebagai klien.
                                                        </li>
                                                    @endif
                                                </ul>
                                            </li>
                                            <li>
                                                <div class="link">
                                                    <i class="fa fa-chevron-right"></i>SEBAGAI PEKERJA
                                                    <span
                                                        class="badge badge-secondary ml-2">{{count($ulasan_pekerja)}}</span>
                                                </div>
                                                <ul class="sub-menu">
                                                    @if(count($ulasan_pekerja) > 0)
                                                        @foreach($ulasan_pekerja as $row)
                                                            <li>
                                                                <a href="{{route('profil.user',['username' => $row->get_user->username])}}">
                                                                    <div class="media">
                                                                        <div class="media-left media-middle"
                                                                             style="width: 13%">
                                                                            <img alt="avatar" src="{{$row->get_user->get_bio->foto
                                                                        == "" ? asset('images/faces/thumbs50x50/'.rand(1,6).'.jpg') :
                                                                        asset('storage/users/foto/'.$row->get_user->get_bio->foto)}}"
                                                                                 class="media-object img-thumbnail"
                                                                                 style="border-radius: 100%">
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <p class="media-heading">
                                                                                <i class="fa fa-user-tie sub-menu-name mr-2"
                                                                                   style="color: #4d4d4d"></i>
                                                                                <b class="sub-menu-name">{{$row->get_user->name}}</b>
                                                                                <i class="fa fa-star"
                                                                                   style="color: #ffc100;margin: 0 0 0 .5rem"></i>
                                                                                <b>{{round($row->bintang * 2) / 2}}</b>
                                                                                <span class="pull-right"
                                                                                      style="color: #999">
                                                                                <i class="fa fa-clock"
                                                                                   style="color: #aaa;margin: 0"></i>
                                                                                {{$row->created_at->diffForHumans()}}
                                                                            </span>
                                                                            </p>
                                                                            <blockquote class="sub-menu-blockquote">
                                                                                {!! $row->deskripsi !!}
                                                                            </blockquote>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        <li style="border: none">
                                                            {{$user->name}} belum mendapatkan ulasan sebagai pekerja.
                                                        </li>
                                                    @endif
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{asset('vendor/masonry/masonry.pkgd.min.js')}}"></script>
    <script src="{{asset('vendor/lightgallery/lib/picturefill.min.js')}}"></script>
    <script src="{{asset('vendor/lightgallery/dist/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('vendor/lightgallery/modules/lg-video.min.js')}}"></script>
    <script>
        $(function () {
            var Accordion = function (el, multiple) {
                this.el = el || {};
                this.multiple = multiple || false;

                var links = this.el.find('.link');
                links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown);
            };

            Accordion.prototype.dropdown = function (e) {
                var $el = e.data.el;
                $this = $(this),
                    $next = $this.next();

                $next.slideToggle();
                $this.parent().toggleClass('open');

                if (!e.data.multiple) {
                    $el.find('.sub-menu').not($next).slideUp().parent().removeClass('open');
                }
            };

            var accordion = new Accordion($('#accordion'), false);
        });

        $(document).on('show.bs.tab', '.nav-tabs-responsive [data-toggle="tab"]', function (e) {
            var $target = $(e.target);
            var $tabs = $target.closest('.nav-tabs-responsive');
            var $current = $target.closest('li');
            var $parent = $current.closest('li.dropdown');
            $current = $parent.length > 0 ? $parent : $current;
            var $next = $current.next();
            var $prev = $current.prev();
            var updateDropdownMenu = function ($el, position) {
                $el
                    .find('.dropdown-menu')
                    .removeClass('pull-xs-left pull-xs-center pull-xs-right')
                    .addClass('pull-xs-' + position);
            };

            $tabs.find('>li').removeClass('next prev');
            $prev.addClass('prev');
            $next.addClass('next');

            updateDropdownMenu($prev, 'left');
            updateDropdownMenu($current, 'center');
            updateDropdownMenu($next, 'right');
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            setTimeout(function () {
                $('.use-nicescroll').getNiceScroll().resize()
            }, 600);
        });

        $("#portofolio-tab").on("shown.bs.tab", function () {
            var portofolio = $("#lightgallery");
            portofolio.masonry({
                itemSelector: '.item'
            });
            portofolio.lightGallery({
                selector: '.item',
                loadYoutubeThumbnail: true,
                youtubeThumbSize: 'default',
            });
        });

        $(".static-menu .sub-menu li a").on({
            mouseenter: function () {
                $(this).parent().css('border-color', '#122752');
            },
            mouseleave: function () {
                $(this).parent().css('border-color', '#eee');
            }
        });
    </script>
@endpush
