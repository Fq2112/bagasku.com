@section('title', 'Pengaturan Akun: '.$user->name.' | '.env('APP_TITLE'))
@extends('layouts.auth.mst_user')
@section('inner-content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 text-center">
            @include('layouts.auth.partials._form-foto-user')
        </div>
        <div class="col-lg-9 col-md-6 col-sm-12">
            <div class="card">
                <form class="form-horizontal" role="form" method="POST" id="form-password">
                    @csrf
                    {{ method_field('put') }}
                    <div class="card-content">
                        <div class="card-title">
                            <small style="font-weight: 600">Pengaturan Akun</small>
                            <hr class="mt-0">
                            <small>E-mail Utama (terverifikasi)</small>
                            <div class="row form-group has-feedback">
                                <div class="col-md-12">
                                    <input type="email" class="form-control" value="{{$user->email}}" disabled>
                                    <span class="glyphicon glyphicon-check form-control-feedback"></span>
                                </div>
                            </div>

                            <small style="cursor: pointer; color: #122752" id="show_password_settings">Ubah Kata Sandi ?
                            </small>
                            <div id="password_settings" style="display: none">
                                <div id="error_curr_pass" class="row form-group has-feedback">
                                    <div class="col-md-12">
                                        <input placeholder="Kata sandi lama" id="check_password" type="password"
                                               class="form-control" name="password" minlength="6" required autofocus>
                                        <span class="glyphicon glyphicon-eye-open form-control-feedback"
                                              style="pointer-events: all;cursor: pointer"></span>
                                        <span class="help-block">
                                            <strong class="aj_pass" style="text-transform: none"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div id="error_new_pass" class="row form-group has-feedback">
                                    <div class="col-md-12">
                                        <input placeholder="Kata sandi baru" id="password" type="password"
                                               class="form-control" name="new_password" minlength="6" required>
                                        <span class="glyphicon glyphicon-eye-open form-control-feedback"
                                              style="pointer-events: all;cursor: pointer"></span>
                                        @if ($errors->has('new_password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('new_password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <input placeholder="Ulangi kata sandi baru" id="password-confirm" type="password"
                                               class="form-control" name="password_confirmation" minlength="6" required
                                               onkeyup="return checkPassword()">
                                        <span class="glyphicon glyphicon-eye-open form-control-feedback"
                                              style="pointer-events: all;cursor: pointer"></span>
                                        <span class="help-block">
                                            <strong class="aj_new_pass" style="text-transform: none"></strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-0">
                        <button id="btn_save_password" class="btn btn-dark-red btn-block" disabled>
                            <i class="fa fa-lock mr-2"></i>SIMPAN PERUBAHAN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    @include('layouts.auth.partials._scripts')
    <script>
        $("#show_password_settings").on('click', function () {
            $(this).text(function (i, v) {
                return v === "PENGATURAN KATA SANDI" ? "Ubah Kata Sandi ?" : "PENGATURAN KATA SANDI";
            });
            if ($(this).text() === 'Ubah Kata Sandi ?') {
                this.style.color = "#122752";
            } else {
                this.style.color = "#7f7f7f";
            }

            $("#password_settings").toggle(300);
            if ($("#btn_save_password").attr('disabled')) {
                $("#btn_save_password").removeAttr('disabled');
            } else {
                $("#btn_save_password").attr('disabled', 'disabled');
            }
        });

        $('#check_password + .glyphicon').on('click', function () {
            $(this).toggleClass('glyphicon-eye-open glyphicon-eye-close');
            $('#check_password').togglePassword();
        });

        $('#password + .glyphicon').on('click', function () {
            $(this).toggleClass('glyphicon-eye-open glyphicon-eye-close');
            $('#password').togglePassword();
        });

        $('#password-confirm + .glyphicon').on('click', function () {
            $(this).toggleClass('glyphicon-eye-open glyphicon-eye-close');
            $('#password-confirm').togglePassword();
        });

        function checkPassword() {
            var new_pas = $("#password").val(),
                re_pas = $("#password-confirm").val();
            if (new_pas != re_pas) {
                $("#password, #password-confirm").addClass('is-invalid');
                $("#error_new_pass").addClass('has-danger');
                $(".aj_new_pass").text("Konfirmasi password harus sama dengan password baru Anda!").parent().show();
                $("#btn_save_password").attr('disabled', 'disabled');
            } else {
                $("#password, #password-confirm").removeClass('is-invalid');
                $("#error_new_pass").removeClass('has-danger');
                $(".aj_new_pass").text("").parent().hide();
                $("#btn_save_password").removeAttr('disabled');
            }
        }
    </script>
@endpush
