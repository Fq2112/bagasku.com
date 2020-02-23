@php $kategori = \App\Model\Kategori::orderBy('nama')->get(); @endphp
<ul class="main-menu">
    <li><a class="{{\Illuminate\Support\Facades\Request::is('/*') ? 'active' : ''}}" href="{{route('beranda')}}">
            Beranda</a></li>
    <li class="menu-item-has-children">
        <a class="{{\Illuminate\Support\Facades\Request::is('proyek*') ? 'active' : ''}}" href="#">Tugas/Proyek <i
                class="fa fa-angle-down"></i></a>
        <ul class="dropdown-menu dropdown-arrow">
            @foreach($kategori as $kat)
                <li class="menu-item-has-children">
                    <a href="#">{{$kat->nama}} <i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown-menu dropdown-arrow">
                        @foreach($kat->get_sub as $row)
                            <li><a href="#">{{$row->nama}}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </li>
    <li class="menu-item-has-children">
        <a class="{{\Illuminate\Support\Facades\Request::is('layanan*') ? 'active' : ''}}" href="#">Layanan <i
                class="fa fa-angle-down"></i></a>
        <ul class="dropdown-menu dropdown-arrow">
            @foreach($kategori as $kat)
                <li class="menu-item-has-children">
                    <a href="#">{{$kat->nama}} <i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown-menu dropdown-arrow">
                        @foreach($kat->get_sub as $row)
                            <li><a href="#">{{$row->nama}}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </li>
    <li class="menu-item-has-children">
        <a class="{{\Illuminate\Support\Facades\Request::is('produk*') ? 'active' : ''}}" href="#">Produk <i
                class="fa fa-angle-down"></i></a>
        <ul class="dropdown-menu dropdown-arrow">
            @foreach($kategori as $kat)
                <li class="menu-item-has-children">
                    <a href="#">{{$kat->nama}} <i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown-menu dropdown-arrow">
                        @foreach($kat->get_sub as $row)
                            <li><a href="#">{{$row->nama}}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </li>

    @auth
        <li class="menu-item-has-children avatar">
            <a href="javascript:void(0)">
                <img class="img-thumbnail show_ava" src="{{Auth::user()->get_bio->foto != "" ?
                asset('storage/users/foto/'.Auth::user()->get_bio->foto) :
                asset('images/faces/thumbs50x50/'.rand(1,6).'.jpg')}}">
                {{Auth::user()->name}} <i class="fa fa-angle-down"></i></a>
            <ul class="dropdown-menu dropdown-arrow">
                <li><a href="{{Auth::user()->isRoot() || Auth::user()->isAdmin() ? route('admin.dashboard') :
                route('user.dashboard')}}"><i class="fa fa-tachometer-alt mr-2"></i>Dashboard</a></li>
                <li><a href="{{Auth::user()->isRoot() || Auth::user()->isAdmin() ? route('admin.edit.profile') :
                route('user.profil')}}"><i class="fa fa-user-edit mr-2"></i>Sunting Profil</a></li>
                <li><a href="{{Auth::user()->isRoot() || Auth::user()->isAdmin() ? route('admin.settings') :
                route('user.pengaturan')}}"><i class="fa fa-cogs mr-2"></i>Pengaturan Akun</a></li>
                <li class="dropdown-divider"></li>
                <li>
                    <a href="#" class="btn_signOut"><i class="fa fa-sign-out-alt"></i>&ensp;Keluar</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    @else
        <li><a href="javascript:void(0)" data-toggle="modal" onclick="openLoginModal();">Masuk</a></li>
        <li>
            <div class="get-btn">
                <a href="javascript:void(0)" data-toggle="modal" onclick="openRegisterModal();">Gabung</a>
            </div>
        </li>
    @endif
</ul>
