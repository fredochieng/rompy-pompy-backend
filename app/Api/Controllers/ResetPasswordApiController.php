<?php

namespace App\\Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class ResetPasswordApiController extends Controller
{
    /** Get password request email fromthe form */
    public function GetResetPassEmail(){

        if (!empty($request->email)) {
            /** Check if the email address exists */
            $user = User::where('email', $request->email)->first();
            if(!empty($user)){
                /** Send password reset email link */

                $reset_token = sha1(time());
            $save_reset_array = array(
                'email' => $email,
                'token' => $reset_token
            );

            $save = DB::table('password_resets')->insert($save_reset_array);

            $app_url = ENV('APP_URL');

            $name = $user->name;
            $email = $user->email;
            $title = 'Reset Password';
            $message_body = $app_url . ('/reset-my-password/&token=' . $reset_token);

           // $send_mail = Mail::to($email)->send(new ResetPassword($name, $title, $message_body));
            $data['icon'] = "check";
            $data['status'] = "thank";
            $data['title'] = 'Password Reset';
            $data['message'] = "We have sent the password reset instructions to your email address. Kindly check your email address and reset your password";

            }else{
                $message = array("message" => "Email address not registered", "status" => 400);
                return response()->json($message, 400);
            }
            
        }else{
            $message = array("message" => "Please provide an email address", "status" => 400);
            return response()->json($message, 400);
        }
    }

    public function reset($token)
    {
        $token_data = DB::table('password_resets')->where('token', $token)->first();

        if (!empty($token_data)) {
            $email = $token_data->email;

            return response()->json(
                [
                    'redirect_to' => '/new-password/&token='.$token,
                    'success' => 'Token valid',
                    'status' => 201
                ]
            );
        } else {
            $message = array("message" => "Token seems to be invalid", "status" => 400);
            return response()->json($message, 400);
        }
    }

     public function password_reset(Request $request)
     {
         $new_pass = $request->input('new_password');
         $confirm_pass = $request->input('confirm_password');
         $email = $request->email;
 
         if ($new_pass == $confirm_pass) {
             $user_pass = array(
                 'password' => Hash::make($new_pass)
             );
 
             $update_password = User::where('email', $email)->update($user_pass);
             $app_url = ENV("APP_URL");
             $message_body = $app_url . ('/signin');
 
             $message = array("message" => "Password reset done", "status" => 201);
             return response()->json($message, 201);
         } else {
            $message = array("message" => "Confirm password does not match", "status" => 400);
            return response()->json($message, 400);
         }
     }
}
