@extends('layout.admin')
@section('content')
  <script type="text/javascript">
    function showNewCategoryForm(){
      if(document.getElementById('oldCategory').value == 0){
        document.getElementById('newCategory').style.display = "block";
      }
    }

    window.onload = function() {
      showNewCategoryForm();
    };
  </script>

  <div class="row">
    <div class="col-md-12">
      <h1 class="page-header">Add News</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Add News
        </div>
        <div class="panel-body">
          <form id="addScholarships" role="form" action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Program Name</label>
              <input class="form-control" placeholder="Enter scholarships program name here" name="name" value="{{$scholarship->name}}" required>
            </div>
            <div class="form-group">
              <label>Organizer</label>
              <input class="form-control" placeholder="Who is organize this program" type="text" name="organizer" value="{{$scholarship->organizer}}" required>
            </div>
            <div class="form-group">
              <label>Place</label>
              <input class="form-control" placeholder="Where is this program committed" type="text" name="place" value="{{$scholarship->place}}" required>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control tinymcetextarea" name="description" rows="8" required>{!!$scholarship->description!!}</textarea>
            </div>
            <div class="form-group col-sm-6">
              <label>Date deadline</label>
              <input class="form-control" type="date" name="datedeadline" value="{{date("Y-m-d", strtotime($scholarship->deadline))}}">
            </div>
            <div class="form-group col-sm-6">
              <label>Time deadline</label>
              <input class="form-control" type="time" name="timedeadline" value="{{date("H:i", strtotime($scholarship->deadline))}}">
            </div>
            <div class="form-group">
              <label>Featured Image</label>
              <input class="form-control" type="file" name="featured_image">
              <br>
              <p>
                Current image:
                @if ($scholarship->featured_image)
                  <img src="{{asset('images/scholarships/' . $scholarship->featured_image)}}" alt="{{$scholarship->featured_image}}" width="240px">
                @else
                  no image
                @endif
              </p>
            </div>
            <button class="btn btn-success" type="button" onclick="getElementById('addScholarships').submit();">Post</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
