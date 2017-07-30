<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\News;
use App\NewsCategory;
use DB;

class PageController extends Controller
{
    public function index(){
      $news = News::orderBy('created_at', 'desc')->limit('5')->get();
      $news2 = News::orderBy('created_at', 'asc')->limit('5')->get();
      return view('home', compact('news', 'news2'));
    }
}
