<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
use Validator;
use Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UserController extends Controller
{

    public $successStatus = 200;

    public function login(){
        if(Auth::attempt(['npm' => request('npm'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('vote_api')->accessToken;
            return response()->json([
                'success' => true,
                'token'   => $success,
                'user'    => $user],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid npm or password', ],401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'npm' => 'required',
            'password' => 'required|confirmed',
            'role'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(), ],401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] =  $user->createToken('vote_api')->accessToken;
        $success['npm'] =  $user->npm;

        return response()->json([
            'success' => true,
            'token'   => $success,
            'user'    => $user],200);
    }

    public function logout(Request $request)
    {
        if (Auth::user()) {
            $user = Auth::user()->token();
            $user->revoke();
            return response()->json([
                    'success' => true,
                    'message' => 'Logout successfully'
                    ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to Logout'
            ]);
        }
    }
    public function changePassword(Request $request){
        if (Auth::user()) {

            $user = Auth::User();
            $validator = Validator::make($request->all(), [
                'password_lama' => 'required',
                'password_baru' => 'required|confirmed',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(), ],401);
            }

            else if (Hash::check($request->get('password_lama'), $user->password)) {
                $user->password = bcrypt($request->get('password_baru'));
                $user->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Password Berhasil Diubah'
                    ]);

            }
            else {
                return response()->json([
                    'success' => false,
                    'message' => 'Wrong old password'
                    ]);
            }
            /*return response()->json([
                    'success' => true,
                    'message' => 'Logout successfully'
                    ]);*/
        }else {
            return response()->json([
                'success' => false,
                'message' => 'user not authenticated'
            ]);
        }
    }

    public function forgetPassword(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        $newpassword = Str::random(10);
        $user->password = bcrypt($newpassword);
        $user->save();
        $text             = $newpassword;
        $mail             = new PHPMailer\PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = 1;
        $mail->SMTPAuth   = true;
        $mail->Host       = env('MAIL_HOST');
        $mail->Port       = env('MAIL_PORT');
        $mail->IsHTML(true);
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SetFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->Subject = "New Password";
        $mail->Body    = 'Password baru kamu adalah '+$text;
        $mail->AddAddress($request->email);
        $mail->send();
    }

    public function tes(){
       return response()->json([
                'success' => true,
                'message' => 'masuk'
            ]);
    }
}
