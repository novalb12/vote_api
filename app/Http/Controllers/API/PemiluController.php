<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Pemilu;
use App\Calon;
use Auth;

class PemiluController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pemiluProdi()
    {
        $npm = strval(Auth::id());
        $prodi = substr($npm,0,4);

        $pemilus = Pemilu::where('kategori', $prodi)->first();

        $calons = Calon::where('id_pemilu',$pemilus->id_pemilu);
        $tes = Calon::all();
        return response()->json([
            'success' => True,
            'pemilu' => $pemilus,
            'calon'=> $calons,
            'test'=>$tes
            ]);
    }
    public function pemiluFakultas()
    {
        $npm = strval(Auth::id());
        $fakultas = substr($npm,0,2);

        $pemilus = Pemilu::where('kategori', $fakultas)->first();
        $calons = Calon::where('id_pemilu',$pemilus->id_pemilu);
        return response()->json([
            'success' => True,
            'pemilu' => $pemilus,
            'calon'=> $calons,
            ]);
    }

    public function pemiluUniv()
    {
        $pemilus = Pemilu::where('kategori','universitas')->first();
        $calons = Calon::where('id_pemilu',$pemilus->id_pemilu);
        return response()->json([
            'success' => True,
            'pemilu' => $pemilus,
            'calon'=> $calons,
            ]);
    }

}
