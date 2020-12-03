<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Thread;
use App\Models\Reply;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    public function getThreads(){
        return $this->hasMany(Thread::class, 'user_id', 'id');
    }

    public function getReplies(){
        return $this->hasMany(Reply::class, 'user_id', 'id');
    }
}
