<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DogOwner extends Model
{
    use HasFactory;
    public function dogs()
    {
        return $this->belongsTo('App\Models\Dog','dog_id','id'); 
    }

    public function owners()
    {
        return $this->belongsTo('App\Models\User','owner_id','id'); 
    }
}
