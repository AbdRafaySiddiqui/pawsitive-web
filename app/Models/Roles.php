<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Roles extends Model
{
    use HasFactory;
    // protected $fillable = [ 'name' ];
    // protected $table = 'roles';

    public function no_of_users($id)
    {
        return User::where('role_id','=',$id)->count();
    }
}
