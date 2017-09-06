<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $table = "scholarships";

    public function comment(){
      return $this->hasMany('App\ScholarshipsComment', 'scholarships_id');
    }

    public function likes() {
      return $this->belongsToMany('App\User', 'scholarships_like', 'scholarships_id', 'user_id');
    }

    public function totalLikes() {
      return $this->belongsToMany('App\User', 'scholarships_like', 'scholarships_id', 'user_id')->selectRaw('count(scholarships.scholarships_id) as total_likes')->groupBy('scholarships_id');
    }
}
