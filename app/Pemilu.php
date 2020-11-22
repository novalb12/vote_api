<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemilu extends Model
{
    protected $primaryKey = 'id_pemilu';
    protected $fillable = [
        'nama_pemilu', 'kategori', 'timeline','pin'
    ];
    public function calons(){
        return $this->hasMany('App\Calon','id_pemilu','id_pemilu');
    }

    public function suara(){
        return $this->belongsToMany('App\User', 'suaras', 'id_pemilu', 'npm');
    }
    public function putUser($user)
    {
        return $this->suara()->attach($user);
    }
}
