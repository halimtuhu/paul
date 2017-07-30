<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScholarshipsComment extends Model
{
    protected $table = "scholarships_comment";
    public function user(){
      return $this->belongsTo('App\User');
    }
    public function scholarship(){
      return $this->belongsTo('App\Scholarship');
    }
}
