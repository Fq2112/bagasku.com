<?php

namespace App\Http\Controllers\Pages\Users\Klien;

use App\Http\Controllers\Controller;
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

        return view('pages.main.users.klien.layanan', compact('user'));
    }
}
