<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\Countries;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = Cities::get();

        return view('cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $countries = Countries::get();        
        return view('cities.create',compact('countries'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cities = new Cities;

        $cities->city =  $request->name;
	    $cities->country = $request->country;

        $res = $cities->save();

        if($res)
        {
            return redirect()->back()->with('message', 'Record added successfully');
        }
        else
        {
        return redirect()->back()->with('message', 'Error occured');
        }
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
    public function edit(string $id)
    {
        $edit = Cities::find($id);
        $total_countries = Countries::get();

        return view('cities.edit', compact('edit','total_countries')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cities = Cities::find($id);
        // Getting values from the blade template form
	    $cities->city = $request->name;
	    $cities->country = $request->country;
        $cities->update();

        try {
            $cities->update();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the record. Please try again later.');
        }
    
        return redirect()->back()->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cities::where('id',$id)->update(array('status' => 'Inactive'));
        
        return redirect()->back()->with('message', 'Record deleted successfully');
    }
}
