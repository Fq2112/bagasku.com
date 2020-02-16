<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    protected $table = 'subkategori';
    protected $guarded = ['id'];

    public function get_kategori()
    {
        return $this->belongsTo(Kategori::class,'kategori_id');
    }
}
