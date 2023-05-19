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

         foreach ($judges as $judge) {
        if ($judge->image != null) {
            if (file_exists(storage_path('app/public/judge_imgs/'.$judge->image))) {
                $judge->image = asset('storage/app/public/judge_imgs').'/'.$judge->image;
            } else {
                $judge->image = asset('storage/app/public/noimage.png');
            }
        }
    }

        return response()->json(['judges' => $judges], 200);
    }

    public function details($id)
    {
        $judge = Judges::select('id',
                                'full_name',
                                'position_in_club',
                                'description','image',
                                'signature',
                                'facebook',
                                'instagram',
                                'linkedIn',
                                'twitter')
                        ->find($id);

        if($judge)
        {

            $judge->description = html_entity_decode($judge->description);

            if($judge->image != null)
            {
                if(file_exists(storage_path('/app/public/judge_imgs/'.$judge->image)))
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

            if($judge->signature != null)
            {
                if(file_exists(storage_path('app/public/judge_signatures/'.$judge->signature)))
                {
                    $judge->signature = asset('storage/app/public/judge_signatures').'/'.$judge->signature;
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
        else
        {
            return response()->json(['judge' => []], 404);
        }
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
