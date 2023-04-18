<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use App\Traits\Activity;

use DB;

class MemberController extends Controller
{
    use Activity;
    
    public function user_profile(request $request, $id)
    {
        $profile = User::select('users.name',
                        'users.email',
                        // 'users.phone',
                        // DB::raw('CONCAT(cities.city,", ",countries.countryName) as location')
                        )
                        // ->leftjoin('countries','countries.idCountry','=','users.country_id')
                        // ->leftjoin('cities','cities.id','=','users.city_id')
                        ->find($id);
        if($profile)
        {
            if(is_null($profile->profile_photo_path))
            {
                $profile->profile_photo_path = asset('storage/app/public/noimage.png');
            }
            else
            {
                $profile->profile_photo_path = asset('storage/app/public/member_profile_picture').'/'.$profile->profile_photo_path;
            }

            $this->save_user_activity(14, $request->user_id, 'View', 'Viewed Member Profile of '.$profile->name.' from Mobile App');

            return response()->json(['data' => $profile], 200);
        }
        else
        {
            return response()->json(['data' => array()], 404);
        }
    }

    public function my_profile(request $request)
    {
        $profile = User::select('users.name',
                                 'users.email',
                                //  'users.phone',
                                //  'users.pet_preference',
                                //  DB::raw('CONCAT(cities.city,", ",countries.countryName) as location'),
                                //  'users.country_id',
                                //  'users.city_id',
                                //  'users.profile_photo_path')
        )
                        // ->leftjoin('countries','countries.idCountry','=','users.country_id')
                        // ->leftjoin('cities','cities.id','=','users.city_id')
                        ->find($request->user_id);
        if($profile)
        {
            if(is_null($profile->profile_photo_path))
            {
                $profile->profile_photo_path = asset('storage/app/public/noimage.png');
            }
            else
            {
                $profile->profile_photo_path = asset('storage/app/public/member_profile_picture').'/'.$profile->profile_photo_path;
            }

            $this->save_user_activity(14, $request->user_id, 'View', 'Viewed their own Member Profile from Mobile App');

            return response()->json(['data' => $profile], 200);
        }
        else
        {
            return response()->json(['data' => array()], 404);
        }
    }

    public function update_profile(request $request)
    {
        $_parts = json_decode($request->getContent());

        $array = $_parts->_parts;

        $imgs = array();
        $imgscount = 0;

        try {
            

            for($i = 0; $i < count($array); $i++)
            {
                if($array[$i][0] == 'fullName')
                {
                    $fullName = $array[$i][1];
                }
                elseif($array[$i][0] == 'phone')
                {
                    $phone = $array[$i][1];
                }
                elseif($array[$i][0] == 'city')
                {
                    $city = $array[$i][1];
                }
                elseif($array[$i][0] == 'country')
                {
                    $country = $array[$i][1];
                }
                elseif($array[$i][0] == 'user_id')
                {
                    $user_id = $array[$i][1];
                }
                elseif($array[$i][0] == 'petType')
                {
                    $petType = $array[$i][1];
                }

                if($array[$i][0] == 'prof_pic')
                {
                    foreach($array[$i][1] as $img)
                    {
                        if(is_object($img))
                        {
                            if(is_object($img->selectedImage))
                            {
                                $imgs[$imgscount] = $img->selectedImage;
                                $imgs[$imgscount]->base = $img->BaseURL;

                                $imgscount++;
                            }
                            
                        }

                    }
                }
            }

            $new = Users::find($user_id);

            if($new)
            {
                $new->name = $fullName;
                if(isset($email))
                {
                    $new->email = $email;
                }
                $new->phone = $phone;
                $new->city_id = $city;
                $new->country_id = $country;
                if(isset($petType))
                {
                    $new->pet_preference = $petType;
                }

                if(count($imgs) > 0)
                {
                    $allowedfileExtension=['png','jpeg','jpg','jfif','gif'];
                    $file = $request->file('prof_pic');

                    foreach($imgs as $file) // for images
                    {
                        $extension = pathinfo($file->name, PATHINFO_EXTENSION);
                        $fileName = time().'.'.$extension;
                        

                        if(in_array($extension,$allowedfileExtension))
                        {
                            file_put_contents(storage_path('app/public/member_profile_picture').'/'.$fileName, base64_decode($file->base) );
                            $new->profile_photo_path = $fileName;
                        }
                    }
                }
                
                if($new->update())
                {
                    $this->save_user_activity(14, $user_id, 'Update', 'Updated their own Member Profile from Mobile App');

                    return response()->json(['message' => 'Profile has been updated successfully!'], 200);
                }
                else
                {
                    $this->save_user_activity(14, $user_id, 'Update', 'Failed to update their own Member Profile from Mobile App');

                    return response()->json(['message' => 'Something went wrong! Please try again!'], 500);
                }
            }
            else
            {
                return response()->json(['message' => 'User not found!'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Something went wrong! Please try again'], 500);
        }
    }
}
