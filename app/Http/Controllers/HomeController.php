<?php

namespace App\Http\Controllers;

use App\traits\TokenTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use TokenTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $api_token = Auth::user()->api_token;
        return view('home', compact('api_token'));
    }



    public function updateToken(){
        $this->generateToken(Auth::user());
        return redirect()->route('home');
    }
}
