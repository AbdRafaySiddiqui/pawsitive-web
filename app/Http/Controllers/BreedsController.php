<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breeds;
use App\Models\Clubs;
use App\Models\Countries;
use App\Models\Species;
use App\Models\AKCGroup;
use App\Models\FCIGroup;
use App\Models\Ratings;

class BreedsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breed = Breeds::get();
        
        return view('breeds.index',compact('breed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $FCI = FCIGroup::where('status','=','Active')->get();
        $AKC = AKCGroup::where('status','=','Active')->get();
        $clubs = Clubs::where('status','=','Active')->get();

        $species = Species::where('status','=','Active')->get();

        $countries = Countries::get();

        $adapt_bones = array(
                        'Suited To Apartment Living',
                        'Good For Novice Owners',
                        'Sensitivity Level',
                        'Tolerates Being Alone',
                        'Tolerates Cold Weather',
                        'Tolerates Hot Weather'
        );

        $friendly_bones = array(
                        'Affectionate With Family',
                        'Kid-Friendly',
                        'Dog Friendly',
                        'Friendly Towards Strangers'
        );

        $hg_bones = array(
                        'Amount Of Shedding',
                        'Drooling Potential',
                        'Easy To Groom',
                        'General Health',
                        'Potential For Weight Gain',
                        'Size'
        );

        $train_bones = array(
                        'Easy To Train',
                        'Intelligence',
                        'Potential For Mouthiness',
                        'Prey Drive',
                        'Tendency to Bark or Howl',
                        'Wanderlust Potential'
        );

        $physical_bones = array(
                        'Energy Level',
                        'Intensity',
                        'Exercise Needs',
                        'Potential for Playfulness'
        );

        $adapt = array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','2.0','2.1','2.2','2.3','2.4','2.5','2.6','2.7','2.8','2.9','3.0','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','4.0','4.1','4.2','4.3','4.4','4.5','4.6','4.7','4.8','4.9','5.0');

        $friendly = array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','2.0','2.1','2.2','2.3','2.4','2.5','2.6','2.7','2.8','2.9','3.0','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','4.0','4.1','4.2','4.3','4.4','4.5','4.6','4.7','4.8','4.9','5.0');

        $h_g = array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','2.0','2.1','2.2','2.3','2.4','2.5','2.6','2.7','2.8','2.9','3.0','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','4.0','4.1','4.2','4.3','4.4','4.5','4.6','4.7','4.8','4.9','5.0');

        $train = array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','2.0','2.1','2.2','2.3','2.4','2.5','2.6','2.7','2.8','2.9','3.0','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','4.0','4.1','4.2','4.3','4.4','4.5','4.6','4.7','4.8','4.9','5.0');

        $physical = array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','2.0','2.1','2.2','2.3','2.4','2.5','2.6','2.7','2.8','2.9','3.0','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','4.0','4.1','4.2','4.3','4.4','4.5','4.6','4.7','4.8','4.9','5.0');

        return view('breeds.create', compact('countries','adapt','friendly','h_g','train','physical','adapt_bones','friendly_bones','hg_bones','train_bones','physical_bones','clubs','AKC','FCI'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $adapt_bones = array(
            'Suited To Apartment Living',
            'Good For Novice Owners',
            'Sensitivity Level',
            'Tolerates Being Alone',
            'Tolerates Cold Weather',
            'Tolerates Hot Weather'
);

$friendly_bones = array(
            'Affectionate With Family',
            'Kid-Friendly',
            'Dog Friendly',
            'Friendly Towards Strangers'
);

$hg_bones = array(
            'Amount Of Shedding',
            'Drooling Potential',
            'Easy To Groom',
            'General Health',
            'Potential For Weight Gain',
            'Size'
);

$train_bones = array(
            'Easy To Train',
            'Intelligence',
            'Potential For Mouthiness',
            'Prey Drive',
            'Tendency to Bark or Howl',
            'Wanderlust Potential'
);

$physical_bones = array(
            'Energy Level',
            'Intensity',
            'Exercise Needs',
            'Potential for Playfulness'
);

$new = new Breeds;
// $new->sp_id = $request->sp_id;
$new->name = $request->name;
$new->variations = $request->variations;
$new->fci_group = $request->fci_group;
$new->akc_group = $request->akc_group;
$new->cfa_group = $request->cfa_group;
if($request->club_id != NULL && count($request->club_id) > 0)
{
$new->club_id = implode(',',$request->club_id);
}
$new->height_male = $request->height_male1.' TO '.$request->height_male2;
$new->height_female = $request->height_female1.' TO '.$request->height_female2;
$new->weight_male = $request->weight_male1.' TO '.$request->weight_male2;
$new->weight_female = $request->weight_female1.' TO '.$request->weight_female2;
$new->life_span = $request->life_span1.' TO '.$request->life_span2;
$new->country = $request->country;
$new->adapt = $request->adapt;
$new->friendly = $request->friendly;
$new->health_groom = $request->health_groom;
$new->train = $request->train;
$new->physical = $request->physical;
$new->about = htmlentities($request->about);
$new->history = htmlentities($request->history);
$new->personality = htmlentities($request->personality);
$new->health = htmlentities($request->health);
$new->care = htmlentities($request->care);
$new->feeding = htmlentities($request->feeding);
$new->grooming = htmlentities($request->grooming);
$new->child_pets = htmlentities($request->child_pets);

if($new->save())
{

for($i = 0; $i < count($adapt_bones); $i++)
{
    $adb = new Ratings;
    $adb->breed_id = $new->id;
    $adb->name = $adapt_bones[$i];
    $adb->group_name = 'adapt';
    $adb->value = $request->adp[$i];
    $adb->save();
}

for($j = 0; $j < count($friendly_bones); $j++)
{
    $frb = new Ratings;
    $frb->breed_id = $new->id;
    $frb->name = $friendly_bones[$j];
    $frb->group_name = 'friendly';
    $frb->value = $request->frn[$j];
    $frb->save();
}

for($k = 0; $k < count($hg_bones); $k++)
{
    $hgb = new Ratings;
    $hgb->breed_id = $new->id;
    $hgb->name = $hg_bones[$k];
    $hgb->group_name = 'health_groom';
    $hgb->value = $request->hg[$k];
    $hgb->save();
}

for($l = 0; $l < count($train_bones); $l++)
{
    $trb = new Ratings;
    $trb->breed_id = $new->id;
    $trb->name = $train_bones[$l];
    $trb->group_name = 'train';
    $trb->value = $request->trainb[$l];
    $trb->save();
}

for($m = 0; $m < count($physical_bones); $m++)
{
    $phb = new Ratings;
    $phb->breed_id = $new->id;
    $phb->name = $physical_bones[$m];
    $phb->group_name = 'physical';
    $phb->value = $request->physicalb[$m];
    $phb->save();
}

if($request->hasFile('files'))
{
    $allowedfileExtensionimg=['png','jpeg','jpg','jfif','gif'];
    $allowedfileExtensionvids=['mp4','mpeg'];
    $files = $request->file('files');
    foreach($files as $file)
    {
        $fileName = time().'.'.$file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        
        if(in_array($extension,$allowedfileExtensionimg))
        {
            $file->move(storage_path('app/public/breed_imgs'), $fileName);
            $trnimg = new BreedImgVids;
            $trnimg->breed_id = $new->id;
            $trnimg->media = $fileName;
            $trnimg->type = 'image';
            $trnimg->save();
        }
        elseif(in_array($extension,$allowedfileExtensionvids))
        {
            $file->move(storage_path('app/public/breed_vids'), $fileName);
            $trnimg = new BreedImgVids;
            $trnimg->breed_id = $new->id;
            $trnimg->media = $fileName;
            $trnimg->type = 'video';
            $trnimg->save();
        }
    }
}

if($request->hasFile('pp'))
{
    $allowedfileExtension=['png','jpeg','jpg','jfif','gif'];
    $file = $request->file('pp');

        $fileName = time().'.'.$file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        
        if(in_array($extension,$allowedfileExtension))
        {
            $file->move(storage_path('app/public/breed_profile_picture'), $fileName);
            $brimg = Breeds::find($new->id);
            $brimg->profile_photo = $fileName;
            $brimg->update();
        }
}

return redirect()->route('breeds.index')->with('success','New Breed has been created successfully!');
}
else
{
return redirect()->route('breeds.index')->with('danger','Something went wrong. Please try creating a new breed again.');
}
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
    public function edit(string $id)
    {
        $breed = Breeds::find($id);
        return view('breeds.edit', compact('breed')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
        ]); 
        $breeds = Breeds::find($id);
        // Getting values from the blade template form
	    $breeds->name = $request->name;

	
        $breeds->save();
 
        return redirect()->back()->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Breeds::where('id','=',$id)->update(array('status' => 'Inactive'));
        
        return redirect()->back()->with('message', 'Record deleted successfully');
    }
}
