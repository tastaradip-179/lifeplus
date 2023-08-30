<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login_view','register_view','login','register']]);
    }

    public function login_view(){
        return view ('auth.login');
    }

    public function register_view(){
        return view ('auth.registration');
    }

    public function welcome(){
        $user = Auth::user();
        $account = $user->accounts;
        $current_balance = $account[0]->current_balance;
        return view ('welcome', compact('current_balance'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return $this->sendLoginResponse($request, $token);
        // return response()->json([
        //         'status' => 'success',
        //         'user' => $user,
        //         'authorization' => [
        //             'token' => $token,
        //             'type' => 'bearer',
        //         ]
        // ]);

    }

    public function register(Request $request){
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'type' => 'required'
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
            'cookie' => $value,
        ]);
        return view ('auth.login');
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function userProfile() {
        return response()->json(Auth::user());
    }

    public function userProfileView() {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    protected function sendLoginResponse(Request $request, $token)
    {
        //$this->clearLoginAttempts($request);
        setcookie("jwt_token", $token);
        $value = $request->cookie('jwt_token');
        return response()->json([
            'token' => $token,
            'cookie' => $value,
        ]);
        //return view('welcome');
        //return $this->authenticated($request, Auth::user(), $token);
    }

    // protected function authenticated(Request $request, $user, $token)
    // {
    //     setcookie("jwt_token", $token);
    //     return redirect('/');
    //     return response()->json([
    //         'token' => $token,
    //     ]);
    // }

}
