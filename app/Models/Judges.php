<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class judges extends Model
{
    protected $fillable = ['full_name','description','image','signature','position_in_club','created_at','updated_at','status'];
    protected $table = 'judges';
}
