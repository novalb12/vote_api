<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pemilu;
use App\Calon;
use Validator;
use Auth;

class VoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cekPin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pemilu' => 'required',
            'pin' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(), ],401);
        }

        $pemilus = Pemilu::where('id_pemilu',$request->id_pemilu)->first();
        if($request->pin == $pemilus->pin){
            return response()->json([
                'success' => true,
                'message' => 'Success' ],401);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid Pin', ],401);
        }
    }

    public function vote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_calon' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(), ],401);
        }

        $calons = Calon::where('id_calon',$request->id_calon)->first();
        $calons->suara = $calons->suara+1;
        $calons->save();
        $pemilus = Pemilu::where('id_pemilu',$calons->id_pemilu)->first();
        $pemilus->putUser(Auth::id());
        //dd($pemilus->putUser(Auth::id()));


        return response()->json([
                'success' => true,
                'message' => $calons->suara, ],401);
    }
}
