<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;
use App\Models\Users;

class Role extends SpatieRole
{
    use HasFactory;

    protected $fillable = [ 'name' ];
    protected $table = 'roles';

    // public function no_of_users($id)
    // {
    //     return Users::where('role_id','=',$id)->where('status','=','Active')->count();
    // }

}
