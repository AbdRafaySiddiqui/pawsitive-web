<?php

namespace App\Http\Controllers\Filler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modules;
use App\Models\Permissions;

use DB;

class PermissionController extends Controller
{
    public function insert_permissions()
    {
        $all = Modules::get();

        $type = array('-list','-create','-edit','-delete');

        foreach($all as $every)
        {
            foreach($type as $typ)
            {
                $make = new Permissions;
                $make->name = $every->name.$typ;
                $make->module_id = $every->id;
                $make->guard_name = 'web';

                if($make->save())
                {
                    echo $every->name.$typ.' has been made';
                    echo "<br>";
                }
                else
                {
                    echo $every->name.$typ.' has not been made';
                    echo "<br>";
                }
            }
        }
    }
}
