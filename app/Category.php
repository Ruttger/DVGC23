<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Forum;

class Category extends Model
{
    public function getForums(){
    	//		this relation med 			forein key 		primary key
    	return $this->hasMany(Forum::class, 'category_id', 'id');
    }
}
