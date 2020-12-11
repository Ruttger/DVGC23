<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Forum;
use App\Reply;
use App\User;

class Thread extends Model
{
    // use HasFactory;
    protected $fillable = ['title', 'body', 'forum_id', 'user_id'];

    // Borde vara hasOne - om man vill kunna gå från thread till forum
    // Måste lägga till forein key i forum isåfall
    // public function getForum(){
    // 	return $this->belongsTo(Forum::class);
    // }

    // Borde vara hasOne - om man vill kunna gå från thread till user
    // Måste lägga till forein key i user isåfall
    // public function getUser(){
    // 	return $this->belongsTo(User::class);
    // }

    public function getReplies(){
    	return $this->hasMany(Reply::class, 'thread_id', 'id');
    }

    // hasOne relation till reply för senaste svaret
    // kan använda replies och sortera på tid och sen ta första?
}
