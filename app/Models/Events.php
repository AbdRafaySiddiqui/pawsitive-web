<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $table = 'events';

  public function cities(){
    return $this->belongsTo('App\Models\Cities','city','id');
  }
  public function country(){
    
    return $this->belongsTo('App\Models\Countries','country','idCountry');
  }
  public function club(){
    return $this->belongsTo('App\Models\Clubs','club_id','id');
  }
  public function judge(){
    return $this->belongsTo('App\Models\Judges','judge_id','id');
  }
}
