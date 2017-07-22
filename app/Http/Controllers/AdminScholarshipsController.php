<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Scholarship;
use Image;

class AdminScholarshipsController extends Controller
{
    public function index(){
      $scholarships = Scholarship::all();
      $recent = Scholarship::orderBy('created_at', 'desc')->limit('5')->get();
      $trending = Scholarship::select('name', 'liked', 'shered', DB::raw('(liked+shered) as t_like_share'))->orderBy('t_like_share', 'desc')->limit('5')->get();
      $near = Scholarship::select('name', 'place', 'deadline')->where('deadline', '>=', date('Y-m-s H:i:s'))->orderBy('deadline', 'asc')->limit('5')->get();
      return view ('admin.scholarships.index', compact('scholarships', 'recent', 'trending', 'near'));
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

      return redirect('/admin-paul/scholarships');
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

      return view('admin.scholarships.preview', compact('scholarship'));
    }
}
