@extends('layout.admin')
@section('content')
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        <span class="pull-left">Scholarships Post</span>
        <a href="/admin-paul/scholarships/add" type=button class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Add Scholarships</a>
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
                <th>Name</th>
                <th>Organizer</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($recent as $key => $value)
                <tr>
                  <td>{{$value->created_at}}</td>
                  <td>{{$value->name}}</td>
                  <td>{{$value->organizer}}</td>
                  <td align="center" style="width: 100px">
                    <form id="deleteScholarship{{$value->id}}" action="/admin-paul/scholarships/{{$value->id}}/delete" method="post" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                    <a href="#" type="button" class="btn btn-danger btn-xs" onclick="document.getElementById('deleteScholarship{{$value->id}}').submit();"><i class="fa fa-times"></i></a>
                    <a href="/admin-paul/scholarships/{{$value->id}}/edit" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                    <a href="/admin-paul/scholarships/{{$value->id}}/preview" type="button" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
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
                <th>Program Name</th>
                <th>Liked / Shared</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($trending as $key => $value)
                <tr>
                  <td>{{$value->name}}</td>
                  <td>{{$value->liked}} / {{$value->shered}}</td>
                  <td>{{$value->t_like_share}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          Near Scholarship
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th>Place</th>
                <th>Deadline</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($near as $key => $value)
                <tr>
                  <td>{{$value->name}}</td>
                  <td>{{$value->place}}</td>
                  <td nowrap>{{$value->deadline}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
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
                      {{$value->user->username}} on {{str_limit($value->scholarship->name, $limit = 35, $end = '...')}}
                    </span>
                    <span class="pull-right">
                      <a href="/admin-paul/scholarships/{{$value->scholarship->id}}/preview" type="button" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
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
                <th>Name</th>
                <th>Organizer</th>
                <th>Place</th>
                <th>Deadline</th>
                <th>Liked / Shared</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($scholarships as $key => $value)
                <tr>
                  <td>{{$value->name}}</td>
                  <td>{{$value->organizer}}</td>
                  <td>{{$value->place}}</td>
                  <td>{{$value->deadline}}</td>
                  <td>{{$value->liked}} / {{$value->shered}}</td>
                  <td align="center" style="width: 100px">
                    <form id="deleteScholarship{{$value->id}}" action="/admin-paul/scholarships/{{$value->id}}/delete" method="post" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                    <a href="#" type="button" class="btn btn-danger btn-xs" onclick="document.getElementById('deleteScholarship{{$value->id}}').submit();"><i class="fa fa-times"></i></a>
                    <a href="/admin-paul/scholarships/{{$value->id}}/edit" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                    <a href="/admin-paul/scholarships/{{$value->id}}/preview" type="button" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
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
