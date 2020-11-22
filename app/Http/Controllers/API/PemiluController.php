<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Pemilu;
use App\Calon;
use Auth;

class VoteController extends Controller
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
        return response()->json([
            'pemilu' => $pemilus,
            ]);
    }
    public function pemiluFakultas()
    {
        $npm = strval(Auth::id());
        $fakultas = substr($npm,0,2);

        $pemilus = Pemilu::where('kategori', $fakultas)->first();
        return response()->json([
            'pemilu' => $pemilus,
            ]);
    }

    public function pemiluUniv()
    {
        $pemilus = Pemilu::where('kategori','universitas')->first();
        return response()->json([
            'pemilu' => $pemilus,
            ]);
    }

}
