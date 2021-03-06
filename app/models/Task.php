<?php

class Task extends Phalcon\Mvc\Model
{
	public function validation()
    {
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    public function initialize()
    {
        $this->hasMany('id', 'TaskUser', 'task_id');
        $this->belongsTo('assigned_to', 'User', 'id');
        $this->hasMany('id', 'Comment', 'task_id');
        $this->belongsTo('project_id', 'Project', 'id');
    }

    public function isSubscribed($user)
    {
        $taskUser = TaskUser::findFirst('user_id="' . $user->id . '" AND task_id="' . $this->id . '"');

        if ($taskUser) {
            return true;
        }

        return false;
    }

    public function getHours() {
        $date = explode(":", $this->hours);

        return (int)$date[0];
    }
}
