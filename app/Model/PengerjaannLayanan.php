<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PengerjaannLayanan extends Model
{
    protected $table = 'pengerjaan';
    protected $guarded = ['id'];

    public function get_user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function get_service(){
        return $this->belongsTo(Services::class,'service_id');
    }
}
