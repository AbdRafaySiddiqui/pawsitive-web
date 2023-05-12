<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Breeds;
use App\Models\Clubs;
use App\Models\Events;
use App\Models\Event_Result;
use App\Models\EventJudges;
use App\Models\Dogs;
use App\Models\Countries;
use Illuminate\Support\Facades\DB;

class EventResultController extends Controller
{

  public function judge(request $request)
  {
    if($request->has('id')){
      $id = $request->id;
      $data = EventJudges::select('event_judges.id','judges.id as jud_id','judges.full_name','event_judges.judge_id')
      ->leftjoin('judges','judges.id','=','event_judges.judge_id')

      ->where('event_judges.event_id', '=', $id)
      ->get();
      }
      else{
        $data = Dogs::select('dogs.id',
        'dog_name'
          )
          ->orderBy('dog_name','ASC')
                ->get();
    }
    return response()->json(["judge"=>$data]);
  }

    public function result()
    {
        $results = DB::table('event_results')
                ->join('dogs', 'event_results.dog_id', '=', 'dogs.id')
                ->join('events', 'event_results.event_id', '=', 'events.id')
                ->join('breeds', 'dogs.breed_id', '=', 'breeds.id')
                ->join('clubs', 'events.club_id', '=', 'clubs.id')
                ->join('countries', 'events.country', '=', 'countries.idCountry')
                ->select('events.start_date',
                         'events.name AS event',
                         'breeds.name AS breedName',
                         'clubs.name AS club',
                         'countries.countryName AS country',
                         'countries.countryCode',
                         'events.id AS eventId')
                ->where('events.status', '=', 'Active')
                ->orderBy('events.start_date', 'desc')
                ->distinct('events.id')
                ->get();
                return response()->json(['event_result' => $results]);
    }

