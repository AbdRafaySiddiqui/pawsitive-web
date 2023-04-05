<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\SystemSettings;
use App\Models\Pets;

trait Misc
{
    function get_time_ago( $time )
    {
        $time_difference = time() - $time;

        if( $time_difference < 1 ) { return 'less than 1 second ago'; }
        $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                    30 * 24 * 60 * 60       =>  'month',
                    24 * 60 * 60            =>  'day',
                    60 * 60                 =>  'hour',
                    60                      =>  'minute',
                    1                       =>  'second'
        );

        foreach( $condition as $secs => $str )
        {
            $d = $time_difference / $secs;

            if( $d >= 1 )
            {
                $t = round( $d );
                return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
            }
        }
    }

    public function import_file_data()
    {
        if(file_exists(asset('storage/app/public/GSD.json')))
        {
            $filename = asset('storage/app/public/GSD.json');
            $data = file_get_contents($filename); //data read from json file
            print_r($data);
            $users = json_decode($data);  //decode a data

            return print_r($users); //array format data printing
            $message = "<h3 class='text-success'>JSON file data</h3>";
        }else{
            $message = "<h3 class='text-danger'>JSON file Not found</h3>";
        }
    }

    public function new_reg_number()
    {
        $setting = SystemSettings::where('setting_name','reg_number_prefix')->first();

        $latest = Pets::select('reg_number')->where('reg_number','LIKE','%'.$setting->value.'%')->orderBy('reg_number','DESC')->first();

        if($latest)
        {
            $split = explode('-',$latest->reg_number);

            $split[1] = (int)$split[1];

            if(strlen((string)$split[1]) == 1)
            {
                $new_number = $split[1] + 1;

                if(strlen((string)$new_number) == 1)
                {
                    return $setting->setting_value.'-000'.$new_number;
                }
                elseif(strlen((string)$new_number) == 2)
                {
                    return $setting->setting_value.'-000'.$new_number;
                }
            }
            elseif(strlen((string)$split[1]) == 2)
            {
                $new_number = $split[1] + 1;

                if(strlen((string)$new_number) == 2)
                {
                    return $setting->setting_value.'-00'.$new_number;
                }
                elseif(strlen((string)$new_number) == 3)
                {
                    return $setting->setting_value.'-0'.$new_number;
                }
            }
            elseif(strlen((string)$split[1]) == 3)
            {
                $new_number = $split[1] + 1;

                if(strlen((string)$new_number) == 3)
                {
                    return $setting->setting_value.'-0'.$new_number;
                }
                elseif(strlen((string)$new_number) == 4)
                {
                    return $setting->setting_value.'-'.$new_number;
                }
            }
            elseif(strlen((string)$split[1]) > 3)
            {
                $new_number = $split[1] + 1;

                return $setting->setting_value.'-'.$new_number;
            }
        }
        else
        {
            return $setting->setting_value.'-0001';
        }
    }
}