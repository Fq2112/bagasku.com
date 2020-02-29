@extends('layouts.mst')
@section('title', 'Dashboard: '.$user->name.' | '.env('APP_TITLE'))
@push('styles')
    <link rel="stylesheet" href="{{asset('css/card.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-tabs-responsive.css')}}">
    <link rel="stylesheet" href="{{asset('admins/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/modules/datatables/Select-1.2.4/css/select.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/modules/datatables/Buttons-1.5.6/css/buttons.bootstrap.min.css')}}">
    <style>
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .btn-link {
            border:1px solid #ccc;
        }

        .custom-control {
            position: relative;
            display: block;
            min-height: 1.5rem;
            padding-left: 1.5rem;
        }

        .custom-control-inline {
            display: -ms-inline-flexbox;
            display: inline-flex;
            margin-right: 1rem;
        }

        .custom-control-input {
            position: absolute;
            z-index: -1;
            opacity: 0;
        }

        .custom-control-input:checked ~ .custom-control-label::before {
            color: #fff;
            background-color: #122752;
        }

        .custom-control-input:focus ~ .custom-control-label::before {
            box-shadow: 0 0 0 1px #fff, 0 0 0 0.2rem rgba(18, 39, 82, 0.25);
        }

        .custom-control-input:active ~ .custom-control-label::before {
            color: #fff;
            background-color: #377aff;
        }

        .custom-control-input:disabled ~ .custom-control-label {
            color: #6c757d;
        }

        .custom-control-input:disabled ~ .custom-control-label::before {
            background-color: #e9ecef;
        }

        .custom-control-label {
            position: relative;
            margin-bottom: 0;
        }

        .custom-control-label::before {
            position: absolute;
            top: 0.25rem;
            left: -1.5rem;
            display: block;
            width: 1rem;
            height: 1rem;
            pointer-events: none;
            content: "";
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: #dee2e6;
        }

        .custom-control-label::after {
            position: absolute;
            top: 0.25rem;
            left: -1.5rem;
            display: block;
            width: 1rem;
            height: 1rem;
            content: "";
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 50% 50%;
        }

        .custom-checkbox .custom-control-label::before {
            border-radius: 0.25rem;
        }

        .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #122752;
        }

        .custom-checkbox .custom-control-input:checked ~ .custom-control-label::after {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3E%3C/svg%3E");
        }

        .custom-checkbox .custom-control-input:indeterminate ~ .custom-control-label::before {
            background-color: #122752;
        }

        .custom-checkbox .custom-control-input:indeterminate ~ .custom-control-label::after {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 4'%3E%3Cpath stroke='%23fff' d='M0 2h4'/%3E%3C/svg%3E");
        }

        .custom-checkbox .custom-control-input:disabled:checked ~ .custom-control-label::before {
            background-color: rgba(18, 39, 82, 0.5);
        }

        .custom-checkbox .custom-control-input:disabled:indeterminate ~ .custom-control-label::before {
            background-color: rgba(18, 39, 82, 0.5);
        }
    </style>
