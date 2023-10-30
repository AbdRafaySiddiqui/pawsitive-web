<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AKCGroup;
use Illuminate\Pagination\Paginator;


class AKCGroupController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:akc_groups-list');
        $this->middleware('permission:akc_groups-create', ['only' => ['create','store']]);
        $this->middleware('permission:akc_groups-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:akc_groups-delete', ['only' => ['destroy']]);
    } 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Paginator::useBootstrap();
        $akcs = AKCGroup::orderBy('id','DESC')->paginate('5');
        
        return view('akc_groups.index',compact('akcs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('akc_groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $new = new AKCGroup;
        $new->name = $request->name;

        $new->save();
        return redirect()->back()->with('message', 'Record added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $akc = AKCGroup::find($id);
        return view('akc_groups.edit', compact('akc'))->with('message', 'Record added successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
        ]); 
        $akc = AKCGroup::find($id);
        // Getting values from the blade template form
	    $akc->name = $request->name;

        $akc->save();
 
        return redirect()->back()->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        AKCGroup::where('id','=',$id)->delete();
        
        return redirect()->back()->with('message', 'Record deleted successfully');
    }
}
