<?php

use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

function isActiveState($work_id, $state)
{
    if (State::where('user_id', Auth::id())->where('work_id', $work_id)->where('state', $state)->count() != 0) {
        return 'active';
    } else {
        return '';
    }
}
