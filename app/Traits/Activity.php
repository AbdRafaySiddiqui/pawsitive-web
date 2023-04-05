<?php

namespace App\Traits;

use Illuminate\Http\Request;

use App\Models\ActivityLog;

use App\Traits\Misc;

trait Activity
{
    use Misc;

    public function view_all_activity()
    {
        $activities = ActivityLog::select('activity_log.id',
                                          'users.name',
                                          'modules.module_title',
                                          'activity_log.action_type',
                                          'activity_log.remarks',
                                          'activity_log.created_at')
                                 ->leftjoin('modules','modules.id','=','activity_log.module_id')
                                 ->leftjoin('users','users.id','=','activity_log.user_id')
                                 ->orderby('activity_log.created_at','DESC')
                                 ->get();

        for($i = 0; $i < count($activities); $i++)
        {
            $activities[$i]['action_time'] = $this->get_time_ago(strtotime($activities[$i]['created_at']));
        }

        return $activities;
    }

    public function view_limit_user_activity($user_id)
    {
        $activities = ActivityLog::select('activity_log.id',
                                          'users.name',
                                          'modules.module_title',
                                          'activity_log.action_type',
                                          'activity_log.remarks',
                                          'activity_log.created_at')
                                 ->leftjoin('modules','modules.id','=','activity_log.module_id')
                                 ->leftjoin('users','users.id','=','activity_log.user_id')
                                 ->where('activity_log.user_id','=',$user_id)
                                 ->orderby('activity_log.created_at','DESC')
                                 ->get();

        for($i = 0; $i < count($activities); $i++)
        {
            $activities[$i]['action_time'] = $this->get_time_ago(strtotime($activities[$i]['created_at']));
        }

        return $activities;
    }

    public function view_all_user_activity($user_id)
    {
        $activities = ActivityLog::select('activity_log.id',
                                          'users.name',
                                          'modules.module_title',
                                          'activity_log.action_type',
                                          'activity_log.remarks',
                                          'activity_log.created_at')
                                 ->leftjoin('modules','modules.id','=','activity_log.module_id')
                                 ->leftjoin('users','users.id','=','activity_log.user_id')
                                 ->where('activity_log.user_id','=',$user_id)
                                 ->orderby('activity_log.created_at','DESC')
                                 ->get();

        for($i = 0; $i < count($activities); $i++)
        {
            $activities[$i]['action_time'] = $this->get_time_ago(strtotime($activities[$i]['created_at']));
        }

        return $activities;
    }

    public function save_user_activity($module_id, $user_id, $action, $remarks)
    {
        $insert = new ActivityLog;
        $insert->module_id = $module_id;
        $insert->user_id = $user_id;
        $insert->action_type = $action;
        $insert->remarks = $remarks;
        $insert->save();
    }
}