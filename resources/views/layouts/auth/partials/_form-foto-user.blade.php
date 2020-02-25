<div class="card">
    <form class="form-horizontal" role="form" method="POST" id="form-ava" enctype="multipart/form-data">
        @csrf
        {{ method_field('put') }}
        <div class="img-card image-upload">
            <label for="file-input">
                <img style="width: 100%" class="show_ava" alt="Avatar" src="{{$user->get_bio->foto == "" ?
                asset('images/faces/thumbs50x50/'.rand(1,6).'.jpg') : asset('storage/users/foto/'.$user->get_bio->foto)}}"
                     data-placement="bottom" data-toggle="tooltip" title="Klik disini untuk mengubah foto Anda!">
            </label>
            <input id="file-input" name="foto" type="file" accept="image/*">
            <div id="progress-upload">
                <div class="progress-bar progress-bar-info progress-bar-striped active"
                     role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                     style="background-color: #122752;z-index: 20">
                </div>
            </div>
        </div>
    </form>

    <div class="card-content">
        <div class="card-title text-center">
            <a href="{{route('user.profil')}}">
                <h4 class="aj_name" style="color: #122752">{{$user->name}}</h4></a>
            @if(\Illuminate\Support\Facades\Request::is('akun/profil'))
                <small
                    style="text-transform: none">{{$user->get_bio->status != "" ? $user->get_bio->status : 'Status (-)'}}</small>
            @else
                <small style="text-transform: none">
                    <a class="show_username"
                       href="{{route('profil.user', ['username' => $user->username])}}">{{$user->username}}</a>
                </small>
            @endif
        </div>
        <div class="card-title">
            @if(\Illuminate\Support\Facades\Request::is('akun/profil'))
                <form action="{{route('user.update.profil')}}" class="form-horizontal" role="form" method="POST">
                    @csrf
                    {{method_field('PUT')}}
                    <input type="hidden" name="check_form" value="status">
                    <div id="show_status_settings" class="row" style="color: #122752;cursor: pointer;font-size: 14px">
                        <div class="col-md-12 text-right"><i class="fa fa-edit mr-2"></i>UBAH STATUS</div>
                    </div>
                    <div id="status_settings" style="display: none">
                        <div class="row form-group has-feedback">
                            <div class="col-md-12">
                                <input id="status" type="text" class="form-control" name="status"
                                       placeholder="Tulis status Anda disini&hellip;"
                                       value="{{$user->get_bio->status}}">
                                <span class="glyphicon glyphicon-bullhorn form-control-feedback"></span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <button id="btn_save_status" class="btn btn-link btn-sm btn-block" type="submit"
                                        style="border: 1px solid #ccc"><i class="fa fa-bullhorn mr-2"></i>SIMPAN
                                    PERUBAHAN
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <form class="form-horizontal" role="form" method="POST" id="form-username">
                    @csrf
                    {{ method_field('put') }}
                    <div id="show_username_settings" class="row" style="color: #122752;cursor: pointer;font-size: 14px">
                        <div class="col-md-12 text-right"><i class="fa fa-edit mr-2"></i>UBAH USERNAME</div>
                    </div>
                    <div id="username_settings" style="display: none">
                        <div id="error_username" class="row form-group has-feedback" style="margin-bottom: 0">
                            <div class="col-md-12">
                                <input id="username" type="text" class="form-control" name="username"
                                       placeholder="Username" value="{{$user->username}}" minlength="4" required>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                <span class="help-block">
                                <strong class="strong-error" id="aj_username" style="text-transform: none"></strong>
                            </span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <button id="btn_save_username" class="btn btn-link btn-sm btn-block" type="submit"
                                        style="border: 1px solid #ccc"><i class="fa fa-user-lock mr-2"></i>SIMPAN
                                    PERUBAHAN
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
            <a href="{{route('profil.user', ['username' => $user->username])}}" id="btn_mode_publik"
               class="btn btn-link btn-sm btn-block" style="border: 1px solid #ccc">Lihat Mode Publik</a>
            <hr style="margin: 10px 0">
            <table class="stats" style="font-size: 14px; margin-top: 0">
                <tr data-toggle="tooltip" title="Berasal dari">
                    <td><i class="fa fa-map-marked-alt"></i></td>
                    <td>&nbsp;</td>
                    <td style="text-transform: none;">{{$user->get_bio->kota_id != "" ?
                        $user->get_bio->get_kota->nama.', '.$user->get_bio->get_kota->get_provinsi->nama : '(kosong)'}}
                    </td>
                </tr>
                <tr data-toggle="tooltip" title="Bergabung sejak">
                    <td><i class="fa fa-calendar-check"></i></td>
                    <td>&nbsp;</td>
                    <td style="text-transform: none;">{{$user->created_at->format('j F Y')}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
