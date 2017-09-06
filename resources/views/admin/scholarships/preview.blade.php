@extends('layout.admin')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="page-header">Scholarships View</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <span class="pull-left">Scholarship Program</span>
          <span class="pull-right">
            <form id="deleteScholar{{$scholarship->id}}" action="/admin-paul/scholarships/{{$scholarship->id}}/delete" method="post" style="display: none;">
              {{ csrf_field() }}
            </form>
            <a href="#" type="button" class="btn btn-danger btn-xs" onclick="document.getElementById('deleteScholar{{$scholarship->id}}').submit();"><i class="fa fa-times"></i></a>
            <a href="/admin-paul/scholarships/{{$scholarship->id}}/edit" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
          </span>
          <div class="clearfix"></div>
        </div>
        <div class="panel-body">
          @if ($scholarship->featured_image)
            <center>
              <img src="{{asset('images/scholarships/' . $scholarship->featured_image)}}" alt="{{$scholarship->featured_image}}" width="480px">
            </center>
            <br>
          @endif
          <hr>
          <p><strong>Program Name: </strong>{{$scholarship->name}}</p>
          <p><strong>Organizer: </strong>{{$scholarship->organizer}}</p>
          <p><strong>Place: </strong>{{$scholarship->place}}</p>
          <p><strong>Deadline: </strong>{{$scholarship->deadline}}</p>
          <p>
            <strong>Description:</strong><br>
            {!!$scholarship->description!!}
          </p>
        </div>
        <div class="panel-footer">
          <a href="#" type="button" class="btn btn-primary btn-xs"><i class="fa fa-thumbs-o-up"></i> {{$scholarship->liked}}</a>
          <a href="#" type="button" class="btn btn-success btn-xs"><i class="fa fa-comment"></i> {{$scholarship->comment->count()}}</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <span><strong>Comments</strong></span>
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
                      <a href="#" type="button" class="btn btn-xs btn-danger"><i class="fa fa-times" onclick="document.getElementById('deleteComment{{$value->id}}').submit();"></i></a>
                      <form id="deleteComment{{$value->id}}" action="/admin-paul/scholarships/{{$scholarship->id}}/comment/{{$value->id}}/delete" method="post">
                        {{ csrf_field() }}
                      </form>
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
          <form action="/admin-paul/scholarships/{{$scholarship->id}}/comment" method="post">
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
