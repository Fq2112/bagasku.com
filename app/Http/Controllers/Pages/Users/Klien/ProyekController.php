<?php

namespace App\Http\Controllers\Pages\Users\Klien;

use App\Http\Controllers\Controller;
use App\Mail\Users\PembayaranProyekMail;
use App\Model\Bid;
use App\Model\Kategori;
use App\Model\Pembayaran;
use App\Model\Pengerjaan;
use App\Model\Project;
use App\Model\ReviewWorker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProyekController extends Controller
{
    public function __construct()
    {
        $this->middleware('user.bio')->except('dashboard');
    }

    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $kategori = Kategori::orderBy('nama')->get();
        $proyek = Project::where('user_id', $user->id)->get();
        $req_id = $request->id;
        $req_invoice = $request->invoice;
        $req_url = $request->url;
        $req_data_url = $request->data_url;
        $req_harga = $request->harga;
        dd($proyek);

        return view('pages.main.users.klien.proyek', compact('user', 'kategori', 'proyek',
            'req_id', 'req_invoice', 'req_url', 'req_data_url', 'req_harga'));
    }

    public function tambahProyek(Request $request)
    {
        $cek = Project::where('judul', $request->judul)->where('user_id', Auth::id())->first();
        if (!$cek) {
            if ($request->hasFile('thumbnail')) {
                $this->validate($request, ['thumbnail' => 'image|mimes:jpg,jpeg,gif,png|max:2048']);
                $thumbnail = $request->file('thumbnail')->getClientOriginalName();
                $request->file('thumbnail')->storeAs('public/proyek/thumbnail', $thumbnail);
            } else {
                $thumbnail = null;
            }

            if ($request->hasFile('lampiran')) {
                $this->validate($request, [
                    'lampiran' => 'required|array',
                    'lampiran.*' => 'mimes:jpg,jpeg,gif,png,pdf,doc,docx,xls,xlsx,odt,ppt,pptx|max:5120'
                ]);

                $lampiran = [];
                $i = 0;
                foreach ($request->file('lampiran') as $file) {
                    $file->storeAs('public/proyek/lampiran', $file->getClientOriginalName());
                    $lampiran[$i] = $file->getClientOriginalName();
                    $i = 1 + $i;
                }
            } else {
                $lampiran = null;
            }

            Project::create([
                'user_id' => Auth::id(),
                'subkategori_id' => $request->subkategori_id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'waktu_pengerjaan' => $request->waktu_pengerjaan,
                'harga' => str_replace('.', '', $request->harga),
                'thumbnail' => $thumbnail,
                'lampiran' => $lampiran,
                'pribadi' => false,
            ]);
        } else {
            return back()->with('gagal', 'Tugas/Proyek [' . $request->judul . '] Anda telah tersedia! Silahkan buat tugas/proyek Anda dengan judul yang berbeda, terimakasih.');
        }

        return back()->with('create', 'Tugas/Proyek [' . $request->judul . '] Anda berhasil ditambahkan!');
    }

    public function suntingProyek(Request $request)
    {
        return Project::find($request->id);
    }

    public function updateProyek(Request $request)
    {
        $proyek = Project::find($request->id);

        $cek = Project::where('judul', $request->judul)->where('user_id', Auth::id())->where('id', '!=', $request->id)->first();
        if (!$cek) {
            if ($request->hasFile('thumbnail')) {
                $this->validate($request, ['thumbnail' => 'image|mimes:jpg,jpeg,gif,png|max:2048']);
                $thumbnail = $request->file('thumbnail')->getClientOriginalName();
                if ($proyek->thumbnail != "") {
                    Storage::delete('public/proyek/thumbnail/' . $proyek->thumbnail);
                }
                $request->file('thumbnail')->storeAs('public/proyek/thumbnail', $thumbnail);
            } else {
                $thumbnail = $proyek->thumbnail;
            }

            if ($request->hasFile('lampiran')) {
                $this->validate($request, [
                    'lampiran' => 'required|array',
                    'lampiran.*' => 'mimes:jpg,jpeg,gif,png,pdf,doc,docx,xls,xlsx,odt,ppt,pptx|max:5120'
                ]);

                $lampiran = [];
                $i = 0;
                foreach ($request->file('lampiran') as $file) {
                    $file->storeAs('public/proyek/lampiran', $file->getClientOriginalName());
                    $lampiran[$i] = $file->getClientOriginalName();
                    $i = 1 + $i;
                }
            } else {
                $lampiran = $proyek->lampiran;
            }

            $proyek->update([
                'user_id' => Auth::id(),
                'subkategori_id' => $request->subkategori_id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'waktu_pengerjaan' => $request->waktu_pengerjaan,
                'harga' => str_replace('.', '', $request->harga),
                'thumbnail' => $thumbnail,
                'lampiran' => $lampiran,
                'pribadi' => false,
            ]);
        } else {
            return back()->with('gagal', 'Tugas/Proyek [' . $request->judul . '] Anda telah tersedia! Silahkan ubah tugas/proyek Anda dengan judul yang berbeda, terimakasih.');
        }

        return back()->with('update', 'Tugas/Proyek [' . $proyek->judul . '] Anda berhasil diperbarui!');
    }

    public function hapusProyek($id)
    {
        $proyek = Project::find($id);
        if ($proyek->thumbnail != "") {
            Storage::delete('public/proyek/thumbnail/' . $proyek->thumbnail);
        }
        $proyek->delete();

        return back()->with('delete', 'Tugas/Proyek [' . $proyek->judul . '] Anda berhasil dihapus!');
    }

    public function terimaBid($id)
    {
        $bid = Bid::find($id);
        $bid->update(['tolak' => false]);
        Bid::where('id', '!=', $id)->where('proyek_id', $bid->proyek_id)->update(['tolak', true]);

        return back()->with('bid', 'Bidder [' . $bid->get_user->name . '] untuk tugas/proyek [' . $bid->get_project->judul . '] berhasil diterima!');
    }

    public function updatePembayaran(Request $request)
    {
        $proyek = Project::find($request->id);

        if ($request->hasFile('bukti_pembayaran')) {
            $name = $request->file('bukti_pembayaran')->getClientOriginalName();
            if ($proyek->get_pembayaran->bukti_pembayaran != '') {
                Storage::delete('public/users/pembayaran/proyek/' . $proyek->get_pembayaran->bukti_pembayaran);
            }
            $request->bukti_pembayaran->storeAs('public/users/pembayaran/proyek', $name);
            $proyek->get_pembayaran->update(['bukti_pembayaran' => $name]);

            return $name;
        } else {
            if (is_null($proyek)) {
                $sisa_pembayaran = 0;
                $pembayaran = Pembayaran::create([
                    'proyek_id' => $proyek->id,
                    'dp' => $request->dp,
                    'jumlah_pembayaran' => str_replace('.', '', $request->jumlah_pembayaran),
                ]);
            } else {
                $pembayaran = Pembayaran::where('proyek_id', $proyek->id)->first();
                $sisa_pembayaran = str_replace('.', '', $request->jumlah_pembayaran);
                $pembayaran->update([
                    'dp' => $request->dp,
                    'jumlah_pembayaran' => $proyek->get_pembayaran->jumlah_pembayaran + $sisa_pembayaran,
                    'bukti_pembayaran' => null,
                ]);
            }

            Mail::to($pembayaran->get_project->get_user->email)
                ->send(new PembayaranProyekMail($pembayaran, $sisa_pembayaran, $request->metode_pembayaran, $request->rekening));

            return back()->with('update', 'Silahkan cek email Anda dan selesaikan pembayaran Anda sebelum batas waktu yang ditentukan! Terimakasih :)');
        }
    }

    public function dataPembayaran(Request $request)
    {
        return Pembayaran::find($request->id);
    }

    public function ulasPengerjaanProyek(Request $request)
    {
        $pengerjaan = Pengerjaan::find($request->id);
        $pengerjaan->update(['selesai' => $request->has('selesai') ? $request->selesai : false]);
        ReviewWorker::create([
            'user_id' => Auth::id(),
            'pengerjaan_id' => $pengerjaan->proyek_id,
            'deskripsi' => $request->deskripsi,
            'bintang' => $request->rating,
        ]);

        if ($pengerjaan->selesai == true) {
            $message = 'Tugas/proyek [' . $pengerjaan->get_project->judul . '] Anda telah selesai!';
        } else {
            $message = 'Tugas/proyek [' . $pengerjaan->get_project->judul . '] Anda sedang direvisi!';
        }

        return back()->with('pengerjaan', $message);
    }

    public function dataUlasanProyek(Request $request)
    {
        return ReviewWorker::where('pengerjaan_id', $request->id)->where('user_id', Auth::id())->first();
    }
}
