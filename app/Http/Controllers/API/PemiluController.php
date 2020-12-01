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
        if($pemilus == null){
            return response()->json([
                'success' => False,
                'message' => 'Pemilu yang anda belum diadakan'
            ]);
        }
        else{
            $calons = Calon::where('id_pemilu',$pemilus->id_pemilu)->get();
            return response()->json([
                'success' => True,
                'pemilu' => $pemilus,
                'calon'=> $calons,
                ]);
        }
    }
    public function pemiluFakultas()
    {
        $npm = strval(Auth::id());
        $fakultas = substr($npm,0,2);

        $pemilus = Pemilu::where('kategori', $fakultas)->first();
        if($pemilus == null){
            return response()->json([
                'success' => False,
                'message' => 'Pemilu yang anda belum diadakan'
            ]);
        }
        else{
            $calons = Calon::where('id_pemilu',$pemilus->id_pemilu)->get();
            return response()->json([
                'success' => True,
                'pemilu' => $pemilus,
                'calon'=> $calons,
                ]);
        }
    }

    public function pemiluUniv()
    {
        $pemilus = Pemilu::where('kategori','universitas')->first();
        if($pemilus == null){
            return response()->json([
                'success' => False,
                'message' => 'Pemilu yang anda belum diadakan'
            ]);
        }
        else{
            $calons = Calon::where('id_pemilu',$pemilus->id_pemilu)->get();
            return response()->json([
                'success' => True,
                'pemilu' => $pemilus,
                'calon'=> $calons,
                ]);
        }
    }

}
