<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Thread;

class Forum extends Model
{
    protected $fillable = ['body'];
    // protected $fillable = ['body', 'thread_id', 'user_id'];

    public function getThreads(){
    	return $this->hasMany(Thread::class, 'forum_id', 'id');
    }

}
