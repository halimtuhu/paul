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
      <h1 class="page-header">Edit News</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Edit News
        </div>
        <div class="panel-body">
          <form id="editNews" role="form" action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Title</label>
              <input class="form-control" placeholder="Enter news title here" name="title" required value="{{$editNews->title}}">
            </div>
            <div class="form-group">
              <label>Content</label>
              <textarea class="form-control tinymcetextarea" rows="5" name="content" required>{{$editNews->content}}</textarea>
            </div>
            <div class="form-group">
              <label>Featured Image</label>
              <input class="form-control" type="file" name="featured_image">
              <br>
              <p>
                Current image:
                @if ($editNews->featured_image)
                  <img src="{{asset('images/news/' . $editNews->featured_image)}}" alt="{{$editNews->featured_image}}" width="240px">
                @else
                  no image
                @endif
              </p>
            </div>
            <div class="form-group">
              <label>Category</label>
              <select id="oldCategory" class="form-control" name="category" onchange="showNewCategoryForm();">
                @if ($category->count() > 0)
                  @foreach ($category as $key => $value)
                    <option value="{{$value->id}}" @if ($editNews->news_category_id == $value->id) selected @endif>{{$value->category}}</option>
                  @endforeach
                @endif
                <option value="0">-- New --</option>
              </select>
              <input id="newCategory" class="form-control" placeholder="Please specify new category here" name="new_category" style="display: none;">
            </div>
            <button class="btn btn-success" type="button" onclick="getElementById('editForm').submit();">Post</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
