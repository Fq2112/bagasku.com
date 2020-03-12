<?php

namespace App\Http\Controllers\Pages\Users\Klien;

use App\Http\Controllers\Controller;
use App\Model\PengerjaanLayanan;
use App\Model\UlasanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        return view('pages.main.users.klien.layanan', compact('user', 'pesanan'));
    }

    public function batalkanPesanan($id)
    {
        $pesanan = PengerjaanLayanan::find($id);
        $pesanan->delete();

        return back()->with('delete', 'Pesanan layanan [' . $pesanan->get_service->judul . '] berhasil dibatalkan!');
    }

    public function updatePembayaran(Request $request)
    {
        $pesanan = PengerjaanLayanan::find($request->id);

        $name = $request->file('bukti_pembayaran')->getClientOriginalName();
        if ($pesanan->get_pembayaran->bukti_pembayaran != '') {
            Storage::delete('public/users/pembayaran/' . $pesanan->get_pembayaran->bukti_pembayaran);
        }
        $request->bukti_pembayaran->storeAs('public/users/pembayaran', $name);
        $pesanan->get_pembayaran->update(['bukti_pembayaran' => $name]);

        return $name;
    }

    public function ulasPengerjaanLayanan(Request $request)
    {
        $pengerjaan = PengerjaanLayanan::find($request->id);
        $pengerjaan->update(['selesai' => $request->has('selesai') ? $request->selesai : false]);
        UlasanService::create([
            'user_id' => $pengerjaan->user_id,
            'pengerjaan_layanan_id' => $pengerjaan->id,
            'deskripsi' => $request->deskripsi,
            'bintang' => $request->rating,
        ]);

        if ($pengerjaan->selesai == true) {
            $message = 'Pesanan layanan [' . $pengerjaan->get_service->judul . '] Anda telah selesai!';
        } else {
            $message = 'Pesanan layanan [' . $pengerjaan->get_service->judul . '] Anda sedang direvisi!';
        }

        return back()->with('pengerjaan', $message);
    }

    public function dataUlasanLayanan(Request $request)
    {
        return UlasanService::where('pengerjaan_layanan_id', $request->id)->first();
    }
}
