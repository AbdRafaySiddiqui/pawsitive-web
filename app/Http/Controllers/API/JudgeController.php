<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Judges;

class JudgeController extends Controller
{
    public function listing()
    {
        $judges = Judges::select('id','full_name','position_in_club','image')
                         ->where('status','=','Active')
                         ->get();

        foreach($judges as $judge)
        {

            if($judge->image != null)
            {
                if(file_exists(storage_path().'app/public/judge_imgs/'.$judge->image))
                {
                    $judge->image = asset('storage/app/public/judge_imgs').'/'.$judge->image;
                }
                else
                {
                    $judge->image = asset('storage/app/public/noimage.png');
                }
            }
            else
            {
                $judge->image = asset('storage/app/public/noimage.png');
            }
        }

        return response()->json(['judges' => $judges], 200);
    }

    public function details($id)
    {
        $judge = Judges::select('id','full_name','position_in_club','description','image','signature')->find($id);

        $judge->description = html_entity_decode($judge->description);

        if($judge->image != null)
        {
            if(file_exists(storage_path().'app/public/judge_imgs/'.$judge->image))
            {
                $judge->image = asset('storage/app/public/judge_imgs').'/'.$judge->image;
            }
            else
            {
                $judge->image = asset('storage/app/public/noimage.png');
            }
        }
        else
        {
            $judge->image = asset('storage/app/public/noimage.png');
        }

        if($judge->signature != null)
        {
            if(file_exists(storage_path().'app/public/judge_sigs/'.$judge->signature))
            {
                $judge->signature = asset('storage/app/public/judge_sigs').'/'.$judge->signature;
            }
            else
            {
                $judge->signature = null;
            }
        }
        else
        {
            $judge->signature = null;
        }

        return response()->json(['judge' => $judge], 200);
    }
}
