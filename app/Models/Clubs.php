<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clubs extends Model
{
    use HasFactory;
    protected $table = 'clubs';
    public function cities_name(){
        return $this->belongsTo('App\Models\Cities','city','id');
      }
      public function country_name(){
    
        return $this->belongsTo('App\Models\Countries','country','idCountry');
      }
}
