<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PembayaranLayanan extends Model
{
    protected $table = 'pembayaran_layanan';
    protected $guarded = ['id'];

    public function get_service(){
        return $this->belongsTo(Services::class,'service_id');
    }
}
