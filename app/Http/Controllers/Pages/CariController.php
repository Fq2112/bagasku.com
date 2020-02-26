<?php

namespace App\Http\Controllers\Pages;

use App\Model\Project;
use App\Model\Services;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CariController extends Controller
{
    public function cariData(Request $request)
    {
        return null;
    }

    public function getCariData(Request $request)
    {
        if ($request->filter == 'pekerja') {
            $data = User::where('name', 'like', '%' . $request->keyword . '%')->whereHas('get_service')->get();
            foreach ($data as $row) {
                $row->label = $row->name . ' (' . $row->get_service->count() . ' layanan)';
                $row->keyword = $row->name;
            }

        } else {
            if ($request->filter == 'proyek') {
                $data = Project::where('judul', 'like', '%' . $request->keyword . '%')->get();
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
