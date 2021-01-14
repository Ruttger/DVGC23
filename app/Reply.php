<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Thread;
use App\User;

class Reply extends Model
{

    protected $fillable = ['body'];
    // protected $fillable = ['body', 'thread_id', 'user_id'];

}
