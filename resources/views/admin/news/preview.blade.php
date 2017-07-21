@extends('layout.admin')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="page-header">News View</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <span class="pull-left">{{$news->title}}</span>
          <span class="pull-right">
            <form id="deleteNews{{$news->id}}" action="/admin-paul/news/{{$news->id}}/delete" method="post" style="display: none;">
              {{ csrf_field() }}
            </form>
            <a href="#" type="button" class="btn btn-danger btn-xs" onclick="document.getElementById('deleteNews{{$news->id}}').submit();"><i class="fa fa-times"></i></a>
            <a href="/admin-paul/news/{{$news->id}}/edit" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
          </span>
          <div class="clearfix"></div>
        </div>
        <div class="panel-body">
          @if ($news->featured_image)
            <center>
              <img src="{{asset('images/news/' . $news->featured_image)}}" alt="{{$news->featured_image}}" width="480px">
            </center>
            <br>
          @endif
          {!!$news->content!!}
        </div>
        <div class="panel-footer">
          <a href="#" type="button" class="btn btn-primary btn-xs"><i class="fa fa-thumbs-o-up"></i> 90</a>
          <a href="#" type="button" class="btn btn-warning btn-xs"><i class="fa fa-share-square-o"></i> 88</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <span><strong>Comments</strong> (5)</span>
        </div>
        <div class="panel-body">
          @for ($i=0; $i < 5; $i++)
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <span class="pull-left">
                      Username123
                    </span>
                    <span class="pull-right">
                      <a href="#" type="button" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                    </span>
                    <div class="clearfix"></div>
                  </div>
                  <div class="panel-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                  </div>
                  <div class="panel-footer">
                    <small>email@mail.com</small> || <small>dd/mm/yyyy hh:mm:ss</small>
                  </div>
                </div>
              </div>
            </div>
          @endfor
        </div>
      </div>
    </div> {{-- /col-md-6 --}}

    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          Add Comments
        </div>
        <div class="panel-body">
          <form action="" method="post">
            <div class="form-group">
              <label>Name</label>
              <input class="form-control" name="name" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input class="form-control" name="name" required>
            </div>
            <div class="form-group">
              <textarea class="form-control" rows="5" name="comment" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Comment</button>
          </form>
          <br>
        </div>
      </div>
    </div> {{-- col-md-6--}}
  </div>
@endsection
