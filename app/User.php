<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Thread;
use App\Reply;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rights',
    ];

    public function getThreads(){
        return $this->hasMany(Thread::class, 'user_id', 'id');
    }

    public function getReplies(){
        return $this->hasMany(Reply::class, 'user_id', 'id');
    }
}
