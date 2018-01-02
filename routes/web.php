<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});



use App\State;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
Route::get('/dev', function (Request $request) {
    $curious_work_ids = State::where('state', 1)->where('user_id', Auth::id())->pluck('work_id');
    $curiosities = Work::all()->whereIn('id', $curious_work_ids);
    foreach($curiosities as $curiosity) {
        echo $curiosity->title;
    }
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');
Route::resource('works', 'WorkController');
Route::resource('states', 'StateController');
Route::resource('follows', 'FollowController');
Route::resource('reviews', 'ReviewController');

