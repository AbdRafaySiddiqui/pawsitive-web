<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventJudges extends Model
{
    use HasFactory;

    protected $table = 'event_judges';

    public function judge(){
        return $this->belongsTo('App\Models\Judges','judge_id','id');
      }
}
