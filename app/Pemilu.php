<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemilu extends Model
{
    public function calons(){
        return $this->hasMany('App\Calon');
    }

    public function suara(){
        return $this->belongsToMany('App\User', 'suara', 'id_pemilu', 'npm');
    }
}
