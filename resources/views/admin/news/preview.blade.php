@extends('layout.admin')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="page-header">{{$news->title}} - Preview</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-body">
          {{$news->content}}
        </div>
        <div class="panel-footer">
          <a href="#" type="button" class="btn btn-primary btn-xs"><i class="fa fa-thumbs-o-up"></i></a>
          <a href="#" type="button" class="btn btn-warning btn-xs"><i class="fa fa-share-square-o"></i></a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
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

    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <span><strong>Username</strong></span>
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

      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <span><strong>Username</strong></span>
            </div>
            <div class="panel-body">
              <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="panel-footer">
              <small>email@mail.com</small> || <small>dd/mm/yyyy hh:mm:ss</small>
            </div>
          </div>
        </div>
      </div>
    </div> {{-- /col-md-6 --}}
  </div>
@endsection
