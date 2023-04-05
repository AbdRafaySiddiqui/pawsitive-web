<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breeds;
use App\Models\BreedImgVids;
use App\Models\FCIGroup;
use App\Models\AKCGroup;
use App\Models\CFA;
use App\Models\Clubs;
use App\Models\Ratings;
use App\Models\specie;
use App\Models\Pets;
use DB;

class BreedsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breeds = Breeds::get();

        return view('breeds.index', compact('breeds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $FCI = FCIGroup::where('status','=','Active')->get();
        $AKC = AKCGroup::where('status','=','Active')->get();

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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $breed = Breeds::find($id);

        $ratings = Ratings::where('breed_id','=',$id)->get();

        return view('breeds.view', compact('breed','ratings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $breed = Breeds::find($id);

        $FCI = FCIGroup::where('status','=','Active')->get();
        $AKC = AKCGroup::where('status','=','Active')->get();
        $CFA = CFA::where('status','=','Active')->get();

        $clubs = Clubs::where('status','=','Active')->get();

        $species = specie::where('status','=','Active')->get();

        $countries = DB::table('countries')->get();

        $adapt_bones = Ratings::select('id','name','value')->where('breed_id','=',$id)->where('group_name','=','adapt')->get();

        $adapt = array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','2.0','2.1','2.2','2.3','2.4','2.5','2.6','2.7','2.8','2.9','3.0','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','4.0','4.1','4.2','4.3','4.4','4.5','4.6','4.7','4.8','4.9','5.0');

        $adapt_key = array_search($breed->adapt,$adapt);

        $friendly_bones = Ratings::select('id','name','value')->where('breed_id','=',$id)->where('group_name','=','friendly')->get();

        $friendly = array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','2.0','2.1','2.2','2.3','2.4','2.5','2.6','2.7','2.8','2.9','3.0','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','4.0','4.1','4.2','4.3','4.4','4.5','4.6','4.7','4.8','4.9','5.0');

        $friendly_key = array_search($breed->friendly,$friendly);

        $hg_bones = Ratings::select('id','name','value')->where('breed_id','=',$id)->where('group_name','=','health_groom')->get();

        $h_g = array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','2.0','2.1','2.2','2.3','2.4','2.5','2.6','2.7','2.8','2.9','3.0','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','4.0','4.1','4.2','4.3','4.4','4.5','4.6','4.7','4.8','4.9','5.0');

        $hg_key = array_search($breed->health_groom,$h_g);

        $train_bones = Ratings::select('id','name','value')->where('breed_id','=',$id)->where('group_name','=','train')->get();

        $train = array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','2.0','2.1','2.2','2.3','2.4','2.5','2.6','2.7','2.8','2.9','3.0','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','4.0','4.1','4.2','4.3','4.4','4.5','4.6','4.7','4.8','4.9','5.0');

        $train_key = array_search($breed->train,$train);

        $physical_bones = Ratings::select('id','name','value')->where('breed_id','=',$id)->where('group_name','=','physical')->get();

        $physical = array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','2.0','2.1','2.2','2.3','2.4','2.5','2.6','2.7','2.8','2.9','3.0','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','4.0','4.1','4.2','4.3','4.4','4.5','4.6','4.7','4.8','4.9','5.0');

        $physical_key = array_search($breed->physical,$physical);

        return view('breeds.edit', compact('breed','species','FCI','AKC','CFA','countries','adapt_key','friendly_key','hg_key','train_key','physical_key','clubs','adapt','physical','train','friendly','h_g','adapt_bones','train_bones','friendly_bones','hg_bones','physical_bones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $edit = Breeds::find($id);
        $edit->sp_id = $request->sp_id;
        $edit->name = $request->name;
        $edit->variations = $request->variations;
        $edit->fci_group = $request->fci_group;
        $edit->akc_group = $request->akc_group;
        $edit->cfa_group = $request->cfa_group;
        if($request->club_id != NULL && count($request->club_id) > 0)
        {
            $edit->club_id = implode(',',$request->club_id);
        }
        $edit->height_male = $request->height_male1.' TO '.$request->height_male2;
        $edit->height_female = $request->height_female1.' TO '.$request->height_female2;
        $edit->weight_male = $request->weight_male1.' TO '.$request->weight_male2;
        $edit->weight_female = $request->weight_female1.' TO '.$request->weight_female2;
        $edit->life_span = $request->life_span1.' TO '.$request->life_span2;
        $edit->country = $request->country;
        $edit->adapt = $request->adapt;
        $edit->friendly = $request->friendly;
        $edit->health_groom = $request->health_groom;
        $edit->train = $request->train;
        $edit->physical = $request->physical;
        $edit->about = htmlentities($request->about);
        $edit->history = htmlentities($request->history);
        $edit->personality = htmlentities($request->personality);
        $edit->health = htmlentities($request->health);
        $edit->care = htmlentities($request->care);
        $edit->feeding = htmlentities($request->feeding);
        $edit->grooming = htmlentities($request->grooming);
        $edit->child_pets = htmlentities($request->child_pets);

        $adapt_bones = Ratings::select('id','name','value')->where('breed_id','=',$id)->where('group_name','=','adapt')->get();
        $friendly_bones = Ratings::select('id','name','value')->where('breed_id','=',$id)->where('group_name','=','friendly')->get();
        $hg_bones = Ratings::select('id','name','value')->where('breed_id','=',$id)->where('group_name','=','health_groom')->get();
        $train_bones = Ratings::select('id','name','value')->where('breed_id','=',$id)->where('group_name','=','train')->get();
        $physical_bones = Ratings::select('id','name','value')->where('breed_id','=',$id)->where('group_name','=','physical')->get();

        foreach($adapt_bones as $ab)
        {
            $adb = Ratings::find($ab->id);
            $adb->value = $request->adp[$ab->id];
            $adb->update();
        }

        foreach($friendly_bones as $fb)
        {
            $frb = Ratings::find($fb->id);
            $frb->value = $request->frn[$fb->id];
            $frb->update();
        }

        foreach($hg_bones as $hg)
        {
            $hgb = Ratings::find($hg->id);
            $hgb->value = $request->hg[$hg->id];
            $hgb->update();
        }

        foreach($train_bones as $tb)
        {
            $trb = Ratings::find($tb->id);
            $trb->value = $request->trn[$tb->id];
            $trb->update();
        }

        foreach($physical_bones as $pb)
        {
            $phb = Ratings::find($pb->id);
            $phb->value = $request->physicalb[$pb->id];
            $phb->update();
        }

        if($edit->update()){
            return redirect()->route('breeds.index')->with('success','Breed has been updated successfully!');
        }else{
            return redirect()->route('breeds.index')->with('danger','Something went wrong. Please try editing a breed again.');
        }
    }

    public function upload_images(request $request, $id)
    {
        if($request->hasFile('images'))
        {
            $allowedfileExtension=['png','jpeg','jpg','jfif','gif'];
            $files = $request->file('images');
            foreach($files as $file)
            {
                $fileName = time().'.'.$file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                
                if(in_array($extension,$allowedfileExtension))
                {
                    $file->move(storage_path('app/public/breed_imgs'), $fileName);
                    $trnimg = new BreedImgVids;
                    $trnimg->breed_id = $id;
                    $trnimg->media = $fileName;
                    $trnimg->type = 'image';
                    $trnimg->save();
                }
            }
        }

        return redirect('trainers/'.$id.'/edit');
    }

    public function upload_videos(request $request, $id)
    {
        if($request->hasFile('videos'))
        {
            $allowedfileExtension=['mp4','mpeg'];
            $files = $request->file('videos');
            foreach($files as $file)
            {
                $fileName = time().'.'.$file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                
                if(in_array($extension,$allowedfileExtension))
                {
                    $file->move(storage_path('app/public/breed_vids'), $fileName);
                    $trnvid = new BreedImgVids;
                    $trnvid->breed_id = $id;
                    $trnvid->media = $fileName;
                    $trnvid->type = 'video';
                    $trnvid->save();
                }
            }
        }

        return redirect('trainers/'.$id.'/edit');
    }

    public function upload_profile_picture(request $request, $id)
    {
        if($request->hasFile('prof_pic'))
        {
            $allowedfileExtension=['png','jpeg','jpg','jfif','gif'];
            $file = $request->file('prof_pic');

                $fileName = time().'.'.$file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                
                if(in_array($extension,$allowedfileExtension))
                {
                    $file->move(storage_path('app/public/breed_profile_picture'), $fileName);
                    $brimg = Breeds::find($id);
                    $brimg->profile_photo = $fileName;
                    $brimg->update();
                }
        }

        return redirect('breeds/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Breeds::find($id);

        $delete->status = 'Inactive';

        if($delete->update()){
            return redirect()->route('breeds.index')->with('success','Breed has been deleted successfully!');
        }else{
            return redirect()->route('breeds.index')->with('danger','Something went wrong. Please try deleting a breed again.');
        }
    }
}
