<?php

namespace App\Http\Controllers\Pages\Users\Klien;

use App\Http\Controllers\Controller;
use App\Model\PengerjaanLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayananController extends Controller
{
    public function __construct()
    {
        $this->middleware('user.bio')->except('dashboard');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $pesanan = PengerjaanLayanan::where('user_id', $user->id)->get();
        $pengerjaan = PengerjaanLayanan::whereHas('get_pembayaran')->where('user_id', $user->id)->get();

        return view('pages.main.users.klien.layanan', compact('user', 'pesanan', 'pengerjaan'));
    }
}
