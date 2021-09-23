<?php

namespace App\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class LoginApiController extends Controller
{
    /** Login */
    public function login(Request $request)
    {
        if (!empty($request->email) && !empty($request->password)) {
            /** Get login credentials from the form */
            $userdata = array(
                'email'     => $request->input('email'),
                'password'  => $request->input('password')
            );

            /** Attempt to login to the application */
            if (Auth::attempt($userdata)) {

                /** Get the user role for redirection */

                $user = User::select(
                    'users.*',
                    'm.model_no'
                )
                    ->leftJoin('models as m', 'users.id', 'm.m_model_id')
                    ->where('users.email', $request->email)
                    ->first();

                $user_id = $user->id;

                /** Passport API */

                $auth_success_response['token'] =  $user->createToken('authToken')->accessToken;

                $user_role = DB::table('model_has_roles')->where('model_id', '=', $user_id)->first();
                $role_id = $user_role->role_id;

                /** If role id is 1, admin , reject login
                 * if role id is 2, user, redirect to model dashbaord
                 */

                if ($role_id == 1) {
                    /** Wrong login information provided */
                    $message = array("message" => "Email or password incorrect", "status" => 400);
                    return response()->json($message, 400);
                } else if ($role_id == 2) {
                    $auth_success_response = auth()->user()->createToken('authToken')->accessToken;
                    return response()->json(
                        [
                            'user_object' => $user,
                            'redirect_to' => "https://rompypompy/model/dashboard",
                            'success' => 'You have logged in successfully',
                            'auth_success_response' => $auth_success_response,
                            'status' => 201
                        ]
                    );
                }
            } else {

                /** Wrong login information provided */
                $message = array("message" => "Email or password incorrect", "status" => 400);
                return response()->json([$message, 400]);
            }
        } else {
            $message = array("message" => "Email or password cannot be empty", "status" => 400);
            return response()->json($message, 400);
        }
    }

    /** Logout */

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();

        return redirect('https:://rompypompy.com');
    }
}
