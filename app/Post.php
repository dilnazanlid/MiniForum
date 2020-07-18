<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class Post extends Model
{
    use Commentable;
    public function user(){
      return $this->belongsTo('App\User');
    }
    public function likes(){
      return $this->belongsTo('App\Like');
    }
}
