@extends('layout.user.user')
@section('content')

    <!-- Blog Content
    ================================================== -->
    <div class="row">

        <!-- Blog Posts
        ================================================== -->
        <div class="span8 blog">
          @if (isset($current_category))
            <h3 style="margin-bottom: 20px;">Showing all {{$current_category->category}}'s news</h3>
          @endif
            <!-- Blog Post 1 -->
            @foreach ($news as $key => $value)
              <div class="row">
                <article class="clearfix">
                  @if ($value->featured_image)
                    <div class="span3">
                      <a href="/news/{{$value->id}}"><img src="{{asset('images/news/'.$value->featured_image)}}" alt="{{$value->featured_image}}" class="align-left" width="270px"></a>
                    </div>
                  @endif
                  <div @if ($value->featured_image) class="span5" @else class="span8" @endif>
                    <h4 class="title-bg"><a href="/news/{{$value->id}}">{{$value->title}}</a></h4>
                    <p>{{strip_tags(str_limit($value->content, $limit = 200, $end = "..."))}}</p>
                    <button class="btn btn-mini btn-inverse" type="button">Read more</button>
                      <ul class="post-data">
                        <li><i class="icon-calendar"></i> {{date('Y-m-d', strtotime($value->created_at))}}</li>
                        <li><i class="icon-comment"></i> <a href="#">{{$value->comment()->count()}}</a></li>
                        <li><i class="icon-tags"></i> <a href="/news/category/{{$value->category->id}}">{{$value->category->category}}</a></li>
                      </ul>
                  </div>
                </article>
              </div>
            @endforeach

            <!-- Pagination -->
            <div class="pagination">
              {{$news->links()}}
            </div>
        </div>

        @include('layout.user.sidebar')

    </div>
@endsection
