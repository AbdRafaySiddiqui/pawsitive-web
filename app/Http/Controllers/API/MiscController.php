<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cities;
use App\Models\Countries;
use App\Models\Species;
use App\Models\Clubs;
use App\Models\Dogs;
use App\Models\Events;
use App\Models\OldGsdData;

use App\Models\Breeds;
use App\Models\BreedImgVids;

use App\Traits\Misc;

use JsonMachine\JsonDecoder\PassThruDecoder;
use JsonMachine\Items;

use Dymantic\InstagramFeed\Profile;
use Dymantic\InstagramFeed\InstagramFeed;

use GoogleSearch;

class MiscController extends Controller
{
    use Misc;

    public function statistic()
    {
        $clubs = Clubs::where('status','=','Active')->get();
        $totalNoClubs= $clubs->count();

        $dogs = Dogs::where('status','=','Active')->get();
        $totalNoDogs= $dogs->count();

        $breeds = Breeds::where('status','=','Active')->get();
        $totalNoBreeds= $breeds->count();


        $events = Events::where('status','=','Active')->get();
        $totalNoEvents= $events->count();
        
        return response()->json(['totalNoClubs' => $totalNoClubs,'totalNoDogs' => $totalNoDogs,'totalNoBreeds' => $totalNoBreeds,'totalNoEvents' => $totalNoEvents], 200);
    }

    public function countries()
    {
        $countries = Countries::get();

        $has = array();

        foreach($countries as $key => $c)
        {
            $cities = Cities::where('country','=',$c->idCountry)->count();
            
            if($cities > 0)
            {
                array_push($has, $c->idCountry);
            }
        }

        $countries_with_cities = Countries::whereIn('idCountry',$has)->get();

        return response()->json(['countries' => $countries_with_cities], 200);
    }
    
    public function cities()
    {
        $cities = Cities::get();

        return response()->json(['cities' => $cities], 200);
    }

    public function species()
    {
        $species = Species::select('id','name')->where('status','=','Active')->orderBy('name','ASC')->get();

        foreach($species as $key => $sp)
        {
            $breeds = Breeds::where('sp_id','=',$sp->id)->where('status','=','Active')->count();

            if($breeds == 0)
            {
                unset($species[$key]);
            }
        }

        return response()->json(['species' => $species], 200);
    }

    public function cities_by_countries(request $request)
    {
        $cities = Cities::where('country','=',$request->idCountry)->get();

        return response()->json(['cities' => $cities], 200);
    }

    public function upgrade_as_trainer(request $request)
    {
        if($request->hasFile('videos') && $request->hasFile('images'))
        {
            $vidserror = $this->check_vid_formats($request->file('videos'));
            $imgserror = $this->check_img_formats($request->file('images'));

            if($imgserror == 0 && $vidserror == 0)
            {
                    $info = TrainerInformation::insert(array(
                        'user_id' => $request->user_id,
                        'description' => $request->description,
                        'address' => $request->address,
                        'website' => $request->website,
                        'expertise' => $request->expertise
                    ));

                        if($vidserror == 0)
                        {

                            foreach($files as $file)
                            {
                                $fileName = $file->getClientOriginalName().'.'.time();
                                $extension = $file->getClientOriginalExtension();
                                
                                if(in_array($extension,$allowedfileExtension))
                                {
                                    $file->move(storage_path('app/public/trainer_vids'), $fileName);
                                    $trnvid = new TrainerImgVids;
                                    $trnvid->trainer_id = $request->user_id;
                                    $trnvid->media = $fileName;
                                    $trnvid->type = 'video';
                                    $trnvid->save();
                                }
                            }
                        }

                        if($imgserror == 0)
                        {
                            foreach($files as $file)
                            {
                                $fileName = $file->getClientOriginalName().'.'.time();
                                $extension = $file->getClientOriginalExtension();
                                
                                if(in_array($extension,$allowedfileExtension))
                                {
                                    $file->move(storage_path('app/public/trainer_imgs'), $fileName);
                                    $trnimg = new TrainerImgVids;
                                    $trnimg->trainer_id = $request->user_id;
                                    $trnimg->media = $fileName;
                                    $trnimg->type = 'image';
                                    $trnimg->save();
                                }
                            }
                        }
            }
            elseif($imgserror > 0 && $vidserror == 0)
            {
                return response()->json(['message' => 'Please upload your images in png, jpeg, jpg, jfif, gif format!'], 500);
            }
            elseif($imgserror == 0 && $vidserror > 0)
            {
                return response()->json(['message' => 'Please upload your images in mp4 or mpeg format!'], 500);
            }
            elseif($imgserror > 0 && $vidserror > 0)
            {
                return response()->json(['message' => 'Please upload your images in png, jpeg, jpg, jfif, gif format and videos in mp4 or mpeg format'], 500);
            }
            elseif($imgserror == 0 && $vidserror == 0)
            {
                $this->save_user_activity(null, $request->user_id, 'Sent Trainer Request', 'Sent Veterinarian Request Form from the Mobile App');

                return response()->json(['message' => 'Registration Complete!'], 200);
            }
        }
        elseif($request->hasFile('videos') && !$request->hasFile('images'))
        {
            return response()->json(['message' => 'Please upload atleaset 1 image!'], 500);
        }
        elseif(!$request->hasFile('videos') && $request->hasFile('images'))
        {
            return response()->json(['message' => 'Please upload atleaset 1 video!'], 500);
        }
        elseif(!$request->hasFile('videos') && !$request->hasFile('images'))
        {
            return response()->json(['message' => 'Please upload atleast one image and video!'], 500);
        }
    }

