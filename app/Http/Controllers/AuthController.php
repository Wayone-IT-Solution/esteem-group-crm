<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\loginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function validateCredentials(loginRequest $request)
    {
        $user =  User::whereEmail($request->email)->first();
        $hasRemember = $request->remember ?? '';
        if ($user && Hash::check($request->password, $user->password)) {
            ($hasRemember == 'on') ? Auth::attempt(['email' => $user->email, 'password' => $request->password], $hasRemember) :  Auth::login($user);
            return response()->json(['code' => 200, 'message' => 'Login Successfully'], 200);
        }
        return response()->json(['code' => 422, 'errors' => ['password' => ['Wrong Credentials']]], 422);
    }

    public function  logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
