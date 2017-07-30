@extends('layout.user.user')
@section('meta')
  <meta property="og:url"                content="{{Request::url()}}" />
  <meta property="og:type"               content="news" />
  <meta property="og:title"              content="{{$news->title}}" />
  <meta property="og:description"        content="{{strip_tags(str_limit($news->content, $limit = 200, $end = "..."))}}" />
  <meta property="og:image"              content="{{env('APP_URL') . asset('/images/news/' . $news->featured_image)}}" />
@endsection
@section('content')

    <!-- Blog Content
    ================================================== -->
    <div class="row">

      <!-- Blog Full Post
      ================================================== -->
      <div class="span8 blog">

          <!-- Blog Post 1 -->
          <article>
              <h3 class="title-bg"><a href="#">{{$news->title}}</a></h3>
              <div class="post-content">
                  @if ($news->featured_image)
                    <center>
                      <a href="#"><img src="{{asset('/images/news/'.$news->featured_image)}}" alt="{{$news->title}}" width="65%"></a>
                    </center>
                  @endif

                  <div class="post-body">
                    {!!$news->content!!}
                  </div>

                  <div class="post-summary-footer">
                      <ul class="post-data" style="float: left; margin-left: 0px;">
                        @if (Sentinel::check())
                          @if ($news->likes()->where('user_id', Sentinel::getUser()->id)->get()->first())
                            <li><a href="/news/{{$news->id}}/dislike"><i class="icon-thumbs-up"></i> {{$news->likes()->count()}} liked</a></li>
                          @else
                            <li><a href="/news/{{$news->id}}/like"><i class="icon-hand-right"></i> {{$news->likes()->count()}} like</a></li>
                          @endif
                        @else
                          <li><a href="/news/{{$news->id}}/like"><i class="icon-hand-right"></i> {{$news->likes()->count()}} like</a></li>
                        @endif
                        <li>
                          <div class="fb-share-button" data-href="{{Request::url()}}" data-layout="button" data-size="small" data-mobile-iframe="false"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>
                        </li>
                      </ul>
                      <ul class="post-data">
                        <li><i class="icon-calendar"></i> {{$news->created_at}}</li>
                        <li><i class="icon-comment"></i> <a href="#">{{$news->comment()->count()}} Comments</a></li>
                        <li><i class="icon-tags"></i> <a href="/news/category/{{$news->category->id}}">{{$news->category->category}}</a></li>
                      </ul>
                  </div>
              </div>
          </article>

      <!-- Post Comments
      ================================================== -->
          <section class="comments">
            <h4 class="title-bg"><a name="comments"></a>{{$news->comment()->count()}} Comments so far</h4>
            <!-- Comment Form -->
            {{-- <div class="comment-form-container">
                <h6>Leave a Comment</h6>
                <form action="#" id="comment-form">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-user"></i></span>
                        <input id="prependedInput" size="16" type="text" placeholder="Name">
                    </div>
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-envelope"></i></span>
                        <input id="prependedInput" size="16" type="text" placeholder="Email Address">
                    </div>
                    <textarea class="span6"></textarea>
                    <div class="row">
                        <div class="span2">
                            <input type="submit" class="btn btn-inverse" value="Post My Comment">
                        </div>
                    </div>
                </form>
            </div> --}}
             <ul>
               <li>
                 <form id="addComment" action="/news/{{$news->id}}/add-comment" method="post">
                   {{ csrf_field() }}
                   <span class="comment-name">
                     @if (Sentinel::check())
                       {{Sentinel::getUser()->username}}
                     @else
                       Guest
                     @endif
                      | Leave a Comment
                   </span>
                   <div class="comment-content">
                     <textarea name="comment" rows="5" style="width: 95%;"></textarea>
                   </div>
                   @if (Sentinel::check())
                     <button class="btn btn-inverse" type="button" onclick="document.getElementById('addComment').submit();">Post my comment</button>
                   @else
                     <button class="btn btn-inverse" type="button" onclick="location.href = '/login'">Login and post</button>
                   @endif
                 </form>
               </li>

                @foreach ($newscomment as $key => $value)
                  <li>
                      <img src="{{asset('/images/users/no-image.jpg')}}" alt="{{$value->user->username}}" width="45px" />
                      <span class="comment-name">{{$value->user->username}}</span>
                      <span class="comment-date">{{$value->created_at}}</span>
                      <div class="comment-content">{{$value->comment}}</div>
                  </li>
                @endforeach
             </ul>
          </section><!-- Close comments section-->
          <div class="pagination">
            {{$newscomment->links()}}
          </div>

      </div><!--Close container row-->

      @include('layout.user.sidebar')

    </div>
@endsection

@section('js')
  <div id="fb-root"></div>
  <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10&appId=103079180393054";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
@endsection
