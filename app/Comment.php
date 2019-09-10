<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    public $timestamps = false;
    protected $fillable = ['user_id','comment','post_id'];
    // protected $perPage = 5;  

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
