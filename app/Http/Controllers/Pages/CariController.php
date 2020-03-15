<?php

namespace App\Http\Controllers\Pages;

use App\Model\Project;
use App\Model\Services;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CariController extends Controller
{
    public function cariData(Request $request)
    {
        $proyek = Project::where('pribadi', false)->doesntHave('get_pengerjaan')->orderByDesc('id')->get();
        $layanan = Services::orderByDesc('id')->get();
        $pekerja = User::whereHas('get_service')->orderByDesc('id')->get();
        $keyword = $request->q;
        $filter = $request->filter;
        $page = $request->page;

        return view('pages.main.cari-data', compact('proyek', 'layanan', 'pekerja',
            'keyword', 'filter', 'page'));
    }

    public function getCariData(Request $request)
    {
        if ($request->filter == 'pekerja') {
            $data = User::where('name', 'like', '%' . $request->keyword . '%')->whereHas('get_service')->get();

        } else {
            if ($request->filter == 'proyek') {
                $data = Project::where('pribadi', false)->where('judul', 'like', '%' . $request->keyword . '%')
                    ->doesntHave('get_pengerjaan')->get();
            } else {
                $data = Services::where('judul', 'like', '%' . $request->keyword . '%')->get();
            }
        }

        /* $i = 0;
         foreach ($data['data'] as $row) {
             $user = User::where('id', $row['user_id'])->first();
             $date = Carbon::parse($row['created_at']);
             $url = route('detail.blog', ['author' => $user->username, 'y' => $date->format('Y'),
                 'm' => $date->format('m'), 'd' => $date->format('d'),
                 'title' => $row['title_uri']]);

             $arr = array(
                 'author' => $user->username,
                 'category' => BlogCategory::where('id', $row['category_id'])->first()->name,
                 'date' => Carbon::parse($row['created_at'])->formatLocalized('%b %d, %Y'),
                 '_thumbnail' => asset('storage/blog/thumbnail/'.$row['thumbnail']),
                 '_url' => $url,
                 '_content' => Str::words($row['content'], 20, '...') . '</p>'
             );

             $data['data'][$i] = array_replace($arr, $data['data'][$i]);
             $i = $i + 1;
         }*/

        return $data;
    }

    public function getCariJudulData(Request $request)
    {
        if ($request->filter == 'pekerja') {
            $data = User::where('name', 'like', '%' . $request->keyword . '%')->whereHas('get_service')->get();
            foreach ($data as $row) {
                $row->label = $row->name . ' (' . $row->get_service->count() . ' layanan)';
                $row->keyword = $row->name;
            }

        } else {
            if ($request->filter == 'proyek') {
                $data = Project::where('pribadi', false)->where('judul', 'like', '%' . $request->keyword . '%')
                    ->doesntHave('get_pengerjaan')->get();
            } else {
                $data = Services::where('judul', 'like', '%' . $request->keyword . '%')->get();
            }
            foreach ($data as $row) {
                $row->label = $row->get_sub->nama . ' - ' . $row->judul;
                $row->keyword = $row->judul;
            }
        }

        return $data;
    }
}
