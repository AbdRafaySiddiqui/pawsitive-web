<?php

namespace App\Http\Controllers\API;

use App\Models\Breeds;
use App\Models\BreedImgVids;
use App\Models\Ratings;
use App\Traits\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BreedController extends Controller
{
    use Activity;

    public function listing(request $request)
    {
        $breeds = Breeds::select('breeds.id','breeds.name as breed_name','profile_photo')
                      ->where('breeds.status','=','Active')
                      ->orderBy('breeds.name','ASC')
                      ->get();

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

        $this->save_user_activity(6, $request->user_id, 'View', 'Viewed Breed List from Mobile App');

        return response()->json(['breeds' => $breeds], 200);
    }

    public function details(request $request, $id)
    {
        $breed = Breeds::select('breeds.id',
                                'breeds.name as breed_name',
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
                      ->leftjoin('countries','countries.idCountry','=','breeds.country')
                      ->find($id);

            $Media = BreedImgVids::where('breed_id','=',$breed->id)->inRandomOrder()->get();
            $media = array();
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

            foreach($Media as $m)
            {
                if(!in_array(asset('storage/app/public/breed_imgs').'/'.$m->media, $media))
                {
                    if(file_exists(storage_path().'/app/public/breed_imgs'.'/'.$m->media))
                    {
                        array_push($media, asset('storage/app/public/breed_imgs').'/'.$m->media);
                    }
                    // else
                    // {
                    //     BreedImgVids::where('media', '=', $m->media)->delete();
                    // }
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
    }
}
