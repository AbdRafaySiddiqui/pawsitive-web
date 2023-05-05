<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dogs extends Model
{
    use HasFactory;
    protected $table = 'dogs';
    public function dog_owners()
    {
        return $this->belongsTo('App\Models\DogOwner','dog_id','id'); 
    }
}
