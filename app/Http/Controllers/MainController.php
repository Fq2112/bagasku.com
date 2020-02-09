<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function index()
    {
        /*$collection = collect([1, 2, 3, 4, 5, 6, 7]);
        $chunks = $collection->chunk(2);
        $chunks->toArray();
        dd($chunks);

        $testimoni = Testimoni::orderByDesc('id')->get();

        if(Auth::check()) {
            $cek = Testimoni::where('user_id', Auth::id())->first();
        } else {
            $cek = null;
        }*/

        $cek = null;

        return view('pages.main.beranda', compact('cek'));
    }

    public function kirimTestimoni(Request $request)
    {
        if ($request->check_form == 'create') {
            Testimoni::create([
                'user_id' => Auth::id(),
                'rate' => $request->rating,
                'comment' => $request->comment,
            ]);

            return back()->with('update', 'Terima kasih ' . Auth::user()->name . ' atas ulasannya! ' .
                'Dengan begitu kami dapat berpotensi menjadi agensi yang lebih baik lagi.');

        } else {
            Testimoni::find($request->check_form)->update([
                'rate' => $request->rating,
                'comment' => $request->comment,
            ]);

            return back()->with('success', 'Ulasan Anda berhasil diperbarui!');
        }
    }

    public function hapusTestimoni($id)
    {
        Testimoni::destroy(decrypt($id));

        return back()->with('success', 'Ulasan Anda berhasil dihapus!');
    }

    public function kontak()
    {
        return view('pages.main.kontak');
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

        return back()->with('success', 'Terima kasih telah meninggalkan kami pesan! Karena setiap komentar atau kritik yang Anda berikan, akan membuat kami menjadi perusahaan yang lebih baik.');
    }
}
