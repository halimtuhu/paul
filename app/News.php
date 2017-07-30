<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = "news";

    public function category() {
      return $this->belongsTo('App\NewsCategory', 'news_category_id');
    }

    public function comment() {
      return $this->hasMany('App\NewsComment');
    }

    public function likes() {
      return $this->belongsToMany('App\User', 'news_like', 'news_id', 'user_id');
    }

    public function totalLikes() {
      return $this->belongsToMany('App\User', 'news_like', 'news_id', 'user_id')->selectRaw('count(news.news_id) as total_likes')->groupBy('news_id');
    }
}
