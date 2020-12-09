<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Forum;

class Category extends Model
{
    // use HasFactory;

    // table default = name of the class
    // primary key default = id
    // timestamps (created_at and updated_at) activated by default


    public function getForums(){
    	//		this relation med 			forein key 		primary key
    	return $this->hasMany(Forum::class, 'category_id', 'id');
    }
}
