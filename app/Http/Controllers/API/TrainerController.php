<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TrainerInformation;
use App\Models\TrainerImgVids;
use App\Models\TrainerReviews;
use App\Models\Users;

use App\Traits\Activity;

use DB;

class TrainerController extends Controller
{
    use Activity;
    
    public function listing(request $request)
    {
        $data = TrainerInformation::select('users.id',
                              'users.name',
                              'users.phone',
                              'users.email',
                              DB::raw('CONCAT(cities.city," ",countries.countryName) as location'),
                              'users.profile_photo_path')
                      ->leftjoin('users','users.id','trainer_information.user_id')
                      ->leftjoin('cities','cities.id','users.city_id')
                      ->leftjoin('countries','countries.idCountry','users.country_id')
                      ->where('trainer_information.status','=','Active')
                      ->where('users.status','=','Active')
                      ->get();

        foreach($data as $d)
        {
            if(is_null($d->profile_photo_path))
            {
                $d->profile_photo_path = asset('storage/app/public/noimage.png');
            }
            else
            {
                $d->profile_photo_path = asset('storage/app/public/member_profile_picture').'/'.$d->profile_photo_path;
            }

            unset($d->profile_photo_url);

            $reviews = TrainerReviews::where('trainer_id',$d->id)->get();

            $rating = 0;

            if(count($reviews) > 0)
            {
                foreach($reviews as $rev)
                {
                    $rating += $rev->rating;
                }

                $rating = number_format($rating / count($reviews), 1);
            }

            $d['rating'] = $rating;
        }

        $this->save_user_activity(11, $request->user_id, 'View', 'Viewed Trainers List from Mobile App');

        return response()->json(['trainers' => $data], 200);
    }

    public function details(request $request, $id)
    {
        $trainer = Users::select('users.id',
                                 'users.name',
                                 'users.phone',
                                 'address',
                                 DB::raw('CONCAT(cities.city," ",countries.countryName) as location'),
                                 'users.profile_photo_path',
                                 'description',
                                 'expertise',
                                 'website')
                        ->leftjoin('cities','cities.id','users.city_id')
                        ->leftjoin('countries','countries.idCountry','users.country_id')
                        ->leftjoin('trainer_information','trainer_information.user_id','users.id')
                        ->find($id);

        if($trainer)
        {

            $media = TrainerImgVids::select('media','type')->where('trainer_id',$id)->get();
            $reviews = TrainerReviews::select('users.name',
                                            'users.profile_photo_path',
                                            'trainer_reviews.rating',
                                            'trainer_reviews.review')
                                    ->leftjoin('users','users.id','=','trainer_reviews.user_id')
                                        ->where('trainer_reviews.trainer_id',$id)
                                        ->get();

            foreach($media as $m)
            {
                if($m->type == 'video')
                {
                    $m->media = asset('storage/app/public/trainer_vids').'/'.$m->media;
                }
                else
                {
                    $m->media = asset('storage/app/public/trainer_imgs').'/'.$m->media;
                }
            }

            $rating = 0;

            if(count($reviews) > 0)
            {
                foreach($reviews as $rev)
                {
                    $rating += $rev->rating;

                    if(is_null($rev->profile_photo_path))
                    {
                        $rev->profile_photo_path = asset('storage/app/public/noimage.png');
                    }
                    else
                    {
                        $rev->profile_photo_path = asset('storage/app/public/member_profile_picture').'/'.$rev->profile_photo_path;
                    }

                    if($rev->review == "")
                    {
                        $rev->name = 'Anonymous';
                    }
                }

                $rating = number_format($rating / count($reviews), 1);
            }

            $trainer['rating'] = $rating;

            
            if(is_null($trainer->profile_photo_path))
            {
                $trainer->profile_photo_path = asset('storage/app/public/noimage.png');
            }
            else
            {
                $trainer->profile_photo_path = asset('storage/app/public/member_profile_picture').'/'.$trainer->profile_photo_path;
            }

            $this->save_user_activity(11, $request->user_id, 'View', 'Viewed Trainer Profile of '.$trainer->name.' from Mobile App');

            return response()->json(['trainer' => $trainer, 'pics_vids' => $media, 'reviews' => $reviews], 200);

        }
        else
        {
            return response()->json(['trainer' => array(), 'pics_vids' => array(), 'reviews' => array()], 404);
        }
    }

