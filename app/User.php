<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commenter;
use Illuminate\Notifications\Notifiable;


class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    use  Notifiable, Commenter;

    public function posts(){
      return $this->hasMany('App\Post');
    }
    public function likes(){
      return $this->hasMany('App\Like');
    }
}
