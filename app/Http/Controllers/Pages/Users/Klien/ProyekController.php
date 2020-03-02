<?php

namespace App\Http\Controllers\Pages\Users\Klien;

use App\Http\Controllers\Controller;
use App\Model\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyekController extends Controller
{
    public function __construct()
    {
        $this->middleware('user.bio')->except('dashboard');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $proyek = Project::where('user_id', $user->id)->get();

        return view('pages.main.users.klien.proyek', compact('user', 'proyek'));
    }
}
