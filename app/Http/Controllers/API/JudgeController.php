<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Judges;

class JudgeController extends Controller
{
    public function listing()
    {
        $judges = Judges::where('status','=','Active')->get();
        return response()->json(['judges' => $judges], 200);
    }

    public function details($id)
    {
        $judge = Judges::find($id);
        return response()->json(['judge' => $judge], 200);
    }
}
