@extends('layout.user.user')
@section('content')
  <style media="screen">
    .recent-news-img {
      display: block;
      width: 200px;
      height: 200px;
      float: left;
      margin-right: 25px;
      margin-bottom: 15px;
    }
    .recent-news-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .slidder-img {
      display: block;
      height: 360px;
      margin: 0px;
      padding: 0px;
      align-items: center;
    }
    .slidder-img a > img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  </style>
  <div class="row headline"><!-- Begin Headline -->

    <!-- Slider Carousel
      ================================================== -->
      <div class="span8">
        <div class="flexslider">
            <ul class="slides">
              @foreach ($slides->sortByDesc('created_at') as $key => $value)
                <li class="slidder-img"><a class="slidder-img" href="/{{$value['post_type']}}/{{$value['id']}}"><img src="{{asset('/images/'.$value['post_type'].'/'.$value['featured_image'])}}" alt="{{$value['title']}}" /></a></li>
              @endforeach
            </ul>
          </div>
      </div>

      <!-- Headline Text
      ================================================== -->
      <div class="span4">
        <h3>Welcome to My Webstie. <br />
          My name is Paul</h3>
          <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam pretium vulputate magna sit amet blandit.</p>
          <p>Cras rutrum, massa non blandit convallis, est lacus gravida enim, eu fermentum ligula orci et tortor. In sit amet nisl ac leo pulvinar molestie. Morbi blandit ultricies ultrices. Vivamus nec lectus sed orci molestie molestie. Etiam mattis neque eu orci rutrum aliquam.</p>
          <a href="/about"><i class="icon-plus-sign"></i>Read More</a>
      </div>
  </div><!-- End Headline -->

  <div class="row"><!-- Begin Bottom Section -->

    <!-- Blog Preview
      ================================================== -->
    <div class="span6">

          <h5 class="title-bg">From the News
              <small>All the latest news</small>
              <button id="btn-blog-next1" class="btn btn-inverse btn-mini" type="button">&raquo;</button>
              <button id="btn-blog-prev1" class="btn btn-inverse btn-mini" type="button">&laquo;</button>
          </h5>

      <div id="blogCarousel1" class="carousel slide ">

          <!-- Carousel items -->
          <div class="carousel-inner">

               <!-- Blog Item 1 -->
              @foreach ($news as $key => $value)
                @if ($key == 0)
                  <div class="active item">
                @else
                  <div class="item">
                @endif
                    <a href="/news/{{$value->id}}" class="recent-news-img"><img src="{{asset('/images/news/'.$value->featured_image)}}" alt="{{$value->title}}"/></a>
                    <div class="post-info clearfix">
                        <h4><a href="blog-single.htm">{{$value->title}}</a></h4>
                        <ul class="blog-details-preview">
                            <li><i class="icon-calendar"></i><strong>Posted on:</strong> {{$value->created_at}}<li>
                            <li><i class="icon-comment"></i><strong>Comments:</strong> {{$value->comment()->count()}}</a><li>
                            <li><i class="icon-tags"></i> <a href="/news/category/{{$value->category->id}}">{{$value->category->category}}</a></li>
                        </ul>
                    </div>
                    <p class="blog-summary">{{strip_tags(str_limit($value->content, 75, "..."))}}<a href="/news/{{$value->id}}">Read more</a><p>
                </div>
              @endforeach

          </div>
          </div>
      </div>

      <div class="span6">

            <h5 class="title-bg">From the Scholarship
                <small>All the latest scholarhsip info</small>
                <button id="btn-blog-next2" class="btn btn-inverse btn-mini" type="button">&raquo;</button>
                <button id="btn-blog-prev2" class="btn btn-inverse btn-mini" type="button">&laquo;</button>
            </h5>

        <div id="blogCarousel2" class="carousel slide ">

            <!-- Carousel items -->
            <div class="carousel-inner">

                 <!-- Blog Item 2 -->
                @foreach ($scholarship as $key => $value)
                  @if ($key == 0)
                    <div class="active item">
                  @else
                    <div class="item">
                  @endif
                      <a href="/news/{{$value->id}}" class="recent-news-img"><img src="{{asset('/images/scholarship/'.$value->featured_image)}}" alt="{{$value->name}}"/></a>
                      <div class="post-info clearfix">
                          <h4><a href="blog-single.htm">{{$value->name}}</a></h4>
                          <ul class="blog-details-preview">
                              <li><i class="icon-time"></i><strong>Deadline:</strong> {{$value->deadline}}</li>
                              <li><i class="icon-user"></i><strong>Organizer:</strong> {{$value->organizer}}</li>
                              <li><i class="icon-globe"></i><strong>Place:</strong> {{$value->place}}</a></li>
                              <li><i class="icon-calendar"></i><strong>Posted on:</strong> {{$value->created_at}}<li>
                              <li><i class="icon-comment"></i><strong>Comments:</strong> {{$value->comment()->count()}}</a><li>
                          </ul>
                      </div>
                      <p class="blog-summary">{{strip_tags(str_limit($value->description, 75, "..."))}}<a href="/news/{{$value->id}}">Read more</a><p>
                  </div>
                @endforeach

            </div>
            </div>
        </div>

  </div><!-- End Bottom Section -->
@endsection

@section('js')
  <script type="text/javascript">
    $(document).ready(function () {

        $("#btn-blog-next1").click(function () {
          $('#blogCarousel1').carousel('next')
        });
         $("#btn-blog-prev1").click(function () {
          $('#blogCarousel1').carousel('prev')
        });

        $("#btn-blog-next2").click(function () {
          $('#blogCarousel2').carousel('next')
        });
         $("#btn-blog-prev2").click(function () {
          $('#blogCarousel2').carousel('prev')
        });

    });
  </script>
@endsection
