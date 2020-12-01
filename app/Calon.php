<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    protected $primaryKey = 'id_calon';
    protected $fillable = [
        'id_pemilu','npm','nama_calon','fakultas','visi','misi','proker'
    ];
    public function pemilu(){
        return $this->belongsTo('App\Pemilu','id_pemilu','id_pemilu');
    }

    public function user(){
        return $this->belongsTo('App\User','npm','npm');
    }


}
