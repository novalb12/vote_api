<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getProfile(){
        $user = Auth::user();
        return response()->json([
            'success' => True,
            'user' => $user,],200);
    }

    public function editProfile(Request $request){
        $request->user()->update(
            $request->all()
        );
        $user = Auth::user();
        return response()->json([
            'success' => True,
            'user' => $user,],200);
    }
}
