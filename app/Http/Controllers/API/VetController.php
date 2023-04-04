<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\VetInformation;
use App\Models\VetReviews;
use App\Models\VetAppointments;
use App\Models\Users;
use App\Models\Pets;
use App\Models\Species;
use App\Models\Breeds;

use App\Traits\Activity;

use DB;

class VetController extends Controller
{
    use Activity;

    public function my_vet_profile(request $request)
    {
        $vet = Users::select('users.id',
                                 'users.name',
                                 'users.phone',
                                 'address',
                                 DB::raw('CONCAT(cities.city," ",countries.countryName) as location'),
                                 'users.profile_photo_path',
                                 'description',
                                 'sp_ids',
                                 'specialties',
                                 'degree')
                        ->leftjoin('cities','cities.id','users.city_id')
                        ->leftjoin('countries','countries.idCountry','users.country_id')
                        ->leftjoin('vet_information','trainer_information.vet_id','users.id')
                        ->find($request->vet_id);

        if($vet)
        {
            $reviews = VetReviews::select('users.name',
                                            'users.profile_photo_path',
                                            'vet_reviews.rating',
                                            'vet_reviews.review')
                                    ->leftjoin('users','users.id','=','vet_reviews.user_id')
                                        ->where('vet_reviews.vet_id',$request->vet_id)
                                        ->get();

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

            $vet['rating'] = $rating;

            if(is_null($vet->profile_photo_path))
            {
                $vet->profile_photo_path = asset('storage/app/public/noimage.png');
            }
            else
            {
                $vet->profile_photo_path = asset('storage/app/public/member_profile_picture').'/'.$vet->profile_photo_path;
            }

            $this->save_user_activity(16, $request->user_id, 'View Profile', 'Viewed their own Vet Profile from Mobile App');

            return response()->json(['vet' => $vet, 'reviews' => $reviews], 200);

        }
        else
        {
            return response()->json(['vet' => array(), 'reviews' => array()], 404);
        }
    }

    public function update_vet_profile(request $request)
    {
        $array = json_decode($request->getContent());

        $update = VetInformation::where('vet_id','=',$array->vet_id)
                               ->update(
                                        array(
                                                'description' => $array->description,
                                                'sp_ids' => $array->sp_ids,
                                                'address' => $array->address,
                                                'specialties' => $array->specialties
                                            )
                                        );
        if($update)
        {
            $this->save_user_activity(16, $array->vet_id, 'Update Profile', 'Updated their own Vet Profile from Mobile App');

            return response()->json(['message' => 'Vet Profile has been updated!'], 200);
        }
        else
        {
            return response()->json(['message' => 'Something went wrong, please try again'], 500);
        }
    }
    
    public function listing(request $request)
    {
        $data = VetInformation::select('users.id',
                                       'users.name',
                                       'users.phone',
                                       'users.email',
                                       DB::raw('CONCAT(cities.city," ",countries.countryName) as location'),
                                       'users.profile_photo_path')
                            ->leftjoin('users','users.id','vet_information.vet_id')
                            ->leftjoin('cities','cities.id','users.city_id')
                            ->leftjoin('countries','countries.idCountry','users.country_id')
                            ->where('vet_information.status','=','Active')
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
        $vet = Users::select('users.id',
                                 'users.name',
                                 'users.phone',
                                 'address',
                                 DB::raw('CONCAT(cities.city," ",countries.countryName) as location'),
                                 'users.profile_photo_path',
                                 'description',
                                 'sp_ids',
                                 'specialties',
                                 'degree')
                        ->leftjoin('cities','cities.id','users.city_id')
                        ->leftjoin('countries','countries.idCountry','users.country_id')
                        ->leftjoin('vet_information','trainer_information.vet_id','users.id')
                        ->find($id);

        if($vet)
        {
            $reviews = VetReviews::select('users.name',
                                            'users.profile_photo_path',
                                            'vet_reviews.rating',
                                            'vet_reviews.review')
                                    ->leftjoin('users','users.id','=','vet_reviews.user_id')
                                        ->where('vet_reviews.vet_id',$id)
                                        ->get();

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

            $vet['rating'] = $rating;

            if(is_null($vet->profile_photo_path))
            {
                $vet->profile_photo_path = asset('storage/app/public/noimage.png');
            }
            else
            {
                $vet->profile_photo_path = asset('storage/app/public/member_profile_picture').'/'.$vet->profile_photo_path;
            }

            $this->save_user_activity(16, $request->user_id, 'View', 'Viewed Vet Profile of '.$vet->name.' from Mobile App');

            return response()->json(['vet' => $vet, 'reviews' => $reviews], 200);

        }
        else
        {
            return response()->json(['vet' => array(), 'reviews' => array()], 404);
        }
    }

