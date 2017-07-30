<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function newsComment(){
      return $this->hasMany('App\NewsComment');
    }

    public function scholarshipsComment(){
      return $this->hasMany('App\ScholarshipsComment');
    }

    public function likeNews(){
      return $this->hasMany('App\News', 'news_like', 'user_id', 'news_id');
    }
}
