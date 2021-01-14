<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Forum;
use App\Reply;
use App\User;

class Thread extends Model
{
    // protected $fillable = ['title', 
    //     'body', 
    //     'forum_id', 
    //     'user_id',
    //     'updated_at'
    // ];

    protected $fillable = ['title', 
        'body', 
    ];

    public function getReplies(){
    	return $this->hasMany(Reply::class, 'thread_id', 'id');
    }
}
