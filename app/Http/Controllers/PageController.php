<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\User;
use App\News;
use App\NewsCategory;
use App\Scholarship;
use DB;

class PageController extends Controller
{
    public function index(){
      $news = News::orderBy('created_at', 'desc')->limit('5')->get();
      $scholarship = Scholarship::orderBy('created_at', 'desc')->limit('5')->get();
      $slides = new Collection();
      foreach ($news as $key => $value) {
        $slides->push([
          'id' => $value->id,
          'post_type' => 'news',
          'title' => $value->title,
          'featured_image' => $value->featured_image,
          'created_at' => $value->created_at,
        ]);
      }
      foreach ($scholarship as $key => $value) {
        $slides->push([
          'id' => $value->id,
          'post_type' => 'scholarship',
          'title' => $value->name,
          'featured_image' => $value->featured_image,
          'created_at' => $value->created_at,
        ]);
      }

      return view('home', compact('slides', 'news', 'scholarship'));
    }
}
