<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    protected $primaryKey = 'id_calon';
    public function pemilu(){
        return $this->belongsTo('App\Pemilu','id_pemilu','id_pemilu');
    }


}
