<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\User;
use App\News;
use App\NewsCategory;
use App\NewsComment;
use DB;

class UserNewsController extends Controller
{
    private $categories;
    private $popular;
    private $comment;

    public function __construct(){
      $this->categories = NewsCategory::orderBy('category', 'asc')->get();
      $this->popular = News::select('*', DB::raw("count(news_like.news_id) as total_likes"), 'news.created_at', 'news.updated_at')->join('news_like', 'news.id', '=', 'news_like.news_id')->groupBy('news_like.news_id')->orderBy('total_likes', 'desc')->limit('10')->get();
      $this->comment = NewsComment::orderBy('created_at', 'desc')->limit('5')->get();

      // dd($this->popular);
    }
    public function index(){
      $news = News::orderBy('created_at', 'desc')->paginate('7');
      return view('news.index', compact('news'))
        ->with('categories', $this->categories)
        ->with('popular', $this->popular)
        ->with('comment', $this->comment);
    }

    public function view($id){
      $news = News::find($id);
      $newscomment = $news->comment()->orderBy('created_at', 'desc')->paginate('5');
      return view('news.view', compact('news', 'newscomment'))
        ->with('categories', $this->categories)
        ->with('popular', $this->popular)
        ->with('comment', $this->comment);
    }

    public function addComment($id, Request $input){
      $comment = new NewsComment;
      $comment->user_id = Sentinel::getUser()->id;
      $comment->news_id = $id;
      $comment->comment = $input->comment;
      $comment->save();

      return redirect()->back();
    }

    public function newsCategoryList($id){
      $current_category = NewsCategory::find($id);
      $news = $current_category->news()->orderBy('created_at', 'desc')->paginate('7');
      return view('news.index', compact('news', 'current_category'))
        ->with('categories', $this->categories)
        ->with('popular', $this->popular)
        ->with('comment', $this->comment);
    }

    public function like($id){
      if (Sentinel::check()) {
        $news = News::find($id);
        $news->likes()->attach(Sentinel::getUser()->id);
        return redirect()->back();
      }else{
        return redirect('/login');
      }
    }

    public function dislike($id){
      $news = News::find($id);
      $news->likes()->detach(Sentinel::getUser()->id);
      return redirect()->back();
    }
}
