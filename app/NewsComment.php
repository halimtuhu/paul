<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsComment extends Model
{
    protected $table = "news_comment";

    public function news(){
      return $this->belongsTo('App\News');
    }

    public function user(){
      return $this->belongsTo('App\User');
    }
}
