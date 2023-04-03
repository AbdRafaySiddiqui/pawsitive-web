<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class breeds extends Model
{
    use HasFactory;
    
    public function species()
    {
        return $this->belongsTo('App\Models\specie','sp_id','id');
    }

    public function countryorigin()
    {
        return $this->belongsTo('App\Models\Countries','country','idCountry');
    }
}
