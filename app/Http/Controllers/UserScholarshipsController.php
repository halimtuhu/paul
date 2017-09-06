<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Scholarship;
use App\ScholarshipsComment;
use Sentinel;
use DB;

class UserScholarshipsController extends Controller
{
      private $near;
      private $popular;
      private $comment;

      public function __construct(){
        $this->near = Scholarship::where('deadline', '>=', date('Y-m-d H:i:s'))->orderBy('deadline', 'asc')->limit('7')->get();
        $this->popular = Scholarship::select('*', DB::raw("count(scholarships_like.scholarships_id) as total_likes"), 'scholarships.created_at', 'scholarships.updated_at')->join('scholarships_like', 'scholarships.id', '=', 'scholarships_like.scholarships_id')->groupBy('scholarships_like.scholarships_id')->orderBy('total_likes', 'desc')->limit('10')->get();
        $this->comment = ScholarshipsComment::orderBy('created_at', 'desc')->limit('5')->get();

        // dd($this->popular);
      }

    public function index(){
      $scholarships = Scholarship::orderBy('created_at', 'desc')->paginate('10');

      return view('scholarship.index', compact('scholarships'))
        ->with('near', $this->near)
        ->with('popular', $this->popular)
        ->with('comment', $this->comment);
    }

    public function view($id){
      $scholarship = Scholarship::find($id);
      $scholarshipcomment = ScholarshipsComment::where('scholarships_id', $id)->orderBy('created_at', 'desc')->paginate(5);
      // dd($scholarship);
      return view('scholarship.view', compact('scholarship', 'scholarshipcomment'))
        ->with('near', $this->near)
        ->with('popular', $this->popular)
        ->with('comment', $this->comment);
    }

    public function addComment($id, Request $input){
      $comment = new ScholarshipsComment;
      $comment->user_id = Sentinel::getUser()->id;
      $comment->scholarships_id = $id;
      $comment->comment = $input->comment;
      $comment->save();

      return redirect()->back();
    }

    public function like($id){
      if (Sentinel::check()) {
        $scholarships = Scholarship::find($id);
        $scholarships->likes()->attach(Sentinel::getUser()->id);
        return redirect()->back();
      }else{
        return redirect('/login');
      }
    }

    public function dislike($id){
      $scholarships = Scholarship::find($id);
      $scholarships->likes()->detach(Sentinel::getUser()->id);
      return redirect()->back();
    }
}
