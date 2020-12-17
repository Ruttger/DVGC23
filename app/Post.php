<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table Name
    protected $table = 'posts';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps;
    public $Role = 100;

    public function user(){
        return $this->belongsTo('Appbu\User');
    }
}