    public function event_result($id)
    {
        $results = DB::table('event_results')
 
                ->leftjoin('events', 'events.id', '=', 'event_results.event_id')
                ->leftjoin('countries', 'countries.idCountry', '=', 'events.country')
                ->leftjoin('cities', 'cities.id', '=', 'events.city')
                ->leftjoin('clubs', 'clubs.id', '=', 'events.club_id')
                ->leftjoin('dogs', 'dogs.id', '=', 'event_results.dog_id')
                ->leftjoin('breeds', 'breeds.id', '=', 'dogs.breed_id')
                        // ->leftjoin('breeds', 'dogs.breed_id', '=', 'breeds.id')
                        ->select(
                          'breeds.name AS breedName',
                          'events.start_date',
                                'events.name AS event',
                                //  'breeds.name AS breedName',
                                'clubs.name AS club',
                                'countries.countryName AS country',
                                'cities.city',
                                'events.id AS eventId')
                        ->orderBy('events.start_date', 'asc')
                        ->where('event_results.event_id','=',$id)
                        ->first();

                          $awards= DB::table('event_results')


                        //    ->leftjoin('event_results','event_results.event_id','=','events.id')
                          ->leftjoin('dogs', 'dogs.id', '=', 'event_results.dog_id')
                          ->leftjoin('breeds', 'breeds.id', '=', 'dogs.breed_id')
                        //   ->leftjoin('award_system', 'award_system.id', '=', 'event_results.award_id')
                          ->leftjoin('award_system', function ($join) {
                            $join->on(DB::raw("FIND_IN_SET(award_system.id, event_results.award_id)"), ">", DB::raw("'0'"));
                          })
                          ->leftjoin('users', 'users.id', '=', 'dogs.dog_owner')
                          ->select(
                                    'breeds.name AS breedName',
                                    'dogs.dog_name AS dogName',
                                    'dogs.id AS dogId',
                                    'award_system.award_title AS awards' ,
                                    'users.name AS owner',
                                    'event_results.event_id AS eventId')
                                    ->where('event_results.event_id','=',$id)
                                    ->get();
                                    $bestInGroup=array();
                                    $bestInShow=array();
                          
                                    foreach($awards as $award) {
                                    if($award->awards == 'Best in Group')
                                    {
                                        // if($award->awards)
                                        
                                        // $best[$award->awards][]=array(
                                        $bestInGroup[]=array(
                                      'dogName'=>$award->dogName,
                                      'breed'=>$award->breedName,
                                      'awards'=>$award->awards,
                                      'owner'=>$award->owner,
                                      'dogId'=>$award->dogId
                                        );
                                    }
                                    if($award->awards == 'Best in Show')
                                    {
                                        // if($award->awards)
                                        
                                        // $best[$award->awards][]=array(
                                        $bestInShow[]=array(
                                      'dogName'=>$award->dogName,
                                      'breed'=>$award->breedName,
                                      'awards'=>$award->awards,
                                      'owner'=>$award->owner,
                                      'dogId'=>$award->dogId
                                        );
                                    }
                                }


                    $event_results= DB::table('event_results')


                              //    ->leftjoin('event_results','event_results.event_id','=','events.id')
                                ->leftjoin('dogs', 'dogs.id', '=', 'event_results.dog_id')
                                ->leftjoin('award_system', 'award_system.id', '=', 'event_results.award_id')
                                ->leftjoin('users', 'users.id', '=', 'dogs.dog_owner')
                                // ->leftjoin('dog_classes', 'dog_classes.id', '=', 'event_results.class')
                                ->select(
                                        //  'breeds.name AS breedName',
                                        'event_results.grading AS grading',
                                        'event_results.place AS place',
                                          'dogs.dog_name AS dogName',
                                          'award_system.award_title AS awards',
                                          'event_results.class',
                                          'dogs.id AS dogId',
                                          'event_results.gender AS gender'
                                          )
                                          ->where('event_results.event_id','=',$id)
                                          ->get();
                                        
                                          $dog_class=array();
                                          

                              foreach($event_results as $dog) {

                                  // if(!isset($dog_class[$dog->class])){
                                  //     $dog_class[$dog->class]=array('males'=>array(),
                                  //     'female'=>array());
                                    
                                  // }
                                  if($dog->class!= null){
                                    $dog->class= strtolower($dog->class);
                                    $dog->class=str_replace(' ', '',$dog->class);
                                    $dog->class=str_replace('class', '',$dog->class);
                                  }
                              
                                          if($dog->gender=='Male'){
                                              $dog_class[$dog->class]['male'][]=array(
                                              'grading' =>$dog->grading,
                                              'place' =>$dog->place,
                                              'grading' =>$dog->grading,
                                              'dogName' =>$dog->dogName,
                                              'awards' =>$dog->awards,
                                              'class' =>$dog->class,
                                              'dogId' =>$dog->dogId
                                                  )
                                              ;
                                          }  
                                          elseif($dog->gender=='Female'){
                                              $dog_class[$dog->class]['female'][]=
                                              
                                              array(
                                                  'grading' =>$dog->grading,
                                                  'place' =>$dog->place,
                                                  'grading' =>$dog->grading,
                                                  'dogName' =>$dog->dogName,
                                                  'awards' =>$dog->awards,
                                                  'class' =>$dog->class,
                                                  'dogId' =>$dog->dogId
                                                      )
                                                  ;
                                          }
                                    }
                                  //  $classData=array(
                                  //     'male'=>$males,
                                  //     'female'=>$female
                                  //  );
                                  

                                  return response()->json(['details' => $results,'bestInGroup'=> $bestInGroup,'bestInShow'=> $bestInShow,'classData' => $dog_class]);
    }
    public function edit_event_result(Request $request)
    {
        $dog_id = $request->input('dog_id');
        $grading = $request->input('grading');
        $place = $request->input('place');
        $judge = $request->input('judge');
        $award_id = $request->input('awards');
        $event_id = $request->input('event_id');
        $breed_id = $request->input('breed_id');
        $class = $request->input('class');
    
        foreach ($dog_id as $key => $value) {
     $event_result = new Event_Result;
            $event_result->dog_id = $value;
            
            $gender = Dogs::select('dogs.gender As gender')
          ->where('dogs.id','=',$value)
          ->first();
          
            $event_result->grading = $grading[$key];
            $event_result->place = $place[$key];
               $judge_one = EventJudges::select('event_id','judge_id')
                ->where('event_id','=',$event_id)
                ->get();
                if(count($judge_one) ==1){
            $event_result->judge = $judge_one[0]->judge_id;
    
            }else{
            $event_result->judge = $judge[$key];
    
            }
            if($gender->gender== null){
                 $event_result->gender = 'Male';
            }else{
                $event_result->gender = $gender->gender;
            }
            $event_result->award_id = $award_id[$key];
            
            $event_result->event_id = $event_id;
            $event_result->breed_id = $breed_id;
            $event_result->class = $class;
            $event_result->save();
        }
    
        return response()->json([
          'success' => true,
          'message' => 'Form submitted successfully',
          'response' =>   $event_result
      ]);
    }

    public function class_dog(request $request)
    {

      $class_name = $request->input('class');
      $class = Event_Result::select(
        'breeds.name as breed_name',
        'dogs.dog_name as dog_name',
        'events.name as event_name',
        'event_results.grading',
        'event_results.place',
        'event_results.award_id',
        'event_results.id',
        'judges.full_name as judge_name'
      )
      ->join('breeds', 'breeds.id', '=', 'event_results.breed_id')
      ->join('dogs', 'dogs.id', '=', 'event_results.dog_id')
      ->join('events', 'events.id', '=', 'event_results.event_id')
      ->join('judges', 'judges.id', '=', 'event_results.judge')
      ->where('class', $class_name)
      ->get();


      return response()->json(['class' => $class]);
    }

    
}