    public function rate_vet(request $request)
    {
        $array = json_decode($request->getContent());

        $vet = Users::find($request->vet_id);

        $new = new VetReviews;
        $new->vet_id = $array->vet_id;
        $new->user_id = $array->user_id;
        $new->rating = $array->rating;
        $new->review = $array->review;
        
        if($new->save())
        {
            $this->save_user_activity(16, $array->user_id, 'Gave Rating', 'Rated Vet Profile of '.$vet->name.' from Mobile App');

            return response()->json(['message' => 'Review has been submitted!'], 200);
        }
        else
        {
            return response()->json(['message' => 'ERROR! Something went wrong, please try again!'], 500);
        }
    }

    public function all_appointments(request $request)
    {
        $all = VetAppointments::select('vet_appointments.id as appointment_id',
                                       'users.profile_photo_path',
                                       'species.name as species',
                                       'users.name as member_name',
                                       DB::raw("DATE_FORMAT(vet_appointments.created_at, ' %d %b, %Y (%h:%i %A)') as request_sent_on"),
                                       'vet_appointments.status as appointment_status')
                              ->leftjoin('users','users.id','=','vet_appointments.user_id')
                              ->leftjoin('pets','pets.id','=','vet_appointments.pet_id')
                              ->leftjoin('breeds','breeds.id','=','pets.breed_id')
                              ->leftjoin('species','species.id','=','breeds.sp_id')
                                 ->where('vet_appointments.vet_id','=',$request->vet_id)
                                 ->get();

        foreach($all as $a)
        {
            if(is_null($a->profile_photo_path))
            {
                $a->profile_photo_path = asset('storage/app/public/noimage.png');
            }
            else
            {
                $a->profile_photo_path = asset('storage/app/public/member_profile_picture').'/'.$a->profile_photo_path;
            }
        }

        $this->save_user_activity(16, $request->vet_id, 'View Appointments', 'Viewed their own list of Appointments from Mobile App');

        return response()->json(['appointments' => $all], 200);
    }

    public function view_appointment_normal(request $request, $id)
    {
        $appointment = VetAppointments::find($id);

        $result = array();

        if($appointment)
        {
            if($appointment->vet_id == $request->vet_id)
            {
                $pet = Pets::find($appointment->pet_id);
                $member = Users::find($appointment->user_id);

                $result['member_name'] = $member->name;
                $result['request_sent_on'] = date("d F, Y (h:i A)", strtotime($appointment->name));
                $result['pet_name'] = $pet->name;
                $result['breed'] = $pet->breed->name;
                $result['species'] = $pet->breed->species->name;
                $result['dob'] = $pet->dob;
                $result['microchip'] = $pet->microchip->microchip  ?? 'No Information';
                $result['reg_number'] = $pet->reg_number;
                $result['height'] = $pet->height.' CM';
                $result['weight'] = $pet->weight.' KG';
                $result['sire_name'] = $pet->sire->name ?? 'No Information';
                $result['dam_name'] = $pet->dam->name ?? 'No Information';
                $result['appointment_status'] = $appointment->status;
                $result['appointment_id'] = $appointment->id;
                $result['reason_to_cancel'] = $appointment->reason_to_cancel;

                if(is_null($member->profile_photo_path))
                {
                    $result['profile_photo_path'] = asset('storage/app/public/noimage.png');
                }
                else
                {
                    $result['profile_photo_path'] = asset('storage/app/public/member_profile_picture').'/'.$a->profile_photo_path;
                }

                $this->save_user_activity(16, $request->vet_id, 'Viewed Appointment', 'Viewed an Appointment with Member ('.$member->name.') for Pet('.$pet->name.') from Mobile App');

                return response()->json(['appointment' => $result], 200);

            }
            else
            {
                return response()->json(['message' => 'This Appointment belongs to another vet'], 500);
            }
        }
        else
        {
            return response()->json(['message' => 'Counld not find the Appointment you were looking for'], 404);
        }
    }

