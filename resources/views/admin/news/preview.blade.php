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
          <a href="#" type="button" class="btn btn-primary btn-xs"><i class="fa fa-thumbs-o-up"></i> {{$news->liked}}</a>
          <a href="#" type="button" class="btn btn-warning btn-xs"><i class="fa fa-share-square-o"></i> {{$news->shared}}</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <span><strong>Comments</strong> ({{$comments->total()}})</span>
        </div>
        <div class="panel-body">
          @foreach ($comments as $key => $value)
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <span class="pull-left">
                      {{$value->user->username}}
                    </span>
                    <span class="pull-right">
                      <form id="deleteComment{{$value->id}}" action="/admin-paul/news/{{$news->id}}/comment/{{$value->id}}/delete" method="post" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                      <a href="#" type="button" class="btn btn-xs btn-danger" onclick="document.getElementById('deleteComment{{$value->id}}').submit();"><i class="fa fa-times"></i></a>
                    </span>
                    <div class="clearfix"></div>
                  </div>
                  <div class="panel-body">
                    <p>{{$value->comment}}</p>
                  </div>
                  <div class="panel-footer">
                    <small>{{$value->user->email}}</small> || <small>{{$value->created_at}}</small>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
          <center>
            {{$comments->links()}}
          </center>
        </div>
      </div>
    </div> {{-- /col-md-6 --}}

    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          Add Comments
        </div>
        <div class="panel-body">
          <form action="/admin-paul/news/{{$news->id}}/comment" method="post">
            {{ csrf_field() }}
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
