<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    public function states()
    {
        return $this->hasMany('App\State');
    }
}
