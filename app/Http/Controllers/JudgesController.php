<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Judges;


class JudgesController extends Controller
{

    public $module_name = "judges";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $judge = Judges::where('status','=','1')->orderBy('id','DESC')->paginate('5');
       
        return view('judges/index', compact('judge'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('judges/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasFile('img') && $request->hasFile('sig') ) {
            $imageName = time().'.'.request()->img->getClientoriginalName();
            request()->img->move(storage_path('app/public/judge_imgs'), $imageName);
            
            $imagesig = time().'.'.request()->sig->getClientoriginalName();
            request()->sig->move(storage_path('app/public/judge_sigs'), $imagesig);
        }
        else {
            $imageName = "";
            $imagesig = "";
        }
        
        $create =  new Judges;
        $create->full_name = $request->full_name;
        $create->position_in_club = $request->position_in_club;
        $create->description = htmlentities($request->description);
        $create->image = $imageName;
        $create->signature = $imagesig;
        $link = str_replace(" ", "-", $request->full_name);
        $create->url_link = $link; 
        $create->save();
        
            return redirect()->back()->with('success', 'New Judge Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $judge = Judges::where('id',$id)->get();
        return view('judges/show', compact('judge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $judge = Judges::where('id',$id)->get();
        return view('judges/edit', compact('judge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!empty(request()->img)){
            $imageName = time().'.'.request()->img->getClientOriginalExtension();
                request()->img->move(storage_path('app/public/judge_imgs'), $imageName);
        }

        if(!empty(request()->sig)){
                $imagesig = time().'.'.request()->sig->getClientOriginalExtension();
                request()->sig->move(storage_path('app/public/judge_sigs'), $imagesig);
        }

        if(!empty($imageName) && !empty($imagesig)){
              $judge = Judges::find($id);
                $judge->full_name = $request->full_name; 
                $judge->description = htmlentities($request->description); 
                $judge->image =  $imageName;
                $judge->signature =  $imagesig; 
                $judge->position_in_club = $request->position_in_club;
                $judge->update();
            }elseif(!empty($imageName) && empty($imagesig)){
                $judge = Judges::find($id);
                $judge->full_name = $request->full_name; 
                $judge->description = htmlentities($request->description); 
                $judge->image =  $imageName; 
                $judge->position_in_club = $request->position_in_club;
                $judge->update();
            }elseif(empty($imageName) && !empty($imagesig)){
                $judge = Judges::find($id);
                $judge->full_name = $request->full_name; 
                $judge->description = htmlentities($request->description); 
                $judge->signature =  $imagesig; 
                $judge->position_in_club = $request->position_in_club;
                $judge->update();
            }elseif(!empty($imageName)){
                $judge = Judges::find($id);
                $judge->full_name = $request->full_name; 
                $judge->description = htmlentities($request->description); 
                $judge->image =  $imageName; 
                $judge->position_in_club = $request->position_in_club;
                $judge->update();
            }elseif(!empty($imagesig)){
                $judge = Judges::find($id);
                $judge->full_name = $request->full_name; 
                $judge->description = htmlentities($request->description); 
                $judge->signature =  $imagesig; 
                $judge->position_in_club = $request->position_in_club;
                $judge->update();
            }else{
                $judge = Judges::find($id);
                $judge->full_name = $request->full_name; 
                $judge->description = htmlentities($request->description);
                $judge->position_in_club = $request->position_in_club;
                $judge->update();
            }
        return redirect()->route('judges.index')
            ->with('success','Judge Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $DeleteData = Judges::findOrFail($id);
        $DeleteData->delete();
        $this->saveActivity('Record Delete',$this->module_name,"Permenantly Deleted Record  ".$DeleteData->full_name." ");
  
        return redirect()->back()->with('message', 'Record Permenantly Deleted!');
    }

    
}
