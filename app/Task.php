<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Type;

class Task extends Model
{
    public $timestamps = false; // allows to delete timestamps from migration table
    protected $fillable = ['type_id', 'crew_id', 'room', 'amount', 'start', 'finish'];

    public function crew()
    {

        return $this->belongsTo(Crew::class);

    }

    public function type()
    {

        return $this->hasOne(Type::class);

    }

    public static function ongoingTaskCount()
    {

        if(auth()->check()) {
            $tasks = auth()->user()->tasks;
            $count = $tasks->filter(function ($task) {
                return $task->completed == 0;
            })->count();
            return $count;
        }

    }


}