    public function view_appointment_with_history(request $request, $id)
    {
        $appointment = VetAppointments::find($id);

        $result = array();

        if($appointment)
        {
            if($appointment->vet_id == $request->vet_id)
            {
                $prev_treatments = VetAppointments::select('appointent_time','diagnosis','prescription')
                                                  ->where('pet_id','=',$appointment->pet_id)
                                                  ->where('user_id','=',$appointment->user_id)
                                                  ->where('vet_id','=',$appointment->vet_id)
                                                  ->where('status','=','Completed')
                                                  ->where('id','!=',$id)
                                                  ->get();

                foreach($prev_treatments as $pt)
                {
                    $pt->appointment_time = date('d F, Y',strtotime($pt->appointment_time));
                }

                $pet = Pets::find($appointment->pet_id);
                $member = Users::find($appointment->user_id);

                $result['member_name'] = $member->name;
                $result['request_sent_on'] = date("d F, Y (h:i A)", strtotime($appointment->name));
                $result['pet_name'] = $pet->name;
                $result['breed'] = $pet->breed->name;
                $result['species'] = $pet->breed->species->name;
                $result['dob'] = $pet->dob;
                $result['microchip'] = $pet->microchip->microchip  ?? 'No Information';
                $result['reg_number'] = $pet->reg_number;
                $result['height'] = $pet->height.' CM';
                $result['weight'] = $pet->weight.' KG';
                $result['sire_name'] = $pet->sire->name ?? 'No Information';
                $result['dam_name'] = $pet->dam->name ?? 'No Information';
                $result['appointment_status'] = $appointment->status;
                $result['appointment_id'] = $appointment->id;
                $result['previous_treatments'] = $prev_treatments;

                if(is_null($member->profile_photo_path))
                {
                    $result['profile_photo_path'] = asset('storage/app/public/noimage.png');
                }
                else
                {
                    $result['profile_photo_path'] = asset('storage/app/public/member_profile_picture').'/'.$a->profile_photo_path;
                }

                $this->save_user_activity(16, $request->vet_id, 'Viewed Appointment', 'Viewed an Appointment with Member ('.$member->name.') for Pet('.$pet->name.') from Mobile App');

                return response()->json(['appointment' => $result], 200);

            }
            else
            {
                return response()->json(['message' => 'This Appointment belongs to another vet'], 500);
            }
        }
        else
        {
            return response()->json(['message' => 'Counld not find the Appointment you were looking for'], 404);
        }
    }

    public function send_appointment_request(request $request)
    {
        $array = json_decode($request->getContent());

        $vet = Users::find($array->vet_id);

        $new = new VetAppointments;
        $new->vet_id = $array->vet_id;
        $new->user_id = $array->user_id;
        $new->pet_id = $array->pet_id;
        
        if($new->save())
        {
            $this->save_user_activity(16, $array->user_id, 'Requested Appointment', 'Sent Appointment Request to Vet ('.$vet->name.') from Mobile App');

            return response()->json(['message' => 'Request has been submitted!'], 200);
        }
        else
        {
            return response()->json(['message' => 'ERROR! Something went wrong, please try again!'], 500);
        }
    }

    public function confirm_appointment_request(request $request)
    {
        $array = json_decode($request->getContent());

        $vet = Users::find($array->vet_id);

        $new = VetAppointments::find($array->appointment_id);
        if($new)
        {
            $pet = Pets::find($new->pet_id);
            $member = Users::find($new->user_id);

            $new->appointment_time = $array->appointment_time;
            $new->status = 'Appointed';

            if($new->update())
            {
                $this->save_user_activity(16, $array->vet_id, 'Confirmed Appointment', 'Confirmed Appointment with Member ('.$member->name.') for Pet ('.$pet->name.') from Mobile App');

                return response()->json(['message' => 'Appointment has been confirmed!'], 200);
            }
            else
            {
                return response()->json(['message' => 'ERROR! Something went wrong, please try again!'], 500);
            }
        }
        else
        {
            return response()->json(['message' => 'Could not find appointment'], 404);
        }
    }

    public function complete_appointment_request(request $request)
    {
        $array = json_decode($request->getContent());

        $vet = Users::find($array->vet_id);

        $new = VetAppointments::find($array->appointment_id);
        if($new)
        {
            $pet = Pets::find($new->pet_id);
            $member = Users::find($new->user_id);

            $new->prescription = $array->prescription;
            $new->diagnosis = $array->diagnosis;
            $new->status = 'Completed';

            if($new->update())
            {
                $this->save_user_activity(16, $array->vet_id, 'Completed Appointment', 'Completed Appointment with Member ('.$member->name.') for Pet ('.$pet->name.') from Mobile App');

                return response()->json(['message' => 'Appointment has been completed!'], 200);
            }
            else
            {
                return response()->json(['message' => 'ERROR! Something went wrong, please try again!'], 500);
            }
        }
        else
        {
            return response()->json(['message' => 'Could not find appointment'], 404);
        }
    }

    public function cancel_appointment_request(request $request)
    {
        $array = json_decode($request->getContent());

        $vet = Users::find($array->vet_id);

        $new = VetAppointments::find($array->appointment_id);
        if($new)
        {
            $pet = Pets::find($new->pet_id);
            $member = Users::find($new->user_id);

            $new->reason_to_cancel = $array->reason_to_cancel;
            $new->status = 'Cancelled';

            if($new->update())
            {
                $this->save_user_activity(16, $array->vet_id, 'Cancelled Appointment', 'Cancelled Appointment with Member ('.$member->name.') for Pet ('.$pet->name.') from Mobile App');

                return response()->json(['message' => 'Appointment has been cancelled!'], 200);
            }
            else
            {
                return response()->json(['message' => 'ERROR! Something went wrong, please try again!'], 500);
            }
        }
        else
        {
            return response()->json(['message' => 'Could not find appointment'], 404);
        }
    }
    
}
