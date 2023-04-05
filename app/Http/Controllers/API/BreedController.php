<?php

namespace App\Http\Controllers\API;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Breeds;
use App\Models\BreedImgVids;
use App\Models\Ratings;
use App\Models\Pets;

use App\Traits\Activity;

=======
use App\Models\Breeds;
use App\Models\BreedImgVids;
use App\Models\Ratings;
use App\Traits\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

>>>>>>> 607bc2251d41f382b9c44fe25b44dbf0ee928d5c
class BreedController extends Controller
{
    use Activity;

<<<<<<< HEAD


    public function breed_short(request $request)
    {
        $breeds = Breeds::select('breeds.id','breeds.name as breed_name',)
          ->where('breeds.status','=','Active')
          ->orderBy('breeds.name','ASC')
          ->get();
        
        return response()->json(['breeds' => $breeds], 200);
    }

    public function listing(request $request)
    {
        $breeds = Breeds::select('breeds.id','breeds.name as breed_name','profile_photo')
                    //   ->leftjoin('species','species.id','=','breeds.sp_id')
=======
    public function listing(request $request)
    {
        $breeds = Breeds::select('breeds.id','breeds.name as breed_name','profile_photo')
>>>>>>> 607bc2251d41f382b9c44fe25b44dbf0ee928d5c
                      ->where('breeds.status','=','Active')
                      ->orderBy('breeds.name','ASC')
                      ->get();

<<<<<<< HEAD
        // foreach($breeds as $breed)
        // {
        //     $pp = BreedImgVids::where('breed_id','=',$breed->id)->inRandomOrder()->get();

        //     $breed->profile_photo = asset('storage/app/public/noimage.png');

        //     if(count($pp) > 0)
        //     {
        //         foreach($pp as $m)
        //         {
        //             if(file_exists(storage_path().'/app/public/breed_imgs'.'/'.$m->media))
        //             {
        //                 $breed->profile_photo = asset('storage/app/public/breed_imgs').'/'.$m->media;

        //                 break;
        //             }
        //         }
        //     }
        // }
=======
        foreach($breeds as $breed)
        {
            $pp = BreedImgVids::where('breed_id','=',$breed->id)->inRandomOrder()->get();

            $breed->profile_photo = asset('storage/app/public/noimage.png');

            if(count($pp) > 0)
            {
                foreach($pp as $m)
                {
                    if(file_exists(storage_path().'/app/public/breed_imgs'.'/'.$m->media))
                    {
                        $breed->profile_photo = asset('storage/app/public/breed_imgs').'/'.$m->media;

                        break;
                    }
                }
            }
        }
>>>>>>> 607bc2251d41f382b9c44fe25b44dbf0ee928d5c

        $this->save_user_activity(6, $request->user_id, 'View', 'Viewed Breed List from Mobile App');

        return response()->json(['breeds' => $breeds], 200);
    }

    public function details(request $request, $id)
    {
        $breed = Breeds::select('breeds.id',
                                'breeds.name as breed_name',
<<<<<<< HEAD
                                // 'species.name as species',
=======
>>>>>>> 607bc2251d41f382b9c44fe25b44dbf0ee928d5c
                                'breeds.height_male',
                                'breeds.height_female',
                                'breeds.weight_male',
                                'breeds.weight_male',
                                'breeds.life_span',
                                'countries.countryName as country_of_origin',
                                'breeds.adapt as adaptability_rating',
                                'breeds.friendly as overall_friendliness_rating',
                                'breeds.health_groom as health_groom_rating',
                                'breeds.train as trainability_rating',
                                'breeds.physical as physical_needs_rating',
                                'breeds.history',
                                'breeds.about as about_the_breed',
                                'breeds.personality',
                                'breeds.health',
                                'breeds.care',
                                'breeds.feeding',
                                'breeds.grooming',
                                'breeds.child_pets as children_and_pets')
<<<<<<< HEAD
                    //   ->leftjoin('species','species.id','=','breeds.sp_id')
                      ->leftjoin('countries','countries.idCountry','=','breeds.country')
                      ->find($id);

            // $Media = BreedImgVids::where('breed_id','=',$breed->id)->inRandomOrder()->get();
            // $media = array();
=======
                      ->leftjoin('countries','countries.idCountry','=','breeds.country')
                      ->find($id);

            $Media = BreedImgVids::where('breed_id','=',$breed->id)->inRandomOrder()->get();
            $media = array();
>>>>>>> 607bc2251d41f382b9c44fe25b44dbf0ee928d5c
            if($breed)
            {
                if($breed->height_male == " TO ")
                {
                    $breed->height_male = NULL; 
                }

                if($breed->height_female == " TO ")
                {
                    $breed->height_female = NULL; 
                }

                if($breed->weight_male == " TO ")
                {
                    $breed->weight_male = NULL; 
                }

                if($breed->weight_female == " TO ")
                {
                    $breed->weight_female = NULL; 
                }

                if($breed->life_span == " TO ")
                {
                    $breed->life_span = NULL; 
                }
            }

            $ratings = array();
            $bones = Ratings::where('breed_id','=',$id)->get();

            foreach($bones as $bone)
            {
                $ratings[$bone->group_name][str_replace('-','_',str_replace(' ','_',strtolower($bone->name)))] = $bone->value;
            }

<<<<<<< HEAD
            // foreach($Media as $m)
            // {
            //     if(!in_array(asset('storage/app/public/breed_imgs').'/'.$m->media, $media))
            //     {
            //         if(file_exists(storage_path().'/app/public/breed_imgs'.'/'.$m->media))
            //         {
            //             array_push($media, asset('storage/app/public/breed_imgs').'/'.$m->media);
            //         }
=======
            foreach($Media as $m)
            {
                if(!in_array(asset('storage/app/public/breed_imgs').'/'.$m->media, $media))
                {
                    if(file_exists(storage_path().'/app/public/breed_imgs'.'/'.$m->media))
                    {
                        array_push($media, asset('storage/app/public/breed_imgs').'/'.$m->media);
                    }
>>>>>>> 607bc2251d41f382b9c44fe25b44dbf0ee928d5c
                    // else
                    // {
                    //     BreedImgVids::where('media', '=', $m->media)->delete();
                    // }
<<<<<<< HEAD
            //     }
            // }

            // if(count($Media) == 0)
            // {
            //     $breed->profile_photo = asset('storage/app/public/noimage.png');
            // }
            // else
            // {
            //     foreach($Media as $m)
            //     {
            //         if(file_exists(storage_path().'/app/public/breed_imgs'.'/'.$m->media))
            //         {
            //             $breed->profile_photo = asset('storage/app/public/breed_imgs').'/'.$m->media;

            //             break;
            //         }
            //     }
                
            // }

        $this->save_user_activity(6, $request->user_id, 'View', 'Viewed Breed Details of '.$breed->name.' from Mobile App');

        return response()->json(['breed' => $breed, 'ratings' => $ratings], 200);
    }

    public function get_by_species(request $request)
    {
        $breeds = Breeds::select('breeds.id','breeds.name as breed_name','species.name as species','profile_photo')
                      ->leftjoin('species','species.id','=','breeds.sp_id')
                      ->where('breeds.status','=','Active')
                      ->where('breeds.sp_id','=',$request->id)
                      ->orderBy('breeds.name','ASC')
                      ->get();
        
        return response()->json(['breeds' => $breeds], 200);
    }

    public function pets_by_breed(request $request)
    {
        if(isset($request->except))
        {
            $pets = Pets::select('id','name','gender')
                        ->where('breed_id','=',$request->id)
                        ->where('id','!=',$request->except)
                        ->get();
        }
        else
        {
            $pets = Pets::select('id','name','gender')
                        ->where('breed_id','=',$request->id)
                        ->get();
        }
        
        return response()->json(['pets' => $pets], 200);
=======
                }
            }

            if(count($Media) == 0)
            {
                $breed->profile_photo = asset('storage/app/public/noimage.png');
            }
            else
            {
                foreach($Media as $m)
                {
                    if(file_exists(storage_path().'/app/public/breed_imgs'.'/'.$m->media))
                    {
                        $breed->profile_photo = asset('storage/app/public/breed_imgs').'/'.$m->media;

                        break;
                    }
                }
                
            }

        $this->save_user_activity(6, $request->user_id, 'View', 'Viewed Breed Details of '.$breed->name.' from Mobile App');

        return response()->json(['breed' => $breed, 'ratings' => $ratings, 'media' => $media], 200);
>>>>>>> 607bc2251d41f382b9c44fe25b44dbf0ee928d5c
    }
}
