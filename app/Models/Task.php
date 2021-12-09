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
        'priority_id',
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

    public function childs() {
        return $this->hasMany('App\Task','parent_id','id') ;
    }
}
