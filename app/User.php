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

    protected $fillable = ['name', 'email', 'username', 'password'];

    public function posts(){
      return $this->hasMany('App\Post');
    }
    public function likes(){
      return $this->hasMany('App\Like');
    }

    public function setPasswordAttribute($password){
      $this->attributes['password'] = bcrypt($password);
    }

}
