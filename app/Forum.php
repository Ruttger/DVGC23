<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Thread;

class Forum extends Model
{
    // use HasFactory;

    // Borde vara hasOne - om man vill kunna gå från forum till category
    // Måste lägga till forein key i category isåfall
    // public function getCategory(){
    // 	return $this->belongsTo(Category::class);
    // }

    public function getThreads(){
    	return $this->hasMany(Thread::class, 'forum_id', 'id');
    }

    // hasOne relation till thread för senaste svaret
    // kan använda threads och sortera på tid och sen ta första?
}
