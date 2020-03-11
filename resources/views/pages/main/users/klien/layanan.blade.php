@extends('layouts.mst')
@section('title', 'Dashboard Klien: Layanan – '.$user->name.' | '.env('APP_TITLE'))
@push('styles')
    <link rel="stylesheet" href="{{asset('css/card.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-tabs-responsive.css')}}">
    <link rel="stylesheet" href="{{asset('admins/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('admins/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/modules/datatables/Select-1.2.4/css/select.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/modules/datatables/Buttons-1.5.6/css/buttons.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/lightgallery/dist/css/lightgallery.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        blockquote {
            background: unset;
            border-color: unset;
            color: unset;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .table-striped a {
            color: #777;
            font-weight: 500;
            transition: all .3s ease;
            text-decoration: none !important;
        }

        .table-striped a:hover, .table-striped a:focus, .table-striped a:active {
            color: #122752;
        }

        .btn-link {
            border: 1px solid #ccc;
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

        .rating {
            border: none;
            float: left;
        }

        .rating > input {
            display: none;
        }

        .rating > label:before {
            margin: 0 5px 0 5px;
            font-size: 1.25em;
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            display: inline-block;
            content: "\f005";
        }

        .rating > .half:before {
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            content: "\f089";
            position: absolute;
        }

        .rating > label {
            color: #ddd;
            float: right;
        }

        .rating > input:checked ~ label,
        .rating:not(:checked) > label:hover,
        .rating:not(:checked) > label:hover ~ label {
            color: #ffc100;
        }

        .rating > input:checked + label:hover,
        .rating > input:checked ~ label:hover,
        .rating > label:hover ~ input:checked ~ label,
        .rating > input:checked ~ label:hover ~ label {
            color: #e1a500;
        }
    </style>
@endpush
@section('content')
    <div class="breadcrumbs" style="background-image: url('{{$user->get_bio->latar_belakang != null ?
    asset('storage/users/latar_belakang/'.$user->get_bio->latar_belakang) : asset('images/slider/beranda-pekerja.jpg')}}')">
        <div class="breadcrumbs-overlay"></div>
        <div class="page-title">
            <h2>Dashboard Klien: Layanan</h2>
            <p>Halaman ini menampilkan daftar layanan yang Anda pesan dan juga daftar pengerjaannya.</p>
        </div>
        <ul class="crumb">
            <li><a href="{{route('beranda')}}"><i class="fa fa-home"></i></a></li>
            <li><i class="fa fa-angle-double-right"></i> <a href="#">Dashboard Klien</a></li>
            <li><i class="fa fa-angle-double-right"></i> <a href="{{route('dashboard.klien.layanan')}}">Layanan</a></li>
            <li><a href="#" onclick="goToAnchor()"><i class="fa fa-angle-double-right"></i> Daftar Pesanan & Pengerjaan</a>
            </li>
        </ul>
    </div>

    <section class="none-margin" style="padding: 40px 0 40px 0">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                    <div class="card">
                        <div class="img-card">
                            <img style="width: 100%" alt="Avatar" src="{{$user->get_bio->foto == "" ?
                            asset('images/faces/thumbs50x50/'.rand(1,6).'.jpg') : asset('storage/users/foto/'.$user->get_bio->foto)}}">
                        </div>
                        <div class="card-content">
                            <div class="card-title text-center">
                                <a href="{{route('user.profil')}}"><h4 style="color: #122752">{{$user->name}}</h4></a>
                                <small style="text-transform: none">{{$user->get_bio->status != "" ?
                                $user->get_bio->status : 'Status (-)'}}</small>
                            </div>
                            <div class="card-title">
                                <a href="{{route('profil.user', ['username' => $user->username])}}"
                                   class="btn btn-link btn-sm btn-block">Lihat Mode Publik
                                </a>
                                <hr style="margin: 10px 0">
                                <table class="stats" style="font-size: 14px; margin-top: 0">
                                    <tr data-toggle="tooltip" data-placement="left" title="Bergabung Sejak">
                                        <td><i class="fa fa-calendar-check"></i></td>
                                        <td>&nbsp;</td>
                                        <td>{{$user->created_at->formatLocalized('%d %B %Y')}}</td>
                                    </tr>
                                    <tr data-toggle="tooltip" data-placement="left" title="Update Terakhir">
                                        <td><i class="fa fa-clock"></i></td>
                                        <td>&nbsp;</td>
                                        <td style="text-transform: none;">{{$user->updated_at->diffForHumans()}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-6 col-sm-12">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">
                            <li role="presentation" class="active">
                                <a class="nav-item nav-link" href="#pesanan" id="pesanan-tab" role="tab"
                                   data-toggle="tab" aria-controls="pesanan" aria-expanded="true">
                                    <i class="fa fa-shopping-cart mr-2"></i>PESANAN <span class="badge badge-secondary">
                                        {{count($pesanan) > 999 ? '999+' : count($pesanan)}}</span></a>
                            </li>
                            <li role="presentation" class="next">
                                <a class="nav-item nav-link" href="#pengerjaan" id="pengerjaan-tab"
                                   role="tab" data-toggle="tab" aria-controls="pengerjaan" aria-expanded="true">
                                    <i class="fa fa-business-time mr-2"></i>PENGERJAAN
                                    <span
                                        class="badge badge-secondary">{{count($pengerjaan) > 999 ? '999+' : count($pengerjaan)}}</span>
                                </a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="pesanan"
                                 aria-labelledby="pesanan-tab"
                                 style="border: none">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="dt-pesanan">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Layanan</th>
                                            <th class="text-center">Batas Waktu</th>
                                            <th class="text-right">Harga (Rp)</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $no = 1; @endphp
                                        @foreach($pesanan as $row)
                                            @php

                                                @endphp
                                            <tr>
                                                <td style="vertical-align: middle" align="center">{{$no++}}</td>
                                                <td style="vertical-align: middle">
                                                    <a href="{{route('detail.layanan', ['username' => $row->get_service
                                                    ->get_user->username, 'judul' => $row->get_service->get_judul_uri()])}}">
                                                        <img class="img-responsive float-left mr-2" width="80"
                                                             alt="Thumbnail" src="{{$row->get_service->thumbnail != "" ?
                                                             asset('storage/layanan/thumbnail/'.$row->get_service->thumbnail)
                                                             : asset('images/slider/beranda-pekerja.jpg')}}">
                                                        <span
                                                            class="label label-info">{{$row->get_service->get_sub->get_kategori->nama}}</span>
                                                        <br><b>{{$row->get_service->judul}}</b>
                                                    </a>
                                                    {!! $row->get_service->deskripsi !!}
                                                </td>
                                                <td style="vertical-align: middle" align="center">
                                                    {{$row->get_service->hari_pengerjaan}} hari
                                                </td>
                                                <td style="vertical-align: middle" align="right">
                                                    {{number_format($row->get_service->harga,2,',','.')}}</td>
                                                <td style="vertical-align: middle" align="center">
                                                    @if(!is_null($row->get_pembayaran))
                                                        @if($row->get_pembayaran->dp == true)
                                                            <span class="label label-default">DP {{round($row
                                                            ->get_pembayaran->jumlah_pembayaran / $row->get_service->harga * 100,1)}}%</span>
                                                        @else
                                                            <span class="label label-success">LUNAS</span>
                                                        @endif
                                                    @else
                                                        <span class="label label-danger">MENUNGGU PEMBAYARAN</span>
                                                    @endif
                                                </td>
                                                <td style="vertical-align: middle" align="center">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <a class="btn btn-link btn-sm" style="margin-right: 0"
                                                               href="{{route('detail.layanan',
                                                               ['username' => $row->get_service->get_user->username,
                                                               'judul' => $row->get_service->get_judul_uri()])}}"
                                                               data-toggle="tooltip" title="Lihat Layanan">
                                                                <i class="fa fa-info-circle"
                                                                   style="margin-right: 0"></i>
                                                            </a>
                                                            <button class="btn btn-link btn-sm" type="button"
                                                                    {{$attr_pay}}
                                                                    data-toggle="tooltip" title="Bukti Pembayaran"
                                                                    onclick="unggahBukti()">
                                                                <i class="fa fa-upload" style="margin-right: 0"></i>
                                                            </button>
                                                            <button class="btn btn-link btn-sm" type="button" {{$attr}}
                                                            data-toggle="tooltip" title="Batalkan Pesanan"
                                                                    onclick="batalkanPesanan('{{route("klien.batalkan.pesanan",
                                                                    ["id" => $row->id])}}','{{$row->get_service->judul}}')">
                                                                <i class="fa fa-trash-alt" style="margin-right: 0"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="pengerjaan" aria-labelledby="pengerjaan-tab"
                                 style="border: none">
                                <div class="table-responsive" id="dt-pengerjaan">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Detail</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $no = 1; @endphp
                                        @foreach($pengerjaan as $row)
                                            <tr>
                                                <td style="vertical-align: middle" align="center">{{$no++}}</td>
                                                <td style="vertical-align: middle">
                                                    <div class="row mb-1" style="border-bottom: 1px solid #eee;">
                                                        <div class="col-lg-12">
                                                            <a href="{{route('detail.layanan', ['username' =>
                                                            $row->get_service->get_user->username, 'judul' =>
                                                            $row->get_service->get_judul_uri()])}}">
                                                                <img class="img-responsive float-left mr-2"
                                                                     alt="Thumbnail" width="80"
                                                                     src="{{$row->get_service->thumbnail != "" ?
                                                                     asset('storage/layanan/thumbnail/'.$row->get_service->thumbnail)
                                                                     : asset('images/slider/beranda-pekerja.jpg')}}">
                                                                @if($row->get_service->get_pembayaran->dp == true)
                                                                    <span class="label label-default">DP {{round($row
                                                                    ->get_service->get_pembayaran->jumlah_pembayaran /
                                                                    $row->get_service->harga * 100,1)}}%</span>
                                                                @else
                                                                    <span class="label label-success">LUNAS</span>
                                                                @endif |
                                                                <span class="label label-{{$row->selesai == false ?
                                                                'warning' : 'success'}}">{{$row->selesai == false ?
                                                                'PROSES PENGERJAAN' : 'SELESAI'}}</span>
                                                                <br><b>{{$row->get_service->judul}}</b>
                                                            </a>
                                                            <p>
                                                                Rp{{number_format($row->get_service->harga,2,',','.')}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1" style="border-bottom: 1px solid #eee">
                                                        <div class="col-lg-12">
                                                            <ul class="none-margin">
                                                                <li><b>HASIL PENGERJAAN</b></li>
                                                                <li style="list-style: none">
                                                                    @if($row->file_hasil != "")
                                                                        <div class="row use-lightgallery">
                                                                            @foreach($row->file_hasil as $file)
                                                                                <div data-aos="fade-down"
                                                                                     class="col-md-3 item"
                                                                                     data-src="{{asset('storage/layanan/hasil/'.$file)}}"
                                                                                     data-sub-html="<h4>{{$row->get_service->judul}}</h4><p>{{$file}}</p>">
                                                                                    <div class="content-area">
                                                                                        <img alt="File hasil"
                                                                                             src="{{asset('storage/layanan/hasil/'.$file)}}"
                                                                                             class="img-responsive">
                                                                                        <div class="custom-overlay">
                                                                                            <div class="custom-text">
                                                                                                <b>{{$file}}</b>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        (kosong)
                                                                    @endif
                                                                </li>
                                                                <li><b>TAUTAN</b></li>
                                                                <li style="list-style: none">
                                                                    @if($row->tautan != "")
                                                                        <a href="{{$row->tautan}}"
                                                                           target="_blank">{{$row->tautan}}</a>
                                                                    @else
                                                                        (kosong)
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <b>ULASAN ANDA</b><br>
                                                            @if(!is_null($row->get_ulasan))
                                                                <div class="media">
                                                                    <div class="media-left media-middle">
                                                                        <a href="{{route('profil.user', ['username' => $user->username])}}">
                                                                            <img width="48" alt="avatar" src="{{$user->get_bio->foto == "" ?
                                                                            asset('images/faces/thumbs50x50/'.rand(1,6).'.jpg') :
                                                                            asset('storage/users/foto/'.$user->get_bio->foto)}}"
                                                                                 class="media-object img-thumbnail"
                                                                                 style="border-radius: 100%">
                                                                        </a>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <p class="media-heading">
                                                                            <i class="fa fa-user-tie mr-2"
                                                                               style="color: #4d4d4d"></i>
                                                                            <a href="{{route('profil.user', ['username' => $user->username])}}">
                                                                                {{$user->name}}</a>
                                                                            <i class="fa fa-star"
                                                                               style="color: #ffc100;margin: 0 0 0 .5rem"></i>
                                                                            <b>{{round($row->get_ulasan->bintang * 2) / 2}}</b>
                                                                            <span class="pull-right"
                                                                                  style="color: #999">
                                                                                <i class="fa fa-clock"
                                                                                   style="color: #aaa;margin: 0"></i>
                                                                                {{$row->get_ulasan->created_at->diffForHumans()}}
                                                                            </span>
                                                                        </p>
                                                                        <blockquote>
                                                                            {!! $row->get_ulasan->deskripsi !!}
                                                                        </blockquote>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                (kosong)
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle" align="center">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <a class="btn btn-link btn-sm" style="margin-right: 0"
                                                               href="{{route('detail.layanan',
                                                               ['username' => $row->get_service->get_user->username,
                                                               'judul' => $row->get_service->get_judul_uri()])}}"
                                                               data-toggle="tooltip" title="Lihat Layanan">
                                                                <i class="fa fa-info-circle"
                                                                   style="margin-right: 0"></i>
                                                            </a>
                                                            <button class="btn btn-link btn-sm" style="margin-right: 0"
                                                                    data-toggle="tooltip" title="Ulas Hasil"
                                                                    onclick="ulasHasil('{{$row->id}}',
                                                                        '{{route('klien.ulas-pengerjaan.layanan', ['id' => $row->id])}}',
                                                                        '{{route('klien.data-ulasan.layanan', ['id' => $row->id])}}',
                                                                        '{{$row->get_service->judul}}')"
                                                                {{is_null($row->get_ulasan) || $row->selesai == true ? 'disabled' : ''}}>
                                                                <i class="fa fa-edit" style="margin-right: 0"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div id="ulas-hasil" style="display: none">
                                    <div class="card">
                                        <form class="form-horizontal" role="form" method="POST">
                                            @csrf
                                            <div class="card-content">
                                                <div class="card-title">
                                                    <small id="judul"></small>
                                                    <hr class="mt-0">
                                                    <fieldset id="rating" class="rating" aria-required="true">
                                                        <label class="full" for="star5" data-toggle="tooltip"
                                                               title="Terbaik"></label>
                                                        <input type="radio" id="star5" name="rating" value="5" required>

                                                        <label class="half" for="star4half" data-toggle="tooltip"
                                                               title="Keren"></label>
                                                        <input type="radio" id="star4half" name="rating" value="4.5">

                                                        <label class="full" for="star4" data-toggle="tooltip"
                                                               title="Cukup baik"></label>
                                                        <input type="radio" id="star4" name="rating" value="4">

                                                        <label class="half" for="star3half" data-toggle="tooltip"
                                                               title="Baik"></label>
                                                        <input type="radio" id="star3half" name="rating" value="3.5">

                                                        <label class="full" for="star3" data-toggle="tooltip"
                                                               title="Standar"></label>
                                                        <input type="radio" id="star3" name="rating" value="3">

                                                        <label class="half" for="star2half" data-toggle="tooltip"
                                                               title="Cukup buruk"></label>
                                                        <input type="radio" id="star2half" name="rating" value="2.5">

                                                        <label class="full" for="star2" data-toggle="tooltip"
                                                               title="Buruk"></label>
                                                        <input type="radio" id="star2" name="rating" value="2">

                                                        <label class="half" for="star1half" data-toggle="tooltip"
                                                               title="Sangat buruk"></label>
                                                        <input type="radio" id="star1half" name="rating" value="1.5">

                                                        <label class="full" for="star1" data-toggle="tooltip"
                                                               title="Menyedihkan"></label>
                                                        <input type="radio" id="star1" name="rating" value="1">

                                                        <label class="half" for="starhalf" data-toggle="tooltip"
                                                               title="Sangat menyedihkan"></label>
                                                        <input type="radio" id="starhalf" name="rating" value="0.5">
                                                    </fieldset>
                                                    <div class="row form-group">
                                                        <div class="col-md-12">
                                                            <textarea id="deskripsi" name="deskripsi"
                                                                      class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-lg-12">
                                                            <button type="reset" class="btn btn-link btn-sm"
                                                                    style="border: 1px solid #ccc">
                                                                <i class="fa fa-undo mr-2"></i>BATAL
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-read-more">
                                                <button class="btn btn-link btn-block">
                                                    <i class="fa fa-edit"></i>&nbsp;SIMPAN PERUBAHAN
                                                </button>
                                            </div>
                                        </form>
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
    <script src="{{asset('admins/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('admins/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('admins/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    <script src="{{asset('admins/modules/datatables/Buttons-1.5.6/js/buttons.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/masonry/masonry.pkgd.min.js')}}"></script>
    <script src="{{asset('vendor/lightgallery/lib/picturefill.min.js')}}"></script>
    <script src="{{asset('vendor/lightgallery/dist/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('vendor/lightgallery/modules/lg-video.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>
    <script>
        $(function () {
            var export_pesanan = 'Daftar Pesanan Layanan ({{now()->format('j F Y')}})',
                export_pengerjaan = 'Daftar Pengerjaan Layanan ({{now()->format('j F Y')}})';

            $("#dt-pesanan").DataTable({
                dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-5'B><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                columnDefs: [{"sortable": false, "targets": 5}],
                language: {
                    "emptyTable": "Anda belum memesan layanan apapun",
                    "info": "Menampilkan _START_ to _END_ of _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 entri",
                    "infoFiltered": "(difilter dari _MAX_ total entri)",
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "loadingRecords": "Memuat...",
                    "processing": "Mengolah...",
                    "search": "Cari:",
                    "zeroRecords": "Data yang Anda cari tidak ditemukan.",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "aria": {
                        "sortAscending": ": aktifkan untuk mengurutkan kolom dari kecil ke besar (asc)",
                        "sortDescending": ": aktifkan untuk mengurutkan kolom dari besar ke kecil (desc)"
                    }
                },
                buttons: [
                    {
                        text: '<b class="text-uppercase"><i class="far fa-file-excel mr-2"></i>Excel</b>',
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        },
                        className: 'btn btn-link btn-sm assets-export-btn export-xls ttip',
                        title: export_pesanan,
                        extension: '.xls'
                    }, {
                        text: '<b class="text-uppercase"><i class="fa fa-file-pdf mr-2"></i>PDF</b>',
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        },
                        className: 'btn btn-link btn-sm assets-select-btn export-pdf',
                        title: export_pesanan,
                        extension: '.pdf'
                    }, {
                        text: '<b class="text-uppercase"><i class="fa fa-print mr-2"></i>Cetak</b>',
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        },
                        className: 'btn btn-link btn-sm assets-select-btn export-print'
                    }
                ],
                fnDrawCallback: function (oSettings) {
                    $('.use-nicescroll').getNiceScroll().resize();
                    $('[data-toggle="tooltip"]').tooltip();
                },
            });

            $("#dt-pengerjaan table").DataTable({
                dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-5'B><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                columnDefs: [{"sortable": false, "targets": 2}],
                language: {
                    "emptyTable": "Anda belum memiliki daftar pengerjaan layanan apapun",
                    "info": "Menampilkan _START_ to _END_ of _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 entri",
                    "infoFiltered": "(difilter dari _MAX_ total entri)",
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "loadingRecords": "Memuat...",
                    "processing": "Mengolah...",
                    "search": "Cari:",
                    "zeroRecords": "Data yang Anda cari tidak ditemukan.",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "aria": {
                        "sortAscending": ": aktifkan untuk mengurutkan kolom dari kecil ke besar (asc)",
                        "sortDescending": ": aktifkan untuk mengurutkan kolom dari besar ke kecil (desc)"
                    }
                },
                buttons: [
                    {
                        text: '<b class="text-uppercase"><i class="far fa-file-excel mr-2"></i>Excel</b>',
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1]
                        },
                        className: 'btn btn-link btn-sm assets-export-btn export-xls ttip',
                        title: export_pengerjaan,
                        extension: '.xls'
                    }, {
                        text: '<b class="text-uppercase"><i class="fa fa-file-pdf mr-2"></i>PDF</b>',
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1]
                        },
                        className: 'btn btn-link btn-sm assets-select-btn export-pdf',
                        title: export_pengerjaan,
                        extension: '.pdf'
                    }, {
                        text: '<b class="text-uppercase"><i class="fa fa-print mr-2"></i>Cetak</b>',
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1]
                        },
                        className: 'btn btn-link btn-sm assets-select-btn export-print'
                    }
                ],
                fnDrawCallback: function (oSettings) {
                    $('.use-nicescroll').getNiceScroll().resize();
                    $('[data-toggle="tooltip"]').tooltip();

                    var file_hasil = $(".use-lightgallery");
                    file_hasil.masonry({
                        itemSelector: '.item'
                    });
                    file_hasil.lightGallery({
                        selector: '.item',
                        loadYoutubeThumbnail: true,
                        youtubeThumbSize: 'default',
                    });
                },
            });

            $("#deskripsi").summernote({
                placeholder: 'Tulis ulasan Anda disini...',
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

            @if(session('pengerjaan'))
            swal('Sukses!', '{{ session('pengerjaan') }}', 'success');
            $("#pengerjaan-tab").click();
            @endif
        });

        function batalkanPesanan(url, judul) {
            swal({
                title: 'Batalkan Pesanan',
                text: 'Apakah Anda yakin akan membatalkan pesanan layanan "' + judul + '"? ' +
                    'Anda tidak dapat mengembalikannya!',
                icon: 'warning',
                dangerMode: true,
                buttons: ["Tidak", "Ya"],
                closeOnEsc: false,
                closeOnClickOutside: false,
            }).then((confirm) => {
                if (confirm) {
                    swal({icon: "success", buttons: false});
                    window.location.href = url;
                }
            });
        }

        function ulasHasil(id, action, data_url, judul) {
            $.get(data_url, function (data) {
                $("#judul").text(judul);
                $("#rating input[type=radio]").filter('[value="' + data.bintang + '"]').attr('checked', 'checked');
                $("#deskripsi").summernote('code', data.deskripsi);
                $("#dt-pengerjaan").toggle(300);
                $("#ulas-hasil").toggle(300);
                $("#ulas-hasil form").attr('action', action);

                $('html,body').animate({scrollTop: $(".none-margin").offset().top}, 500);
            });
        }

        $("#ulas-hasil button[type=reset]").on('click', function () {
            $("#judul").text(null);
            $("#rating input[type=radio]").removeAttr('checked');
            $("#deskripsi").summernote('code', null);
            $("#dt-pengerjaan").toggle(300);
            $("#ulas-hasil").toggle(300);
            $("#ulas-hasil form").removeAttr('action');

            $('html,body').animate({scrollTop: $(".none-margin").offset().top}, 500);
        });

        $("#ulas-hasil form").on('submit', function (e) {
            e.preventDefault();
            if ($('#deskripsi').summernote('isEmpty')) {
                swal('PERHATIAN!', 'Deskripsi ulasan Anda tidak boleh kosong!', 'warning');
            } else {
                $(this)[0].submit();
            }
        });

        $("#pengerjaan-tab").on('shown.bs.tab', function () {
            var file_hasil = $(".use-lightgallery");
            file_hasil.masonry({
                itemSelector: '.item'
            });
            file_hasil.lightGallery({
                selector: '.item',
                loadYoutubeThumbnail: true,
                youtubeThumbSize: 'default',
            });
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

        function goToAnchor() {
            $('html,body').animate({scrollTop: $(".none-margin").offset().top}, 500);
        }
    </script>
@endpush
