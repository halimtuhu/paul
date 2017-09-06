@extends('layout.user.user')
@section('meta')
  <meta property="og:url"                content="{{Request::url()}}" />
  <meta property="og:type"               content="scholarhsip" />
  <meta property="og:title"              content="{{$scholarship->name}}" />
  <meta property="og:description"        content="{{strip_tags(str_limit($scholarship->description, $limit = 200, $end = "..."))}}" />
  <meta property="og:image"              content="{{env('APP_URL') . asset('/images/scholarship/' . $scholarship->featured_image)}}" />
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
              <h3 class="title-bg"><a href="#">{{$scholarship->name}}</a></h3>
              <div class="post-content">
                  @if ($scholarship->featured_image)
                    <center>
                      <a href="#"><img src="{{asset('/images/scholarship/'.$scholarship->featured_image)}}" alt="{{$scholarship->name}}" width="65%"></a>
                    </center>
                  @endif

                  <div class="post-body">
                    <span><strong>Organizer: </strong>{{$scholarship->organizer}}</span><br>
                    <span><strong>Place: </strong>{{$scholarship->place}}</span><br>
                    <span><strong>Deadline: </strong>{{$scholarship->deadline}}</span><br>
                    <hr>
                    <span><strong>Descirption:</strong></span><br>
                    {!!$scholarship->description!!}
                  </div>

                  <div class="post-summary-footer">
                      <ul class="post-data" style="float: left; margin-left: 0px;">
                        @if (Sentinel::check())
                          @if ($scholarship->likes()->where('user_id', Sentinel::getUser()->id)->get()->first())
                            <li><a href="/scholarship/{{$scholarship->id}}/dislike"><i class="icon-thumbs-up"></i> {{$scholarship->likes()->count()}} liked</a></li>
                          @else
                            <li><a href="/scholarship/{{$scholarship->id}}/like"><i class="icon-hand-right"></i> {{$scholarship->likes()->count()}} like</a></li>
                          @endif
                        @else
                          <li><a href="/scholarship/{{$scholarship->id}}/like"><i class="icon-hand-right"></i> {{$scholarship->likes()->count()}} like</a></li>
                        @endif
                        <li>
                          <div class="fb-share-button" data-href="{{Request::url()}}" data-layout="button" data-size="small" data-mobile-iframe="false"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>
                        </li>
                      </ul>
                      <ul class="post-data">
                        <li><i class="icon-calendar"></i> {{$scholarship->created_at}}</li>
                        <li><i class="icon-comment"></i> <a href="#">{{$scholarship->comment()->count()}} Comments</a></li>
                      </ul>
                  </div>
              </div>
          </article>

      <!-- Post Comments
      ================================================== -->
          <section class="comments">
            <h4 class="title-bg"><a name="comments"></a>{{$scholarship->comment()->count()}} Comments so far</h4>
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
                 <form id="addComment" action="/scholarship/{{$scholarship->id}}/add-comment" method="post">
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

                @foreach ($scholarshipcomment as $key => $value)
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
            {{$scholarshipcomment->links()}}
          </div>

      </div><!--Close container row-->

      @include('scholarship.sidebar')

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
