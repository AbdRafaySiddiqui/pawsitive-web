<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pets;
use App\Models\PetOwnership;
use App\Models\PetImgVids;
use App\Models\PetDocuments;
use App\Models\PetVaccinations;

use App\Models\User;

use App\Traits\Activity;

use DB;

class PetsController extends Controller
{
    use Activity;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request, $id)
    {
        $user = User::find($id);

        if($request->user_id == $id)
        {

            $pets = Pets::select('pets.id',
                                'pets.name',
                                'pets.profile_photo_path')
                    ->leftjoin('pet_ownership','pet_ownership.pet_id','=','pets.id')
                    ->where('pet_ownership.owner_id','=',$id)
                    ->whereIn('pet_ownership.type',['current','lease'])
                    ->get();
        }
        else
        {
            $pets = Pets::select('pets.id',
                                'pets.name',
                                'pets.profile_photo_path')
                    ->leftjoin('pet_ownership','pet_ownership.pet_id','=','pets.id')
                    ->where('pet_ownership.owner_id','=',$id)
                    ->whereIn('pet_ownership.type',['current','lease'])
                    ->where('pets.status','=','Active')
                    ->get();
        }

        foreach($pets as $pet)
        {
            if(is_null($pet->profile_photo_path))
            {
                $pet->profile_photo_path = asset('storage/app/public/noimage.png');
            }
            else
            {
                $pet->profile_photo_path = asset('storage/app/public/pet_profile_picture').'/'.$pet->profile_photo_path;
            }
        }

        if($request->user_id == $id)
        {
            $this->save_user_activity(10, $request->user_id, 'View', 'Viewed their list of Pets from Mobile App');
        }
        else
        {
            $this->save_user_activity(10, $request->user_id, 'View', "Viewed ".$user->name."'s list of Pets from Mobile App");
        }

        return response()->json(['pets' => $pets], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $_parts = json_decode($request->getContent());

        $array = $_parts->_parts;

        try {

            $imgs = array();
            $imgscount = 0;

            $docs = array();
            $docscount = 0;
            
            $vids = array();
            $vidscount = 0;

            for($i = 0; $i < count($array); $i++)
            {
                if($array[$i][0] == 'name')
                {
                    $name = $array[$i][1];
                }
                elseif($array[$i][0] == 'owner_id')
                {
                    $owner_id = $array[$i][1];
                }
                elseif($array[$i][0] == 'dob')
                {
                    $dob = $array[$i][1];
                }
                elseif($array[$i][0] == 'height')
                {
                    $height = $array[$i][1];
                }
                elseif($array[$i][0] == 'weight')
                {
                    $weight = $array[$i][1];
                }
                elseif($array[$i][0] == 'color')
                {
                    $color = $array[$i][1];
                }
                elseif($array[$i][0] == 'gender')
                {
                    $gender = $array[$i][1];
                }
                elseif($array[$i][0] == 'breed_id')
                {
                    $breed_id = $array[$i][1];
                }
                elseif($array[$i][0] == "vaccinationName_Date")
                {
                    $vaccs = $array[$i][1];
                }

                if($array[$i][0] == 'images')
                {
                    // if(count($array[$i][1]) > 0)
                    // {
                        foreach($array[$i][1] as $img)
                        {
                            if(is_object($img))
                            {
                                $imgs[$imgscount] = $img;

                                $imgscount++;
                            }

                        }

                        for($I = 0; $I < $imgscount; $I++)
                        {
                            foreach($array[$i][1] as $img)
                            {
                                if(is_array($img))
                                {
                                    $imgs[$I]->base = $img[$I];

                                }

                            }
                        }
                    // }
                }

                if($array[$i][0] == 'docs')
                {
                    if(count($array[$i][1]) > 0)
                    {
                        foreach($array[$i][1] as $doc)
                        {
                            if(is_object($doc))
                            {
                                $arr = (array)$doc->fileDoc;

                                $docs[$docscount] = $arr["0"];
                                $docs[$docscount]->base = $arr["base"][0];

                                $docscount++;
                                
                            }
                        }
                    }
                    
                }

                if($array[$i][0] == 'videos')
                {
                    if(count($array[$i][1]) > 0)
                    {
                        foreach($array[$i][1] as $vid)
                        {
                            if(is_object($vid))
                            {
                                $vids[$vidscount] = $vid;

                                $vidscount++;
                            }

                        }

                        for($I = 0; $I < $vidscount; $I++)
                        {
                            foreach($array[$i][1] as $vid)
                            {
                                if(is_array($vid))
                                {
                                    $vids[$I]->base = $vid[$I];
                                }

                            }
                        }
                    }
                }
            }
        

            // return response()->json(['images' => $imgs, 'docs' => $docs], 200);

            if(count($imgs) > 0)
            {
                $unid = uniqid();
                $new = new Pets;
                $new->unid = $unid;
                $new->name = $name;
                $new->gender = $gender;
                $new->breed_id = $breed_id;
                $new->color = $color;
                $new->height = $height;
                $new->weight = $weight;
                $new->dob = $dob;
                $new->save();
                
                if($new->save())
                {

                    $allowedfileExtensionvids=['mp4','mpeg'];
                    $allowedfileExtensionimg=['png','jpeg','jpg','jfif','gif'];

                    if(count($imgs) > 0)
                    {

                        foreach($imgs as $file) // for images
                        {
                            $fileName = time().'.'.$file->fileName;
                            $extension = pathinfo($file->fileName, PATHINFO_EXTENSION);
                            
                            if(in_array($extension,$allowedfileExtensionimg))
                            {
                                // $myfile = fopen(storage_path('app/public/pet_imgs').'/'.$fileName, "w");
                                // $file->move(storage_path('app/public/pet_imgs'), $fileName);
                                file_put_contents(storage_path('app/public/pet_imgs').'/'.$fileName, base64_decode($file->base) );
                                $trnvid = new PetImgVids;
                                $trnvid->pet_id = $new->id;
                                $trnvid->media = $fileName;
                                $trnvid->type = 'image';
                                $trnvid->save();
                            }
                        }


                        foreach($imgs as $file) // for profile picture
                        {
                            $fileName = time().'.'.$file->fileName;
                            $extension = pathinfo($file->fileName, PATHINFO_EXTENSION);
                            
                            if(in_array($extension,$allowedfileExtensionimg))
                            {
                                // $myfile = fopen(storage_path('app/public/pet_imgs').'/'.$fileName, "w");
                                // $file->move(storage_path('app/public/pet_imgs'), $fileName);
                                file_put_contents(storage_path('app/public/pet_profile_picture').'/'.$fileName, base64_decode($file->base) );

                                    $update_pet_pp = Pets::where('id','=',$new->id)->update(array('profile_photo_path' => $fileName));

                                break;
                            }
                        }

                    }

                    if(count($vids) > 0)
                    {

                        foreach($vids as $file) // for profile picture
                        {
                            $fileName = time().'.'.$file->fileName;
                            $extension = pathinfo($file->fileName, PATHINFO_EXTENSION);
                            
                            if(in_array($extension,$allowedfileExtensionimg))
                            {
                                // $myfile = fopen(storage_path('app/public/pet_imgs').'/'.$fileName, "w");
                                // $file->move(storage_path('app/public/pet_imgs'), $fileName);
                                file_put_contents(storage_path('app/public/pet_vids').'/'.$fileName, base64_decode($file->base) );
                                $trnvid = new PetImgVids;
                                $trnvid->pet_id = $new->id;
                                $trnvid->media = $fileName;
                                $trnvid->type = 'video';
                            }
                        }

                    }
                

                    if(count($docs) > 0)
                    {
                        $allowedfileExtension=['png','jpeg','jpg','jfif','gif','pdf','txt','docx','doc'];
                        
                        foreach($docs as $file) // for profile picture
                        {
                            $fileName = time().'.'.$file->name;
                            $extension = pathinfo($file->name, PATHINFO_EXTENSION);
                            
                            if(in_array($extension,$allowedfileExtension))
                            {
                                // $myfile = fopen(storage_path('app/public/pet_imgs').'/'.$fileName, "w");
                                // $file->move(storage_path('app/public/pet_imgs'), $fileName);
                                file_put_contents(storage_path('app/public/pet_documents').'/'.$fileName, base64_decode($file->base) );
                                $trnimg = new PetDocuments;
                                $trnimg->document = $fileName;
                                $trnimg->pet_id = $new->id;
                                $trnimg->save();
                            }
                        }
                    }

                    $ownership = new PetOwnership;
                    $ownership->pet_id = $new->id;
                    $ownership->owner_id = $owner_id;
                    $ownership->type = 'current';
                    $ownership->save();

                    for($i = 0; $i < count($vaccs); $i++)
                    {
                        $vacc = new PetVaccinations;
                        $vacc->name = $vaccs[$i]->vacciName;
                        $vacc->date = $vaccs[$i]->vacciDate;
                        $vacc->pet_id = $new->id;
                        $vacc->save();
                    }

                    $this->save_user_activity(10, $owner_id, 'Create', 'Added New Pet ('.$new->name.') from Mobile App');

                    return response()->json(['message' => 'Pet has been uploaded and is waiting to be approved!', 'pet_id' => $new->id], 200);
                }
                else
                {
                    return response()->json(['message' => 'Something went wrong! Please try again later'], 500);
                }
            }
            else
            {
                return response()->json(['message' => 'Please upload atleast 1 image'], 500);
            }

        } catch (Throwable $e) {
            
            // report($e);
    
            return response()->json(['message' => 'Something went wrong, please try again'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(request $request, $id)
    {
        $pet = Pets::select('pets.id',
                             'pets.name',
                             'breeds.name as breed',
                             'species.name as species',
                             'pets.gender',
                             'pets.dob',
                             DB::raw('CONCAT(sire.name," - ", sire.reg_number) as father'),
                             DB::raw('CONCAT(dam.name," - ", dam.reg_number) as mother'),
                             'microchips.microchip',
                             'pets.height',
                             'pets.weight',
                             'pets.reg_number',
                             'pets.profile_photo_path',
                             'pets.verified',
                             'microchips.microchip',
                             'pets.status as pet_status')
                  ->leftjoin('pet_ownership','pet_ownership.pet_id','=','pets.id')
                  ->leftjoin('breeds','breeds.id','=','pets.breed_id')
                  ->leftjoin('species','species.id','=','breeds.sp_id')
                  ->leftjoin('pets as sire','sire.id','=','pets.sire_id')
                  ->leftjoin('pets as dam','dam.id','=','pets.dam_id')
                  ->leftjoin('microchips','microchips.id','=','pets.microchip_id')
                  ->whereIn('pet_ownership.type',['current','lease'])
                  ->where('pets.id','=',$id)
                  ->first();
        if($pet)
        {
            $media = PetImgVids::where('pet_id','=',$id)->get();

            foreach($media as $m)
            {
                if($m->type == 'video')
                {
                    $m->media = asset('storage/app/public/pet_vids').'/'.$m->media;
                }
                else
                {
                    $m->media = asset('storage/app/public/pet_imgs').'/'.$m->media;
                }
            }

            $documents = PetDocuments::where('pet_id','=',$id)->get();
            $vaccs = PetVaccinations::select('name','date')->where('pet_id','=',$id)->get();

            foreach($documents as $m)
            {
                $m->document_name = $m->document;
                $m->document = asset('storage/app/public/pet_documents').'/'.$m->document;
            }

            if(is_null($pet->profile_photo_path))
            {
                $pet->profile_photo_path = asset('storage/app/public/noimage.png');
            }
            else
            {
                $pet->profile_photo_path = asset('storage/app/public/pet_profile_picture').'/'.$pet->profile_photo_path;
            }

            if(is_null($pet->father))
            {
                $pet->father = 'No Information';
            }
            if(is_null($pet->mother))
            {
                $pet->mother = 'No Information';
            }
            if(is_null($pet->microchip))
            {
                $pet->microchip = 'No Information';
            }

            $this->save_user_activity(10, $request->user_id, 'View', 'Viewed Pet Profile of '.$pet->name.' from Mobile App');

            return response()->json(['pet' => $pet, 'media' => $media, 'documents' => $documents, 'vaccinations' => $vaccs], 200);
        }
        else
        {
            return response()->json(['pet' => array(), 'media' => array(), 'documents' => array()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
