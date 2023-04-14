<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Judges;

class JudgeController extends Controller
{
    public function listing()
    {
        $judges = Judges::select('id','full_name as judgeName','position_in_club','image as profilePhoto')
                         ->where('status','=','Active')
                         ->get();

        foreach($judges as $judge)
        {

            if($judge->profilePhoto != null)
            {
                if(file_exists(storage_path().'app/public/judge_imgs/'.$judge->image))
                {
                    $judge->profilePhoto = asset('storage/app/public/judge_imgs').'/'.$judge->image;
                }
                else
                {
                    $judge->profilePhoto = asset('storage/app/public/noimage.png');
                }
            }
            else
            {
                $judge->profilePhoto = asset('storage/app/public/noimage.png');
            }
        }

        return response()->json(['judges' => $judges], 200);
    }

    public function details($id)
    {
        $judge = Judges::select('id','full_name as judgeName','description','image as profilePhoto')->find($id);

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

     

        return response()->json(['judge' => $judge], 200);
    }

    public function judge_details($judgeId)
      {
          $judge = Judges::find($judgeId);
          
          if (!$judge) {
              return response()->json(['error' => 'judge not found'], 404);
          }
          
        //   return response()->json($club);
        return $judge;
      }

}
