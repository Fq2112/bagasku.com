<script>
    @if(session('biodata'))
    swal({
        title: "PERHATIAN!",
        text: "{{session('biodata')}}",
        icon: 'warning',
        closeOnEsc: false,
        closeOnClickOutside: false,
    }).then((confirm) => {
        if (confirm) {
            swal({icon: "success", text: 'Anda akan dialihkan ke halaman Biodata.', buttons: false});
            window.location.href = '{{route('user.biodata')}}';
        }
    });

    @elseif(session('signed'))
    swal('Telah Masuk!', 'Halo {{Auth::user()->name}}! Anda telah masuk.', 'success');

    @elseif(session('expire'))
    swal('Autentikasi Dibutuhkan!', '{{ session('expire') }}', 'error');

    @elseif(session('logout'))
    swal('Telah Keluar!', '{{ session('logout') }}', 'warning');

    @elseif(session('status'))
    swal('Sukses!', '{{ session('status') }}', 'success', '3500');

    @elseif(session('update'))
    swal('Sukses!', '{{ session('update') }}', 'success');

    @elseif(session('delete'))
    swal('Sukses!', '{{ session('delete') }}', 'success');

    @elseif(session('warning'))
    swal('PERHATIAN!', '{{ session('warning') }}', 'warning');

    @elseif(session('success'))
    swal('Sukses!', '{{ session('success') }}', 'success');
    @endif

    @if (count($errors) > 0)
    @foreach ($errors->all() as $error)
    swal('Oops..!', '{{ $error }}', 'error');
    @endforeach
    @endif
</script>