@endpush
@section('content')
    <div class="breadcrumbs" style="background-image: url('{{$user->get_bio->latar_belakang != null ?
    asset('storage/users/latar_belakang/'.$user->get_bio->latar_belakang) : asset('images/slider/beranda-proyek.jpg')}}')">
        <div class="breadcrumbs-overlay"></div>
        <div class="page-title">
            <h2>Dashboard: {{$user->username}}</h2>
            <p>Halaman ini menampilkan daftar bid yang telah Anda kirimkan dan juga daftar undangan tugas/proyek yang Anda terima.</p>
        </div>
        <ul class="crumb">
            <li><a href="{{route('beranda')}}"><i class="fa fa-home"></i></a></li>
            <li><i class="fa fa-angle-double-right"></i> <a href="{{route('beranda')}}">Beranda</a></li>
            <li><i class="fa fa-angle-double-right"></i> <a href="{{route('user.dashboard')}}">Dashboard</a></li>
            <li><a href="#" onclick="goToAnchor()"><i class="fa fa-angle-double-right"></i> Daftar Bid & Undangan</a></li>
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
                                <a class="nav-item nav-link" href="#bid" id="bid-tab" role="tab"
                                   data-toggle="tab" aria-controls="bid" aria-expanded="true">
                                    <i class="fa fa-paper-plane mr-2"></i>BID <span class="badge badge-secondary">
                                        {{count($bid) > 999 ? '999+' : count($bid)}}</span></a>
                            </li>
                            <li role="presentation" class="next">
                                <a class="nav-item nav-link" href="#undangan" id="undangan-tab" role="tab"
                                   data-toggle="tab" aria-controls="undangan" aria-expanded="true">
                                    <i class="fa fa-envelope mr-2"></i>UNDANGAN <span class="badge badge-secondary">
                                        {{count($undangan) > 999 ? '999+' : count($undangan)}}</span></a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="bid" aria-labelledby="bid-tab"
                                 style="border: none">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="dt-buttons">
                                        <thead>
                                        <tr>
                                            <th class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" class="custom-control-input" id="cb-all">
                                                    <label for="cb-all" class="custom-control-label">#</label>
                                                </div>
                                            </th>
                                            <th class="text-center">ID</th>
                                            <th>Tugas/Proyek</th>
                                            <th>Waktu Pengerjaan</th>
                                            <th class="text-right">Harga (Rp)</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $no = 1; @endphp
                                        @foreach($bid as $row)
                                            <tr>
                                                <td style="vertical-align: middle" align="center">
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" id="cb-{{$row->id}}"
                                                               class="custom-control-input dt-checkboxes">
                                                        <label for="cb-{{$row->id}}"
                                                               class="custom-control-label">{{$no++}}</label>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle" align="center">{{$row->id}}</td>
                                                <td style="vertical-align: middle">
                                                    <b>{{$row->get_project->judul}}</b></td>
                                                <td style="vertical-align: middle">{{$row->get_project->waktu_pengerjaan}} hari</td>
                                                <td style="vertical-align: middle" align="right">
                                                    {{number_format($row->get_project->harga,2,',','.')}}</td>
                                                <td style="vertical-align: middle" align="center">
                                                    @if($row->tolak == null)
                                                        <span class="label label-warning">PROSES</span>
                                                    @elseif($row->tolak == true)
                                                        <span class="label label-danger">DITOLAK</span>
                                                    @else
                                                        <span class="label label-success">DITERIMA</span>
                                                    @endif
                                                </td>
                                                <td style="vertical-align: middle" align="center">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <a class="btn btn-link btn-sm" data-toggle="tooltip"
                                                               title="Lihat Proyek" href="#"><i class="fa fa-info" style="margin-right: 0"></i></a>
                                                            <a class="btn btn-link btn-sm delete-data"
                                                               data-toggle="tooltip" title="Hapus Bid"
                                                               href="#"><i class="fa fa-trash-alt" style="margin-right: 0"></i></a>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <form method="post" id="form-bid">
                                        @csrf
                                        <input type="hidden" name="bid_ids">
                                    </form>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="undangan" aria-labelledby="undangan-tab"
                                 style="border: none">
                                @if(count($undangan) > 0)
                                    <div class="row">
                                        @foreach($undangan as $row)
                                        @endforeach
                                    </div>
                                @else
                                    <p>Anda belum mendapatkan undangan tugas/proyek apapun, baik yang bersifat publik maupun privat.</p>
                                @endif
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
    <script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
    <script>
        $(function () {
            var export_bid = 'Daftar Bid Tugas/Proyek ({{now()->format('j F Y')}})', bid_dt = $("#dt-buttons").DataTable({
                dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-5'B><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                columnDefs: [
                    {"sortable": false, "targets": 6},
                    {targets: 1, visible: false, searchable: false}
                ],
                buttons: [
                    {
                        text: '<b class="text-uppercase"><i class="far fa-file-excel mr-2"></i>Excel</b>',
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5]
                        },
                        className: 'btn btn-link btn-sm assets-export-btn export-xls ttip',
                        title: export_bid,
                        extension: '.xls'
                    }, {
                        text: '<b class="text-uppercase"><i class="fa fa-print mr-2"></i>Cetak</b>',
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5]
                        },
                        className: 'btn btn-link btn-sm assets-select-btn export-print'
                    }, {
                        text: '<b class="text-uppercase"><i class="fa fa-trash-alt mr-2"></i>Hapus</b>',
                        className: 'btn btn-link btn-sm btn_massDelete'
                    }
                ],
                fnDrawCallback: function (oSettings) {
                    $('.use-nicescroll').getNiceScroll().resize();
                    $('[data-toggle="tooltip"]').tooltip();

                    $("#cb-all").on('click', function () {
                        if ($(this).is(":checked")) {
                            $("#dt-buttons tbody tr").addClass("terpilih")
                                .find('.dt-checkboxes').prop("checked", true).trigger('change');
                        } else {
                            $("#dt-buttons tbody tr").removeClass("terpilih")
                                .find('.dt-checkboxes').prop("checked", false).trigger('change');
                        }
                    });

                    $("#dt-buttons tbody tr").on("click", function () {
                        $(this).toggleClass("terpilih");
                        if ($(this).hasClass('terpilih')) {
                            $(this).find('.dt-checkboxes').prop("checked", true).trigger('change');
                        } else {
                            $(this).find('.dt-checkboxes').prop("checked", false).trigger('change');
                        }
                    });

                    $('.dt-checkboxes').on('click', function () {
                        if ($(this).is(':checked')) {
                            $(this).parent().parent().parent().addClass("terpilih");
                        } else {
                            $(this).parent().parent().parent().removeClass("terpilih");
                        }
                    });

                    $('.btn_massDelete').on("click", function () {
                        var ids = $.map(bid_dt.rows('.terpilih').data(), function (item) {
                            return item[1]
                        });
                        $("#form-bid input[name=bid_ids]").val(ids);
                        $("#form-bid").attr("action", "#");

                        if (ids.length > 0) {
                            swal({
                                title: 'Hapus Bid',
                                text: 'Apakah Anda yakin untuk menghapus ' + ids.length + ' data tersebut? Anda tidak dapat mengembalikannya!',
                                icon: 'warning',
                                dangerMode: true,
                                buttons: ["Tidak", "Ya"],
                                closeOnEsc: false,
                                closeOnClickOutside: false,
                            }).then((confirm) => {
                                if (confirm) {
                                    swal({icon: "success", buttons: false});
                                    $("#form-bid")[0].submit();
                                }
                            });
                        } else {
                            $("#cb-all").prop("checked", false).trigger('change');
                            swal("Error!", "Tidak ada data yang dipilih!", "error");
                        }
                    });
                },
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
