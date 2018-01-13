<?php

namespace App\Http\Controllers;

use App\User;
use App\Work;
use App\State;
use App\Follow;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $curious_work_ids = State::where('state', 1)->where('user_id', $user->id)->pluck('work_id');
        $curiosities = Work::whereIn('id', $curious_work_ids)->get();

        $archive_work_ids = State::where('state', 2)->where('user_id', $user->id)->pluck('work_id');
        $archives = Work::whereIn('id', $archive_work_ids)->get();

        $favorite_work_ids = State::where('state', 3)->where('user_id', $user->id)->pluck('work_id');
        $favorites = Work::whereIn('id', $favorite_work_ids)->get();

        $review_work_ids = Review::where('user_id', $user->id)->pluck('work_id');
        $reviews = Work::whereIn('id', $review_work_ids)->get();

        if (Follow::where('user_id', auth::id())->where('followed_user_id', $user->id)->count()) {
            $follow = 'follow';
        } else {
            $follow = 'unfollow';
        }
        return view('users.show', ['user' => $user, 'curiosities' => $curiosities, 'archives' => $archives, 'favorites' => $favorites, 'reviews' => $reviews, 'follow' => $follow]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
