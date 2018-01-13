<?php

namespace App\Http\Controllers;

use App\Work;
use App\State;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use mpyw\Co\Co;
use mpyw\Co\CURLException;
use mpyw\Cowitter\Client;
use mpyw\Cowitter\HttpException;

class WorkController extends Controller
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

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $year = $request->input('year');
        $cours = $request->input('cours');
        $title = $request->input('title');

        // その年が無かったら取りに行く
        if ($request->has('year')) {
            if (Work::where('year', $year)->count() == 0) {
                $this->store($year);
            }
        }

        // // 絞って行く ページネーションとコレクションの両立ができない
        // $works = Work::all();
        // if ($request->has('year')) {
        //     $works = $works->where('year', $year);
        // }
        // if ($cours != 0) {
        //     $works = $works->where('cours', $cours);
        // }
        // if ($request->has('title')) {
        //     $works = $works->where('title', 'LIKE', '%' . $title . '%');
        // }
        // $works = $works->paginate(32);

        // 上の代わり
        if ($request->has('year')) {
            if ($cours != 0) {
                if ($request->has('title')) {
                    $works = Work::where('year', $year)->where('cours', $cours)->where('title', 'LIKE', '%' . $title . '%')->paginate(32);
                } else {
                    $works = Work::where('year', $year)->where('cours', $cours)->paginate(32);
                }
            } else {
                if ($request->has('title')) {
                    $works = Work::where('year', $year)->where('title', 'LIKE', '%' . $title . '%')->paginate(32);
                } else {
                    $works = Work::where('year', $year)->paginate(32);
                }
            }
        } else {
            if ($cours != 0) {
                if ($request->has('title')) {
                    $works = Work::where('cours', $cours)->where('title', 'LIKE', '%' . $title . '%')->paginate(32);
                } else {
                    $works = Work::where('cours', $cours)->paginate(32);
                }
            } else {
                if ($request->has('title')) {
                    $works = Work::where('title', 'LIKE', '%' . $title . '%')->paginate(32);
                } else {
                    $works = Work::paginate(32);
                }
            }
        }

        return view('works.index', ['works' => $works, 'year' => $year, 'cours' => $cours, 'title' => $title]);
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
    public function store($year)
    {
        foreach ([1, 2, 3, 4] as $cours) {
            $url = 'http://api.moemoe.tokyo/anime/v1/master/' . $year . '/' . $cours;
            $obj = file_get_contents($url);
            $data = json_decode($obj);
            foreach ($data as $data) {
                if (Work::where('title', $data->title)->where('year', $year)->where('cours', $cours)->count() != 0) {
                    continue;
                }
                $work = new Work;
                $work->title = $data->title;
                $work->image_path = $this->getImagePath($data->twitter_account);
                $work->title_short1 = $data->title_short1;
                $work->title_short2 = $data->title_short2;
                $work->title_short3 = $data->title_short3;
                $work->year = $year;
                $work->cours = $cours;
                $work->public_url = $data->public_url;
                $work->twitter_account = $data->twitter_account;
                $work->twitter_hash_tag = $data->twitter_hash_tag;
                $work->save();
            }
        }
    }

    public function getImagePath($account)
    {
        $client = new Client([env('API_KEY'), env('API_SECRET'), env('ACCESS_TOKEN'), env('ACCESS_TOKEN_SECRET')]);
        try {
            $obj = $client->get('show/user', ['screen_name' => $account]);
        } catch (\RuntimeException $e) {
            return '/images/white.jpg';
        }
        $url = json_decode($obj)->profile_image_url;
        $image = Image::make(file_get_contents($url));
        $file = $account . '.jpg';
        $path = '/images/' . $file;
        if (!file_exists(public_path($path))) {
            $image->save(public_path($path));
        }
        return $path;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function show(Work $work)
    {
        $reviews = Review::where('work_id', $work->id)->get();
        $cur_num = State::where('state', 1)->where('work_id', $work->id)->count();
        $arc_num = State::where('state', 2)->where('work_id', $work->id)->count();
        $fav_num = State::where('state', 3)->where('work_id', $work->id)->count();
        return view('works.show', ['work' => $work, 'reviews' => $reviews, 'cur_num' => $cur_num, 'arc_num' => $arc_num, 'fav_num' => $fav_num]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work $work)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        //
    }
}
