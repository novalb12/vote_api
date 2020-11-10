<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    public function pemilu(){
        return $this->belongsTo('App\Pemilu');
    }
}
