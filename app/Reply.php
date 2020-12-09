<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Thread;
use App\User;

class Reply extends Model
{
    // use HasFactory;

    // Borde vara hasOne - om man vill kunna gå från Reply till Thread
    // Måste lägga till forein key i thread isåfall    
    // public function getThread(){
    // 	return $this->belongsTo(Thread::class);
    // }

    // Borde vara hasOne - om man vill kunna gå från Reply till User
    // Måste lägga till forein key i user isåfall
    // public function getUser(){
    // 	return $this->belongsTo(User::class);
    // }

}
