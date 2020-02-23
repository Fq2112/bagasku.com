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

    <form action="{{route('user.update.profil')}}" method="post">
        @csrf
        {{method_field('PUT')}}
        <input type="hidden" name="check_form" value="status">
        <div class="card-content">
            <div class="card-title text-center">
                <a href="{{route('user.profil')}}">
                    <h4 class="aj_name" style="color: #122752">{{$user->name}}</h4></a>
                <small>{{$user->get_bio->status != "" ? $user->get_bio->status : 'Status (-)'}}</small>
            </div>
            <div class="card-title">
                <div id="show_status_settings" class="row justify-content-center"
                     style="color: #122752;cursor: pointer;font-size: 14px">
                    <div class="col-md-12 text-right"><i class="fa fa-edit mr-2"></i>SUNTING</div>
                </div>
                <div id="status_settings" class="input-group" style="display: none">
                    <input id="status" type="text" class="form-control" name="status"
                           placeholder="Tulis status Anda disini&hellip;" value="{{$user->get_bio->status}}">
                    <span class="input-group-btn">
                        <button id="btn_save_status" class="btn btn-link btn-sm btn-block" type="submit"
                                style="border: 1px solid #ccc"><i class="fa fa-bullhorn"></i></button>
                    </span>
                </div>
                <a href="#" id="btn_mode_publik" class="btn btn-link btn-sm btn-block"
                   style="border: 1px solid #ccc">Lihat Mode Publik</a>
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
    </form>
</div>
