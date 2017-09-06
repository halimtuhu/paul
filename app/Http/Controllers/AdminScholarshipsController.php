<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Scholarship;
use App\ScholarshipsComment;
use Image;
use Sentinel;

class AdminScholarshipsController extends Controller
{
    public function index(){
      $scholarships = Scholarship::all();
      $recent = Scholarship::orderBy('created_at', 'desc')->limit('5')->get();
      $trending = Scholarship::select('name', 'liked', 'shered', DB::raw('(liked+shered) as t_like_share'))->orderBy('t_like_share', 'desc')->limit('5')->get();
      $near = Scholarship::select('name', 'place', 'deadline')->where('deadline', '>=', DB::raw('now()'))->orderBy('deadline', 'asc')->limit('5')->get();
      $comments = ScholarshipsComment::orderBy('created_at', 'desc')->limit('2')->get();

      // dd($near);

      return view ('admin.scholarships.index', compact('scholarships', 'recent', 'trending', 'near', 'comments'));
    }

    public function add(){
      return view ('admin.scholarships.addForm');
    }

    public function store(Request $input){
      $scholarship = new Scholarship;
      $scholarship->name = $input->name;
      $scholarship->organizer = $input->organizer;
      $scholarship->place = $input->place;
      $scholarship->description = $input->description;
      $scholarship->deadline = $input->datedeadline . " " . $input->timedeadline;

      if ($input->hasFile('featured_image')) {
        $image = $input->featured_image;
        $newname = time() . "." . $image->getClientOriginalExtension();
        Storage::disk('local')->makeDirectory('scholarships');
        $location = public_path('images/scholarships/' . $newname);
        Image::make($image)->resize(1024, null, function ($constraint) {
          $constraint->aspectRatio();
        })->save($location);
        $scholarship->featured_image = $newname;
      }

      $scholarship->save();

      return redirect('/admin-paul/scholarships/'.$scholarship->id.'/preview');
    }

    public function delete($id){
      $scholarship = Scholarship::find($id);
      Storage::delete('scholarships/' . $scholarship->featured_image);
      $scholarship->delete();
      return redirect('/admin-paul/scholarships');
    }

    public function edit($id){
      $scholarship = Scholarship::find($id);

      return view('admin.scholarships.editForm', compact('scholarship'));
    }

    public function update($id, Request $input){
      $scholarship = Scholarship::find($id);
      $scholarship->name = $input->name;
      $scholarship->organizer = $input->organizer;
      $scholarship->place = $input->place;
      $scholarship->description = $input->description;
      $scholarship->deadline = $input->datedeadline . " " . $input->timedeadline;

      if ($input->hasFile('featured_image')) {
        $image = $input->featured_image;
        $newname = time() . "." . $image->getClientOriginalExtension();
        Storage::disk('local')->makeDirectory('scholarships');
        $location = public_path('images/scholarships/' . $newname);
        Image::make($image)->resize(1024, null, function ($constraint) {
          $constraint->aspectRatio();
        })->save($location);
        if ($scholarship->featured_image) {
          Storage::delete('scholarships/' . $scholarship->featured_image);
        }
        $scholarship->featured_image = $newname;
      }

      $scholarship->save();

      return redirect('/admin-paul/scholarships/'.$scholarship->id.'/preview');
    }

    public function preview($id){
      $scholarship = Scholarship::find($id);
      $comments = $scholarship->comment()->orderBy('created_at', 'desc')->paginate('3');

      return view('admin.scholarships.preview', compact('scholarship', 'comments'));
    }

    public function addComment($id, Request $input){
      $comment = new ScholarshipsComment;
      $comment->user_id = Sentinel::getUser()->id;
      $comment->scholarships_id = $id;
      $comment->comment = $input->comment;
      $comment->save();

      return redirect()->back();
    }

    public function deleteComment($scholarship_id, $comment_id){
      $comment = ScholarshipsComment::find($comment_id);
      $comment->delete();

      return redirect()->back();
    }
}
