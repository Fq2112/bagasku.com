<?php

namespace App\Http\Controllers\Pages\Users;

use App\Http\Controllers\Controller;
use App\Model\Bid;
use App\Model\Pengerjaan;
use App\Model\PengerjaanLayanan;
use App\Model\Undangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $bid = Bid::where('user_id', $user->id)->get();
        $undangan = Undangan::where('user_id', $user->id)->get();
        $pengerjaan_proyek = Pengerjaan::where('user_id', $user->id)->get();
        $pengerjaan_layanan = PengerjaanLayanan::whereHas('get_service', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->get();

        return view('pages.main.users.dashboard', compact('user', 'bid', 'undangan',
            'pengerjaan_proyek', 'pengerjaan_layanan'));
    }
}
