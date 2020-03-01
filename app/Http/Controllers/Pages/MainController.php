<?php

namespace App\Http\Controllers\Pages;

use App\Model\Bio;
use App\Model\Project;
use App\Model\Services;
use App\Model\Testimoni;
use App\Support\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index()
    {
        $proyek = Project::where('pribadi', false)->doesntHave('get_pengerjaan')->orderByDesc('id')->take(8)->get();
        $layanan = Services::orderByDesc('id')->take(8)->get();
        $pekerja = Bio::whereHas('get_user', function ($q) {
            $q->where('role', Role::OTHER);
        })->where('total_bintang_pekerja', '>', 0)->orderByDesc('total_bintang_pekerja')->take(8)->get();

        $testimoni = Testimoni::where('bintang', '>', 3)->orderByDesc('id')->take(12)->get();
        if (Auth::check()) {
            $cek = Testimoni::where('user_id', Auth::id())->first();
        } else {
            $cek = null;
        }

        return view('pages.main.beranda', compact('proyek', 'layanan', 'pekerja', 'testimoni', 'cek'));
    }

    public function tentang()
    {
        $testimoni = Testimoni::where('bintang', '>', 3)->orderByDesc('id')->take(12)->get();
        if (Auth::check()) {
            $cek = Testimoni::where('user_id', Auth::id())->first();
        } else {
            $cek = null;
        }

        return view('pages.info.tentang', compact('testimoni', 'cek'));
    }

    public function caraKerja()
    {
        return view('pages.info.cara-kerja');
    }

    public function ketentuanLayanan()
    {
        return view('pages.info.ketentuan-layanan');
    }

    public function kebijakanPrivasi()
    {
        return view('pages.info.kebijakan-privasi');
    }

    public function kirimTestimoni(Request $request)
    {
        if ($request->check_form == 'create') {
            Testimoni::create([
                'user_id' => Auth::id(),
                'rate' => $request->rating,
                'comment' => $request->comment,
            ]);

            return back()->with('testimoni', 'Terima kasih ' . Auth::user()->name . ' atas ulasannya! ' .
                'Dengan begitu kami dapat berpotensi menjadi agensi yang lebih baik lagi.');

        } else {
            Testimoni::find($request->check_form)->update([
                'rate' => $request->rating,
                'comment' => $request->comment,
            ]);

            return back()->with('testimoni', 'Ulasan Anda berhasil diperbarui!');
        }
    }

    public function hapusTestimoni($id)
    {
        Testimoni::destroy(decrypt($id));

        return back()->with('testimoni', 'Ulasan Anda berhasil dihapus!');
    }

    public function kontak()
    {
        return view('pages.info.kontak');
    }

    public function kirimKontak(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'string|min:3',
            'message' => 'required'
        ]);
        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'bodymessage' => $request->message
        );
        Mail::send('emails.kontak', $data, function ($message) use ($data) {
            $message->from($data['email']);
            $message->to(env('MAIL_USERNAME'));
            $message->subject($data['subject']);
        });

        return back()->with('kontak', 'Terima kasih telah meninggalkan kami pesan! Karena setiap komentar atau kritik yang Anda berikan, akan membuat kami menjadi perusahaan yang lebih baik.');
    }
}
