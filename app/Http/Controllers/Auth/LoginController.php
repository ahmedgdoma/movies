<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\traits\TokenTrait;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, TokenTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * override authenticated function from AuthenticatesUsers Trait
     *
     * @param Request $request
     * @param $user
     * @return mixed
     */
    public function authenticated(Request $request, $user)
    {
        $this->generateToken($user);
        return redirect()->intended($this->redirectPath());
    }
}
