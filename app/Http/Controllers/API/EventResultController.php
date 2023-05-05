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
                // ->join('breeds', 'dogs.breed_id', '=', 'breeds.id')
                ->join('clubs', 'events.club_id', '=', 'clubs.id')
                ->join('countries', 'events.country', '=', 'countries.idCountry')
                ->select('events.date',
                         'events.name AS event',
                        //  'breeds.name AS breedName',
                         'clubs.name AS club',
                         'countries.countryName AS country',
                         'countries.countryCode',
                         'events.id AS eventId')
                ->orderBy('events.start_date', 'desc')
                ->take(20)
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
                                          'event_results.class AS event_results',
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

    
}
