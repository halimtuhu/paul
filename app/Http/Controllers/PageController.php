<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
      return view('welcome');
    }

    public function news(){
      return view('news.index');
    }

    public function scholarship(){
      return view('scholarship.index');
    }
}