    public function rate_trainer(request $request)
    {
        $array = json_decode($request->getContent());

        $trainer = Users::find($request->trainer_id);

        $new = new TrainerReviews;
        $new->trainer_id = $array->trainer_id;
        $new->user_id = $array->user_id;
        $new->rating = $array->rating;
        $new->review = $array->review;
        
        if($new->save())
        {
            $this->save_user_activity(11, $array->user_id, 'Gave Rating', 'Rated Trainer Profile of '.$trainer->name.' from Mobile App');

            return response()->json(['message' => 'Review has been submitted!'], 200);
        }
        else
        {
            return response()->json(['message' => 'ERROR! Something went wrong, please try again!'], 500);
        }
    }

    public function my_trainer_profile(request $request)
    {
        $trainer = Users::select('users.id',
                                 'users.name',
                                 'users.phone',
                                 'address',
                                 DB::raw('CONCAT(cities.city," ",countries.countryName) as location'),
                                 'users.profile_photo_path',
                                 'description',
                                 'expertise',
                                 'website')
                        ->leftjoin('cities','cities.id','users.city_id')
                        ->leftjoin('countries','countries.idCountry','users.country_id')
                        ->leftjoin('trainer_information','trainer_information.user_id','users.id')
                        ->find($request->trainer_id);

        if($trainer)
        {

            $media = TrainerImgVids::select('media','type')->where('trainer_id',$request->trainer_id)->get();
            $reviews = TrainerReviews::select('users.name',
                                            'users.profile_photo_path',
                                            'trainer_reviews.rating',
                                            'trainer_reviews.review')
                                    ->leftjoin('users','users.id','=','trainer_reviews.user_id')
                                        ->where('trainer_reviews.trainer_id',$request->trainer_id)
                                        ->get();

            foreach($media as $m)
            {
                if($m->type == 'video')
                {
                    $m->media = asset('storage/app/public/trainer_vids').'/'.$m->media;
                }
                else
                {
                    $m->media = asset('storage/app/public/trainer_imgs').'/'.$m->media;
                }
            }

            $rating = 0;

            if(count($reviews) > 0)
            {
                foreach($reviews as $rev)
                {
                    $rating += $rev->rating;

                    if(is_null($rev->profile_photo_path))
                    {
                        $rev->profile_photo_path = asset('storage/app/public/noimage.png');
                    }
                    else
                    {
                        $rev->profile_photo_path = asset('storage/app/public/member_profile_picture').'/'.$rev->profile_photo_path;
                    }

                    if($rev->review == "")
                    {
                        $rev->name = 'Anonymous';
                    }
                }

                $rating = number_format($rating / count($reviews), 1);
            }

            $trainer['rating'] = $rating;

            
            if(is_null($trainer->profile_photo_path))
            {
                $trainer->profile_photo_path = asset('storage/app/public/noimage.png');
            }
            else
            {
                $trainer->profile_photo_path = asset('storage/app/public/member_profile_picture').'/'.$trainer->profile_photo_path;
            }

            $this->save_user_activity(11, $request->user_id, 'View', 'Viewed Trainer Profile of '.$trainer->name.' from Mobile App');

            return response()->json(['trainer' => $trainer, 'pics_vids' => $media, 'reviews' => $reviews], 200);

        }
        else
        {
            return response()->json(['trainer' => array(), 'pics_vids' => array(), 'reviews' => array()], 404);
        }
    }

    public function update_trainer_profile(request $request)
    {
        $array = json_decode($request->getContent());

        $info = TrainerInformation::where('user_id', '=', $array->trainer_id)
                                 ->update(
                                            array(
                                                    'description' => $array->description,
                                                    'address' => $array->address,
                                                    'website' => $array->website,
                                                    'expertise' => $array->expertise
                                                )
                                        );

        if($info)
        {
            $this->save_user_activity(11, $array->trainer_id, 'Update Profile', 'Updated their own Trainer Profile from Mobile App');

            return response()->json(['message' => 'Trainer Profile has been updated!'], 200);
        }
        else
        {
            return response()->json(['message' => 'Something went wrong, please try again'], 500);
        }
    }

