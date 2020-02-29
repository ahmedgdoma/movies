<?php

namespace App\Http\Controllers;

use App\traits\TokenTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    use TokenTrait;
    public function ApiLogin(Request $request){
        if ($request->has(['email', 'password'])){
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                // Authentication passed...
                $this->generateToken(Auth::user());
                return ['message'=> 'logged in successfully', 'token' => $this->api_token];
            }
        }

        return response('email or password is not correct', 400);
    }
}
