<script>
    $(function () {
        Scrollbar.initAll();

        $('.datepicker').datepicker();

        $("#jenis_kelamin, #tingkatan_bahasa, #tingkatan_skill").select2({
            placeholder: "-- Pilih --",
            allowClear: true,
            width: '100%',
        });

        $("#summary").summernote({
            airMode: true
        });
    });

    $("#show_status_settings").on('click',function () {
        $("#status_settings").toggle(300);
        $("#btn_mode_publik").toggle(300);
    });

    $("#show_lang_settings, #btn_cancel_lang input[type=reset]").click(function () {
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

    $("#show_skill_settings, #btn_cancel_skill input[type=reset]").click(function () {
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

    $("#show_background_settings").on('click',function () {
        $("#input-background").trigger('click');
    });

    $("#show_personal_data_settings").on('click',function () {
        $("#personal_data_settings").toggle(300);
        $("#stats_personal_data").toggle(300);
        if ($("#btn_save_personal_data").attr('disabled')) {
            $("#btn_save_personal_data").removeAttr('disabled');
        } else {
            $("#btn_save_personal_data").attr('disabled', 'disabled');
        }
    });

    $("#show_contact_settings").on('click',function () {
        $("#contact_settings").toggle(300);
        $("#stats_contact").toggle(300);
        if ($("#btn_save_contact").attr('disabled')) {
            $("#btn_save_contact").removeAttr('disabled');
        } else {
            $("#btn_save_contact").attr('disabled', 'disabled');
        }
    });

    $("#show_summary_settings").on('click',function () {
        $("#summary_settings").toggle(300);
        $("#stats_summary").toggle(300);
        if ($("#btn_save_summary").attr('disabled')) {
            $("#btn_save_summary").removeAttr('disabled');
        } else {
            $("#btn_save_summary").attr('disabled', 'disabled');
        }
    });

    $("#website").on("blur", function () {
        var $uri = $(this).val().substr(0, 4) != 'http' ? 'http://' + $(this).val() : $(this).val();
        $(this).val($uri);
    });

    $("#form-password").on("submit", function (e) {
        $.ajax({
            type: 'POST',
            url: '{{route('user.update.pengaturan')}}',
            data: new FormData($("#form-password")[0]),
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == 0) {
                    swal('Pengaturan Akun', 'Kata sandi lama Anda salah!', 'error');
                    $("#error_curr_pass").addClass('has-danger');
                    $("#error_new_pass").removeClass('has-danger');
                    $("#check_password").addClass('is-invalid');
                    $("#password, #password-confirm").removeClass('is-invalid');
                    $(".aj_pass").text("Password lama Anda salah!").parent().show();
                    $(".aj_new_pass").text("").parent().hide();

                } else if (data == 1) {
                    swal('Pengaturan Akun', 'Konfirmasi kata sandi Anda tidak cocok!', 'error');
                    $("#error_curr_pass").removeClass('has-danger');
                    $("#error_new_pass").addClass('has-danger');
                    $("#check_password").removeClass('is-invalid');
                    $("#password, #password-confirm").addClass('is-invalid');
                    $(".aj_pass").text("").parent().hide();
                    $(".aj_new_pass").text("Konfirmasi kata sandi Anda tidak cocok!").parent().show();

                } else {
                    swal('Pengaturan Akun', 'Kata sandi Anda berhasil diperbarui!', 'success');
                    $("#form-password").trigger("reset");
                    $("#error_curr_pass").removeClass('has-danger');
                    $("#error_new_pass").removeClass('has-danger');
                    $("#check_password").removeClass('is-invalid');
                    $("#password, #password-confirm").removeClass('is-invalid');
                    $(".aj_pass").text("").parent().hide();
                    $(".aj_new_pass").text("").parent().hide();
                    $("#show_password_settings").click();
                }
            },
            error: function () {
                swal('Oops...', 'Terjadi suatu kesalahan! Silahkan segarkan browser Anda.', 'error');
            }
        });
        return false;
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

    function humanFileSize(size) {
        var i = Math.floor(Math.log(size) / Math.log(1024));
        return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
    }
</script>
