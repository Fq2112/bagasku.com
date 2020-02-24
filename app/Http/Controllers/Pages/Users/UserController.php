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

    public function updateProfil(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        if ($request->hasFile('latar_belakang')) {
            $this->validate($request, [
                'latar_belakang' => 'image|mimes:jpg,jpeg,gif,png|max:2048',
            ]);

            $name = $request->file('latar_belakang')->getClientOriginalName();

            if ($user->get_bio->latar_belakang != '') {
                Storage::delete('public/users/latar_belakang/' . $user->get_bio->latar_belakang);
            }

            if ($request->file('latar_belakang')->isValid()) {
                $request->latar_belakang->storeAs('public/users/latar_belakang', $name);
                $user->get_bio->update(['latar_belakang' => $name]);
                return asset('storage/users/latar_belakang/' . $name);
            }

        } else {
            if ($request->check_form == 'kontak') {
                $user->get_bio->update([
                    'hp' => $request->hp,
                    'alamat' => $request->alamat,
                    'kode_pos' => $request->kode_pos,
                    'kota_id' => $request->kota_id,
                ]);

            } elseif ($request->check_form == 'personal') {
                $user->update(['name' => $request->name]);
                $user->get_bio->update([
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'kewarganegaraan' => $request->kewarganegaraan,
                    'website' => $request->website,
                ]);

            } elseif ($request->check_form == 'summary') {
                $user->get_bio->update(['summary' => $request->summary]);

            } elseif ($request->check_form == 'status') {
                $user->get_bio->update(['status' => $request->status]);
            }
        }

        return back()->with('update', 'Data ' . $request->check_form . ' Anda berhasil diperbarui!');
    }

    public function tambahBahasa(Request $request)
    {
        Bahasa::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'tingkatan' => $request->tingkatan,
        ]);

        return back()->with('update', 'Kemampuan berbahasa [' . $request->nama . '] berhasil ditambahkan!');
    }

    public function updateBahasa(Request $request)
    {
        $bahasa = Bahasa::find($request->id);
        $bahasa->update([
            'nama' => $request->nama,
            'tingkatan' => $request->tingkatan,
        ]);

        return back()->with('update', 'Kemampuan berbahasa [' . $bahasa->nama . '] Anda berhasil diperbarui!');
    }

    public function hapusBahasa($id)
    {
        $bahasa = Bahasa::find(decrypt($id));
        $bahasa->delete();

        return back()->with('delete', 'Kemampuan berbahasa [' . $bahasa->nama . '] Anda berhasil dihapus!');
    }

    public function tambahSkill(Request $request)
    {
        Skill::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'tingkatan' => $request->tingkatan,
        ]);

        return back()->with('update', 'Skill [' . $request->nama . '] berhasil ditambahkan!');
    }

    public function updateSkill(Request $request)
    {
        $skill = Skill::find($request->id);
        $skill->update([
            'nama' => $request->nama,
            'tingkatan' => $request->tingkatan,
        ]);

        return back()->with('update', 'Skill [' . $skill->nama . '] Anda berhasil diperbarui!');
    }

    public function hapusSkill($id)
    {
        $skill = Skill::find(decrypt($id));
        $skill->delete();

        return back()->with('delete', 'Skill [' . $skill->nama . '] Anda berhasil dihapus!');
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
