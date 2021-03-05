<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function authenticate (Request $request)
    {
        $response = ['success' => false, 'message'=>[]];

        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if (! $validate->fails()) {
            $cred = $request->only('email', 'password');
            if (Auth::attempt($cred)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
                // $response['success'] = true;
                // $response['message'] = 'Login successful';
            } else {
                $response['success'] = false;
                $response['message'] = 'Email/Password does not match.';
            }
        } else {
            $response['success'] = false;
            foreach($request->all() as $field => $value) {
                $response['message'][$field] = $validate->errors()->first($field);
            }
        }
        
        // return $response;
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
