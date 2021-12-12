<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'priorities_id',
        'parent_id',
        'start',
        'finish'
    ];

    public function ownedBy(User $user){
        return  $user->id === $this->user_id;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function priorities(){
        return $this->belongsTo(Priority::class);
    }

    public function parent(){
        return $this->belongsTo(Task::class,'parent_id','id');
    }
    public function childs(){
        return $this->hasMany(Task::class,'parent_id','id');
    }

    public function isChild(Task $task){
        return in_array($task->id,$this->childIds());
    }

    public function childIds(){
        $childIdsArr=[];
        $kids = $this->childs;
        if(!$kids->count()) return $childIdsArr;
        foreach ($kids as $kid) {
            $childIdsArr[] = $kid->id;
            $childIdsArr = array_merge($childIdsArr, $kid->childIds());
        }
        return $childIdsArr;
    }
}
