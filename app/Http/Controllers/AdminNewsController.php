<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\News;
use App\NewsCategory;
use App\NewsComment;
use Image;
use Sentinel;

class AdminNewsController extends Controller
{
    public function index(){
      $newsList = News::select('news.*', 'news_category.category')->join('news_category', 'news.news_category_id', '=', 'news_category.id')->orderBy('news.created_at', 'desc')->get();
      $recentNewsList = News::select('news.*', 'news_category.category')->join('news_category', 'news_category.id', '=', 'news.news_category_id')->orderBy('news.created_at', 'desc')->limit('5')->get();
      $newsLiked = News::select('id','title', 'liked', 'shared', DB::raw('(liked+shared) as t_like_share'))->orderBy('liked', 'desc')->limit('5')->get();
      $newsShared = News::select('title', 'shared')->orderBy('shared', 'desc')->limit('5')->get();
      $categories = NewsCategory::orderBy('category', 'acs')->get();
      $comments = NewsComment::orderBy('created_at', 'desc')->limit('2')->get();
      return view('admin.news.index', compact('newsList', 'recentNewsList', 'newsLiked', 'newsShared', 'categories', 'comments'));
    }

    public function add(){
      $category = NewsCategory::orderBy('category', 'asc')->get();
      return view('admin.news.addForm', compact('category'));
    }

    public function store(Request $input){
      $news = new News;
      $news->title = $input->title;
      $news->content = $input->content;
      if($input->new_category != null && $input->category == 0){
        $newCategory = new NewsCategory;
        $newCategory->category = $input->new_category;
        $newCategory->save();
        $news->news_category_id = $newCategory->id;
      }else{
        $news->news_category_id = $input->category;
      }
      if($input->hasFile('featured_image')){
        $image = $input->featured_image;
        $newname = time() . "." . $image->getClientOriginalExtension();
        Storage::disk('local')->makeDirectory('news');
        $location = public_path('images/news/' . $newname);
        Image::make($image)->resize(1024, null, function ($constraint) {
          $constraint->aspectRatio();
        })->save($location);
        $news->featured_image = $newname;
      }
      $news->save();

      return redirect('/admin-paul/news');
    }

    public function edit($id){
      $editNews = News::find($id);
      $category = NewsCategory::orderBy('category', 'asc')->get();
      return view('admin.news.editForm', compact('editNews', 'category'));
    }

    public function update(Request $input, $id){
      $updateNews = News::find($id);
      $updateNews->title = $input->title;
      $updateNews->content = $input->content;
      if($input->new_category != null && $input->category == 0){
        $newCategory = new NewsCategory;
        $newCategory->category = $input->new_category;
        $newCategory->save();
        $updateNews->news_category_id = $newCategory->id;
      }else{
        $updateNews->news_category_id = $input->category;
      }
      if($input->hasFile('featured_image')){
        $image = $input->featured_image;
        $newname = time() . "." . $image->getClientOriginalExtension();
        Storage::disk('local')->makeDirectory('news');
        $location = public_path('images/news/' . $newname);
        Image::make($image)->resize(1024, null, function ($constraint) {
          $constraint->aspectRatio();
        })->save($location);
        if ($updateNews->featured_image) {
          Storage::delete('news/' . $updateNews->featured_image);
        }
        $updateNews->featured_image = $newname;
      }
      $updateNews->save();

      return redirect('/admin-paul/news/'.$updateNews->id.'/preview');
    }

    public function deleteFeaturedImage($id){
      $news = News::find($id);
      Storage::delete('news/' . $news->featured_image);
      $news->featured_image = null;
      $news->save();

      return redirect()->back();
    }

    public function delete($id){
      $deleteNews = News::find($id);
      if (Storage::delete('news/' . $deleteNews->featured_image)) {
        return redirect()->back();
      }else{
        return redirect()->back();
      }
      $deleteNews->delete();
    }

    public function preview($id){
      $news = News::find($id);
      $comments = $news->comment()->orderBy('created_at', 'desc')->paginate('3');
      if($news){
        return view('admin.news.preview', compact('news', 'comments'));
      }else{
        return redirect('/admin-paul/news');
      }
    }

    public function category(Request $input){
      if (isset($input->category)) {
        return redirect('/admin-paul/news/category/'.$input->category.'/list');
      }else{
        return redirect('/admin-paul/news/category/'.NewsCategory::orderBy('category', 'asc')->get()->first()->id.'/list');
      }
    }

    public function showCategory($id){
      $category = NewsCategory::find($id);
      if (!$category){
        return redirect('/admin-paul/news');
      }
      $news = $category->news()->paginate('5');
      $categorylist = NewsCategory::orderBy('category', 'asc')->get();
      // dd($news->count());

      return view('admin.news.category', compact('category', 'news', 'categorylist'));
    }

    public function updateCatageory($id, Request $input){
      $category = NewsCategory::find($id);
      $category->category = $input->category;
      $category->save();

      return redirect()->back();
    }

    public function deleteCategory($id){
      $category = NewsCategory::find($id);
      $news = $category->news;
      if($news->count() <= 0){
        $category->delete();
        return redirect('/admin-paul/news');
      }else{
        return redirect()->back();
      }
    }

    public function addComment($id, Request $input){
      $comment = new NewsComment;
      $comment->user_id = Sentinel::getUser()->id;
      $comment->news_id = $id;
      $comment->comment = $input->comment;
      $comment->save();

      return redirect()->back();
    }

    public function deleteComment($news_id, $comment_id){
      $comment = NewsComment::find($comment_id);
      $comment->delete();

      return redirect()->back();
    }
}
