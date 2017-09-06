@extends('layout.user.user')
@section('content')

    <!-- Blog Content
    ================================================== -->
    <div class="row">

        <!-- Blog Posts
        ================================================== -->
        <div class="span8 blog">
          {{-- @if (isset($current_category))
            <h3 style="margin-bottom: 20px;">Showing all {{$current_category->category}}'s news</h3>
          @endif --}}
            <!-- Blog Post 1 -->
            @foreach ($scholarships as $key => $value)
              <div class="row">
                <article class="clearfix">
                  @if ($value->featured_image)
                    <div class="span3">
                      <a href="/scholarship/{{$value->id}}"><img src="{{asset('images/scholarships/'.$value->featured_image)}}" alt="{{$value->featured_image}}" class="align-left" width="270px"></a>
                    </div>
                  @endif
                  <div @if ($value->featured_image) class="span5" @else class="span8" @endif>
                    <h4 class="title-bg"><a href="/scholarship/{{$value->id}}">{{$value->name}}</a></h4>
                    <p>{{strip_tags(str_limit($value->description, $limit = 200, $end = "..."))}}</p>
                    <button class="btn btn-mini btn-inverse" type="button">Read more</button>
                      <ul class="post-data">
                        <li><i class="icon-calendar"></i> {{date('Y-m-d', strtotime($value->created_at))}}</li>
                        <li><i class="icon-comment"></i> <a href="#">12</a></li>
                      </ul>
                  </div>
                </article>
              </div>
            @endforeach

            <!-- Pagination -->
            <div class="pagination">
              {{$scholarships->links()}}
            </div>
        </div>

        @include('scholarship.sidebar')

    </div>
@endsection
