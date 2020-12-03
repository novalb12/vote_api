<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Calon;
use Auth;
use Validator;

class CalonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pemilu' => 'required',
            'npm' => 'required',
            'nama_calon'  => 'required',
            'fakultas'  => 'required',
            'visi'  => 'required',
            'misi'  => 'required',
            'proker'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(), ],401);
        }

        $input = $request->all();
        $calon = Calon::create($input);

        return response()->json([
            'success' => true,
            'calon'    => $calon],200);
    }
}