    public function upgrade_as_vet(request $request)
    {
        if($request->hasFile('degree'))
        {
            $allowedfileExtension=['png','jpeg','jpg','jfif','gif'];
            $file = $request->file('degree');

                $fileName = $file->getClientOriginalName().'.'.time();
                $extension = $file->getClientOriginalExtension();
                
                if(in_array($extension,$allowedfileExtension))
                {
                        $file->move(storage_path('app/public/vet_degrees'), $fileName);
                        $info = VetInformation::insert(array(
                            'vet_id' => $request->user_id,
                            'description' => $request->description,
                            'degree' => $fileName,
                            'sp_ids' => implode(',',$request->sp_ids),
                            'specialties' => $request->specialties,
                            'address' => implode(',',$request->address)
                        ));

                        $this->save_user_activity(null, $request->user_id, 'Sent Veterinarian Request', 'Sent Veterinarian Request Form from the Mobile App');

                        return response()->json(['message' => 'Request has been sent!'], 200);
                }
                else
                {
                    return response()->json(['message' => 'Please upload degree in png, jpeg, jpg format'], 500);
                }
        }
        else
        {
            return response()->json(['message' => 'Please upload degree!'], 500);
        }
    }

    public function check_img_formats($files)
    {
        $vidserror = 0;
        $allowedfileExtension=['mp4','mpeg'];
        foreach($files as $file)
        {
            $fileName = $file->getClientOriginalName().'.'.time();
            $extension = $file->getClientOriginalExtension();
            
            if(!in_array($extension,$allowedfileExtension))
            {
                $vidserror++; 
            }
        }

        return $vidserror;
    }

    public function check_vid_formats($files)
    {
        $imgserror = 0;

        $allowedfileExtension=['png','jpeg','jpg','jfif','gif'];
        foreach($files as $file)
        {
            $fileName = $file->getClientOriginalName().'.'.time();
            $extension = $file->getClientOriginalExtension();
            
            if(in_array($extension,$allowedfileExtension))
            {
                $imgserror++;
            }
        }

        return $imgserror;
    }

    public function import_data()
    {
        // return $this->import_file_data();

        if(file_exists('storage/app/public/GSD.json'))
        {
            $filename = asset('storage/app/public/GSD.json');
            $data = file_get_contents($filename); //data read from json file
            // echo $data;
            // $users = json_decode($data);  //decode a data
            


            $data = Items::fromFile($filename, ['decoder' => new PassThruDecoder]);
            $collection = collect($data);
            $chunks = $collection->chunk(1);
            $arr = array();
            $i = 0;
            // foreach ($chunks as $data) {
                foreach ($data as $d) {
                    foreach (Items::fromString($d) as $key => $value) {
                        
                        if(!is_array($value))
                        {
                            $arr[$i][$key] = $value;
                        }

                        

                        // print_r($key);
                        // echo " = ";
                        // print_r($value);
                        // echo "<br>";
                    }
                    $i++;
                }

            //     break;
            // }
                
            // print_r($data);

            for($i = 0; $i < count($arr); $i++)
            {
                // print_r($arr[$i]);
                // echo "<br>";

                $new = new OldGsdData;
                $new->_id = (isset($arr[$i]['_id'])) ? $arr[$i]['_id'] : NULL;
                $new->dog_name = (isset($arr[$i]['dog_name'])) ? $arr[$i]['dog_name'] : NULL;
                $new->reg_no = (isset($arr[$i]['RegNo'])) ? $arr[$i]['RegNo'] : NULL;
                $new->sire = (isset($arr[$i]['sire'])) ? $arr[$i]['sire'] : NULL;
                $new->dam = (isset($arr[$i]['dam'])) ? $arr[$i]['dam'] : NULL;
                $new->chip_number = (isset($arr[$i]['Chip Number'])) ? $arr[$i]['Chip Number'] : NULL;
                $new->tattoo = (isset($arr[$i]['Tattoo'])) ? $arr[$i]['Tattoo'] : NULL;
                $new->sex = (isset($arr[$i]['Sex'])) ? $arr[$i]['Sex'] : NULL;
                $new->dob = (isset($arr[$i]['Born'])) ? $arr[$i]['Born'] : NULL;
                $new->color = (isset($arr[$i]['Color'])) ? $arr[$i]['Color'] : NULL;
                $new->hair = (isset($arr[$i]['Hair style'])) ? $arr[$i]['Hair style'] : NULL;
                $new->kkl = (isset($arr[$i]['Kkl'])) ? $arr[$i]['Kkl'] : NULL;
                $new->show_result = (isset($arr[$i]['Show Result'])) ? $arr[$i]['Show Result'] : NULL;
                $new->hd_ed_dna = (isset($arr[$i]['HD / ED / DNA'])) ? $arr[$i]['HD / ED / DNA'] : NULL;
                $new->title = (isset($arr[$i]['Trial levels / Titles'])) ? $arr[$i]['Trial levels / Titles'] : NULL;
                $new->save();

                // break;
            }
                            // $new = new OldGsdData;
                            // if($key == "_id")
                            // {
                            //     $new->_id = $value;
                            // }elseif($key == "dog_name")
                            //     $new->dog_name = $value;
                            // elseif($key == "Reg No")
                            //     $new->reg_no = $value;
                            // elseif($key == "sire")
                            //     $new->sire = $value;
                            // elseif($key == "dam")
                            //     $new->dam = $value;
                            // $new->save();
            
            // if(is_array($users))
            // {
                // echo "is array"; //array format data printing
            // }
            // else
            // {
                // foreach($users as $d)
                // {
                //     print_r($d);

                //     break;
                // }
                
            // }
            echo "<h3 class='text-success'>JSON file data</h3>";
        }else{
            echo "<h3 class='text-danger'>JSON file Not found</h3>";
        }
    }

