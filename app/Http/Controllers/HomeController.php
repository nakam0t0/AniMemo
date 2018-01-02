<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curiosities = State::where('state', 1)->where('user_id', Auth::id())->get();
        $archives = State::where('state', 2)->where('user_id', Auth::id())->get();
        $favorites = State::where('state', 3)->where('user_id', Auth::id())->get();

        return view('home', ['curiosites' => $curiosities, 'archives' => $archives, 'favorites' => $favorite]);
    }
}
