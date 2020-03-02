<?php

namespace App\Http\Controllers\Pages\Users\Pekerja;

use App\Http\Controllers\Controller;
use App\Model\PengerjaanLayanan;
use App\Model\Services;
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
        $layanan = Services::where('user_id', $user->id)->get();

        return view('pages.main.users.pekerja.layanan', compact('user', 'layanan'));
    }
}
