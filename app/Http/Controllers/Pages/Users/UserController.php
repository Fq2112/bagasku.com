<?php

namespace App\Http\Controllers\Pages\Users;

use App\Http\Controllers\Controller;
use App\Model\Bahasa;
use App\Model\Negara;
use App\Model\Provinsi;
use App\Model\Skill;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function dashboard()
    {
        return null;
    }

    public function profil()
    {
        $user = Auth::user();
        $negara = Negara::all();
        $provinsi = Provinsi::all();
        $bahasa = Bahasa::where('user_id', Auth::id())->orderByDesc('id')->get();
        $skill = Skill::where('user_id', Auth::id())->orderByDesc('id')->get();

        return view('pages.main.users.sunting-profil', compact('user', 'negara', 'provinsi', 'bahasa', 'skill'));
    }

    public function pengaturan()
    {
        $user = Auth::user();

        return view('pages.main.users.pengaturan-akun', compact('user'));
    }

    public function updatePengaturan(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $img = $request->file('foto');

        if ($img == null) {
            $input = $request->all();
            if (!Hash::check($input['password'], $user->password)) {
                return 0;
            } else {
                if ($input['new_password'] != $input['password_confirmation']) {
                    return 1;
                } else {
                    $user->update(['password' => bcrypt($input['new_password'])]);
                    return 2;
                }
            }
        } else {
            $this->validate($request, [
                'foto' => 'image|mimes:jpg,jpeg,gif,png|max:2048',
            ]);

            $name = $img->getClientOriginalName();

            if ($user->get_bio->foto != '') {
                Storage::delete('public/users/foto/' . $user->get_bio->foto);
            }

            if ($img->isValid()) {
                $request->foto->storeAs('public/users/foto', $name);
                $user->get_bio->update(['foto' => $name]);
                return asset('storage/users/foto/' . $name);
            }

        }
    }
}
