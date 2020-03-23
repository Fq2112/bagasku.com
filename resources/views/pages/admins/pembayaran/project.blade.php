@extends('layouts.mst_admin')
@section('title', 'Admin '.env('APP_NAME').': Kelola Data Pembayaran Project | '.env('APP_TITLE'))

@push('styles')
    <style></style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kelola Data Pembayaran Project</h1>
        </div>

        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pembayaran Project</h4>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped" id="dt-order">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>Nama Proyek</th>
                                    <th>Klien</th>
                                    <th>Pekerja</th>
                                    <th>Status Pengerjaan</th>
                                    <th>Status Pembayaran</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($project as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{$item->get_project->judul}}</td>
                                        <td>{{$item->get_project->get_user->name}}</td>
                                        <td>{{$item->get_project->get_pengerjaan->get_user->name}}</td>
                                        <td>@if($item->get_project->get_pengerjaan->selesai == 1)
                                                <div class="badge badge-success"  data-toggle="tooltip"
                                                     title="Pengerjaan Proyek Telah Selesai"><i class="fa fa-check-circle"></i></div>
                                                @else
                                                <div class="badge badge-danger"  data-toggle="tooltip"
                                                     title="Pengerjaan Proyek Belum Selesai"><i class="fa fa-times-circle"></i></div>
                                            @endif</td>
                                        <td>@if($item->jumlah_pembayaran < $item->get_project->harga)
                                                {{--                                                belum lunas--}}
                                                <div class="badge badge-danger">Belum Lunas</div>
                                            @else
                                                <div class="badge badge-info">Lunas</div>
                                            @endif
                                            @if($item->bukti_pembayaran == null)
                                                <div class="badge badge-warning">Belum Dibayarkan</div>
                                            @else
                                                <div class="badge badge-primary">Telah Dibayarkan</div>
                                            @endif
                                        </td>
                                        <td>{{$item->created_at->diffForHumans()}}</td>
                                        <th>
                                            @if($item->bukti_pembayaran == null)
                                                <button class="btn btn-primary btn-icon" data-toggle="tooltip"
                                                        title="Konfimasi Pengelesaian Proyek"
                                                        onclick="action_modal('{{$item->id}}','{{$item->jumlah_pembayaran}}','{{$item->dp}}')"><i
                                                        class="fa fa-cog"></i></button>

                                            @else
                                                <button class="btn btn-success btn-icon" data-toggle="tooltip"
                                                        title="Pekerja Telah Dibayar"
                                                        onclick=""><i
                                                        class="fa fa-check-circle"></i></button>
                                            @endif
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <form class="modal-part" id="modal-add-admin">
                @CSRF
                <div class="form-group">
                    <label>Nama</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Admin.... " name="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="adm.... " name="username" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-envelope"></i>
                            </div>
                        </div>
                        <input type="email" class="form-control" placeholder="admin@email.com" name="email" required>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{asset('admins/modules/datatables/datatables.js')}}"></script>
    <script src="{{asset('admins/js/page/modules-datatables.js')}}"></script>

    <script !src="">

        $("#dt-order").DataTable({
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

        function action_modal(id,name,dates) {
            console.log(id,name,dates);
            $("#modalProsesProject").modal('show');
        }
    </script>
@endpush
