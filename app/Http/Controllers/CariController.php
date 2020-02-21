<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Project;
use App\Model\Services;
use Illuminate\Http\Request;

class CariController extends Controller
{
    public function getCariData($filter, $keyword)
    {
        if ($filter == 'proyek') {
            $data = Project::where('judul', 'like', '%' . $keyword . '%')->get();
        } elseif ($filter == 'layanan') {
            $data = Services::where('judul', 'like', '%' . $keyword . '%')->get();
        } else {
            $data = Product::where('judul', 'like', '%' . $keyword . '%')->get();
        }

        foreach ($data as $row) {
            $row->label = $row->get_sub->nama . ' - ' . $row->judul;
            $row->keyword = $row->judul;
        }

        return $data;
    }
}