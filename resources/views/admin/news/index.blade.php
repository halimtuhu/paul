@extends('layout.admin')
@section('content')
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        <span class="pull-left">News Post</span>
        <a href="/admin-paul/news/add" type=button class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Add News</a>
        <div class="clearfix"></div>
      </h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          Recent Post
        </div>
        <div class="panel-body">
          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTablesNoPaging">
            <thead>
              <tr>
                <th>Time</th>
                <th>Title</th>
                <th>Category</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($recentNewsList as $key => $value)
                <tr>
                  <td>{{$value->created_at}}</td>
                  <td>{{$value->title}}</td>
                  <td>{{$value->category}}</td>
                  <td align="center" style="width: 100px">
                    <form id="deleteNews{{$value->id}}" action="/admin-paul/news/{{$value->id}}/delete" method="post" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                    <a href="#" type="button" class="btn btn-danger btn-xs" onclick="document.getElementById('deleteNews{{$value->id}}').submit();"><i class="fa fa-times"></i></a>
                    <a href="/admin-paul/news/{{$value->id}}/edit" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                    <a href="/admin-paul/news/{{$value->id}}/preview" type="button" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          Trending Topic
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>News Title</th>
                <th>Liked / Comments</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($trending as $key => $value)
                <tr>
                  <td>{{$value->title}}</td>
                  <td>{{$value->liked}} / {{$value->comments}}</td>
                  <td>{{$value->total}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          Recent Comment
        </div>
        <div class="panel-body">
          @foreach ($comments as $key => $value)
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <span class="pull-left">
                      {{$value->user->username}} at <a href="/admin-paul/news/{{$value->news->id}}/preview">{{$value->news->title}}</a>
                    </span>
                    <span class="pull-right">
                      <a href="#" type="button" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
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
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          Category List
        </div>
        <div class="panel-body">
          <table class="table table-hover">
            <tbody>
              @foreach ($categories as $value)
                <tr>
                  <td>{{$value->category}}</td>
                  <td>{{$value->news->count()}} posts</td>
                  <td align="right">
                    <a href="/admin-paul/news/category/{{$value->id}}/list" type="button" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          News List
        </div>
        <div class="panel-body">
          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
            <thead>
              <tr>
                <th>Time</th>
                <th>Title</th>
                <th>Category</th>
                <th>Liked / Shared</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($newsList as $key => $value)
                <tr>
                  <td>{{$value->created_at}}</td>
                  <td>{{$value->title}}</td>
                  <td>{{$value->category}}</td>
                  <td>{{\App\News::find($value->id)->likes->count()}}/{{\App\News::find($value->id)->comment->count()}}</td>
                  <td align="center">
                    <a href="#" type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a>
                    <a href="/admin-paul/news/{{$value->id}}/edit" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                    <a href="/admin-paul/news/{{$value->id}}/preview" type="button" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