    public function add_trainer_images(request $request)
    {
        if($request->hasFile('images'))
        {
            $allowedfileExtension=['png','jpeg','jpg','jfif','gif'];
            $file = $request->file('images');

            $fileName = $file->getClientOriginalName().'.'.time();
            $extension = $file->getClientOriginalExtension();

            $imgerror = 0;
            $imgs = 0;
            
            if(in_array($extension,$allowedfileExtension))
            {
                $file->move(storage_path('app/public/trainer_imgs'), $fileName);
                $trnvid = new TrainerImgVids;
                $trnvid->trainer_id = $request->trainer_id;
                $trnvid->media = $fileName;
                $trnvid->type = 'image';
                $trnvid->save();

                $imgs++;
            }
            else
            {
                $imgs++;
                $imgerror++;
            }

            if($imgerror == $imgs)
            {
                return response()->json(['message' => 'No image uploaded as it was not in either png, jpeg, jpg, jfif, or gif format!'], 500);
            }
            elseif($imgerror < $imgs && $imgerror > 0)
            {
                $this->save_user_activity(11, $request->trainer_id, 'Add Images', 'Added images to their own Trainer Profile from Mobile App');

                return response()->json(['message' => 'Some images were not uploaded as they were not in either png, jpeg, jpg, jfif, or gif format!'], 200);
            }
            elseif($imgerror < $imgs && $imgerror == 0)
            {
                $this->save_user_activity(11, $request->trainer_id, 'Add Images', 'Added images to their own Trainer Profile from Mobile App');

                return response()->json(['message' => 'Image(s) have been uploaded successfully!'], 200);
            }
        }
        else
        {
            return response()->json(['message' => 'Please upload atleast 1 image'], 500);
        }
    }

    public function delete_trainer_images(request $request)
    {
        $image = TrainerImgVids::find($request->image_id);

        if($image)
        {
            if($image->trainer_id == $request->trainer_id)
            {
                if(unlink(storage_path('app/public/trainer_imgs/'.$image->media)))
                {
                    if($image->delete())
                    {
                        $this->save_user_activity(11, $request->trainer_id, 'Deleted Image', 'Deleted an image from their own Trainer Profile from Mobile App');

                        return response()->json(['message' => 'Image has been deleted'], 200);
                    }
                    else
                    {
                        return response()->json(['message' => 'Something went wrong! Please try again'], 500);
                    }
                }
                else
                {
                    return response()->json(['message' => 'Something went wrong! Please try again'], 500);
                }
            }
            else
            {
                return response()->json(['message' => 'This image belongs to another Trainer!'], 500);
            }
        }
        else
        {
            return response()->json(['message' => 'Could not find the image'], 404);
        }
    }

    public function add_trainer_videos(request $request)
    {
        if($request->hasFile('videos'))
        {
            $allowedfileExtension=['mp4','mpeg'];
            $file = $request->file('videos');

            $fileName = $file->getClientOriginalName().'.'.time();
            $extension = $file->getClientOriginalExtension();

            $vids = 0;
            $viderror = 0;
            
            if(in_array($extension,$allowedfileExtension))
            {
                $file->move(storage_path('app/public/trainer_vids'), $fileName);
                $trnvid = new TrainerImgVids;
                $trnvid->trainer_id = $request->trainer_id;
                $trnvid->media = $fileName;
                $trnvid->type = 'video';
                $trnvid->save();
                
                $vids++;
            }
            else
            {
                $vids++;
                $viderror++;
            }

            if($viderror == $vids)
            {
                return response()->json(['message' => 'No video uploaded as it was not in either mp4 or mpeg format!'], 500);
            }
            elseif($viderror < $vids && $viderror > 0)
            {
                $this->save_user_activity(11, $request->trainer_id, 'Add Videos', 'Added videos to their own Trainer Profile from Mobile App');

                return response()->json(['message' => 'Some videos were not uploaded as they were not in either mp4 or mpeg format!'], 200);
            }
            elseif($viderror < $vids && $viderror == 0)
            {
                $this->save_user_activity(11, $request->trainer_id, 'Add Videos', 'Added videos to their own Trainer Profile from Mobile App');

                return response()->json(['message' => 'Video(s) have been uploaded successfully!'], 200);
            }
        }
    }

    public function delete_trainer_videos(request $request)
    {
        $video = TrainerImgVids::find($request->video_id);

        if($video)
        {
            if($video->trainer_id == $request->trainer_id)
            {
                if(unlink(storage_path('app/public/trainer_vids/'.$video->media)))
                {
                    if($video->delete())
                    {
                        $this->save_user_activity(11, $request->trainer_id, 'Deleted Video', 'Deleted a video from their own Trainer Profile from Mobile App');

                        return response()->json(['message' => 'Video has been deleted'], 200);
                    }
                    else
                    {
                        return response()->json(['message' => 'Something went wrong! Please try again'], 500);
                    }
                }
                else
                {
                    return response()->json(['message' => 'Something went wrong! Please try again'], 500);
                }
            }
            else
            {
                return response()->json(['message' => 'This video belongs to another Trainer!'], 500);
            }
        }
        else
        {
            return response()->json(['message' => 'Could not find the video'], 404);
        }
    }
}
