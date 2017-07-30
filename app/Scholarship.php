<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $table = "scholarships";

    public function comment(){
      return $this->hasMany('App\ScholarshipsComment');
    }
}