    public function instagram_api_1()
    {
        $breeds = Breeds::where('status', '=', 'Active')->get();

        foreach($breeds as $breed)
        {
            $hash_tag = str_replace(" ","_",strtolower($breed->name));
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://instagram-scraper2.p.rapidapi.com/hash_tag_medias_v2?hash_tag=".$hash_tag."&batch_size=50",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: instagram-scraper2.p.rapidapi.com",
                    "X-RapidAPI-Key: 712fe1ec85msh1bc3a28d2d4e08ep172c0djsnc42679298987"
                ],
            ]);

            $response = json_decode(curl_exec($curl));
            $err = curl_error($curl);

            curl_close($curl);

            if($err)
            {
                echo "cURL Error #:" . $err;
            }
            else
            {
                if(isset($response->hashtag->edge_hashtag_to_ranked_media))
                {
                    foreach($response->hashtag->edge_hashtag_to_ranked_media->edges as $file)
                    {
                        $trnimg = new BreedImgVids;
                        $trnimg->breed_id = $breed->id;
                        $trnimg->media = $file->node->display_url;
                        $trnimg->type = 'image';
                        $trnimg->save();
                    }
                }
                else
                {
                    echo json_encode($response) . ' | failed';
                    echo "<br>";

                    break;
                }
            }
        }
    }

    public function instagram_api()
    {
        $breeds = Breeds::where('status', '=', 'Active')->get();

        foreach($breeds as $breed)
        {
            // $count = BreedImgVids::where('breed_id','=',$breed->id)->count();

            if($count == 0)
            {
                $hash_tag = str_replace("-","_",str_replace(".","",str_replace(" ","_",strtolower($breed->name))));
                $query = [
                    "q" => $breed->name,
                    "tbm" => "isch",
                    "ijn" => "0",
                   ];
                   
                   $search = new GoogleSearch('eec3313c86b23b3ed1fbca8db056f01d4ef3640179fd1d74efec54340f0ec6fc');
                   $result = $search->get_json($query);
                   $images_results = $result->images_results;

                    if(isset($result->images_results))
                    {
                        foreach($images_results as $file)
                        {
                            if(isset($file->thumbnail))
                            {
                                    $url = $file->thumbnail;
                                    $allow = ['gif', 'jpg', 'png','jpeg','jfif'];
                                    $img = file_get_contents($url);
                                    $url_info = pathinfo($url);
                                    if(isset($url_info['extension']))
                                    {
                                        $fileName = time().'.'.$url_info['extension'];
                                        $check = BreedImgVids::where('media','=',$fileName)->first();

                                        if($check)
                                        {
                                            $fileName = 1+time().'.'.$url_info['extension'];
                                        }

                                        if(in_array($url_info['extension'], $allow))
                                        {
                                            file_put_contents(storage_path('app/public/breed_imgs').'/'.$fileName, $img );
                                            $trnimg = new BreedImgVids;
                                            $trnimg->breed_id = $breed->id;
                                            $trnimg->media = $fileName;
                                            $trnimg->type = 'image';
                                            $trnimg->save();
                                        }
                                    } 
                            }
                        }
                    }
                
            }
        }
    }

    public function instagram_api_response_reader(request $request)
    {
        $response = json_decode($request->getContent());
        
        foreach($response->data as $file)
        {
            $trnimg = new BreedImgVids;
            $trnimg->breed_id = $breed->id;
            $trnimg->media = $file->image_versions2->candidates[4]->url_original;
            $trnimg->type = 'image';
            $trnimg->save();
        }
    }
}
