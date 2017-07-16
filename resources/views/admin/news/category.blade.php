@extends('layout.admin')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="page-header">
        <span class="pull-left">News List about {{$category->category}}</span>
        <a href="/admin-paul/news/add" type=button class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Add News</a>
        <div class="clearfix"></div>
      </h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      @foreach ($news as $value)
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <span class="pull-left">{{$value->title}}</span>
                <span class="pull-right">
                  <a href="/admin-paul/news/{{$value->id}}/edit" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                  <form id="deleteNews{{$value->id}}" action="/admin-paul/news/{{$value->id}}/delete" method="post" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                  <a href="#" type="button" class="btn btn-danger btn-xs" onclick="document.getElementById('deleteNews{{$value->id}}').submit();"><i class="fa fa-times"></i></a>
                </span>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
                @if ($value->featured_image)
                  <div class="col-md-3">
                    <img class="img-responsive" src="{{asset('images/news/' . $value->featured_image)}}" alt="{{$value->featured_image}}" width="100%">
                  </div>
                @endif
                <p @if ($value->featured_image) class="col-md-9" @endif>{{str_limit($value->content, $limit = 200, $end = '...')}}</p>
              </div>
              <div class="panel-footer">
                posted on {{$value->created_at}}
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          Edit Category
        </div>
        <div class="panel-body">
          <form id="updateCategory" role="form" action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Category Name</label>
              <input class="form-control" placeholder="Enter news title here" name="category" value="{{$category->category}}" required>
            </div>
          </form>
          <form id="deleteCategory" class="form" action="/admin-paul/news/cateogry/{{$category->id}}/delete" method="post" style="display: none;">
            {{ csrf_field() }}
          </form>
          <button class="btn btn-success" type="button" onclick="getElementById('updateCategory').submit();">Update</button>
          <button class="btn btn-danger" type="button" onclick="getElementById('deleteCategory').submit();" @if ($news->count() > 0) disabled @endif>Delete</button>
          <hr>
          <p><small><strong>Note: </strong>Ganti dulu kategori di semua post yang tampil di sebelah kiri atau hapus semua post yang ada di sebelah kiri untuk menghapus kategori ini.</small></p>

        </div>
      </div>
    </div>
  </div>
@endsection
