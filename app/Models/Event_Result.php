<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_Result extends Model
{
    use HasFactory;
    protected $table = 'event_results';
    protected $fillable = ['dog_id'];
}
