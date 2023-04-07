<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Judges;

class JudgeController extends Controller
{
    function listing()
    {
        return Judges::all();
    }

    function details($id=null)
    {
        return Judges::find($id);
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
