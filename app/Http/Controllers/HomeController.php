<?php

namespace App\Http\Controllers;

use App\State;
use App\Work;
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
        $curious_work_ids = State::where('state', 1)->where('user_id', Auth::id())->pluck('work_id');
        $curiosities = Work::whereIn('id', $curious_work_ids)->get();

        $archive_work_ids = State::where('state', 2)->where('user_id', Auth::id())->pluck('work_id');
        $archives = Work::whereIn('id', $archive_work_ids)->get();

        $favorite_work_ids = State::where('state', 3)->where('user_id', Auth::id())->pluck('work_id');
        $favorites = Work::whereIn('id', $favorite_work_ids)->get();

        return view('home', ['curiosities' => $curiosities, 'archives' => $archives, 'favorites' => $favorites]);
    }
}
