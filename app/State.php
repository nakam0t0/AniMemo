<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
   protected $fillable = ['user_id', 'work_id', 'state'];

   public function Work()
   {
       return $this->belongsTo('App\Work');
   }
}
