<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Pemilu;
use App\Calon;
use Auth;
use Validator;

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
                'message' => 'Pemilu belum diadakan'
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
                'message' => 'Pemilu belum diadakan'
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
                'message' => 'Pemilu belum diadakan'
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

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pemilu' => 'required',
            'kategori' => 'required',
            'timeline'  => 'required',
            'pin'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(), ],401);
        }

        $input = $request->all();
        $pemilu = Pemilu::create($input);

        return response()->json([
            'success' => true,
            'pemilu'    => $pemilu],200);
    }

}
