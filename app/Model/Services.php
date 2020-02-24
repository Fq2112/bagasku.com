<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'service';
    protected $guarded = ['id'];

    public function get_user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function get_sub()
    {
        return $this->belongsTo(SubKategori::class, 'subkategori_id');
    }

    public function get_pembayaran()
    {
        return $this->hasMany(PembayaranLayanan::class, 'service_id');
    }

    public function get_pengerjaan()
    {
        return $this->hasMany(PengerjaannLayanan::class, 'service_id');
    }


    public function get_ulasan()
    {
        return $this->hasMany(UlasanService::class, 'pengerjaann_layanan_id');
    }
}
