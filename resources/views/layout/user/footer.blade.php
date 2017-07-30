<style media="screen">
  .imagess {
    display: block;
    width: 60px;
    height: 60px;
    margin: 0px;
  }
  .imagess img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
</style>
<div class="footer-container"><!-- Begin Footer -->
    <div class="container">
        <div class="row footer-row">
              <div class="span3 footer-col">
                  <h5>About Us</h5>
                 <img src="/user/img/piccolo-footer-logo.png" alt="Piccolo" /><br /><br />
                  <address>
                      <strong>Design Team</strong><br />
                      123 Main St, Suite 500<br />
                      New York, NY 12345<br />
                  </address>
                  <ul class="social-icons">
                      <li><a href="#" class="social-icon facebook"></a></li>
                      <li><a href="#" class="social-icon twitter"></a></li>
                      <li><a href="#" class="social-icon dribble"></a></li>
                      <li><a href="#" class="social-icon rss"></a></li>
                      <li><a href="#" class="social-icon forrst"></a></li>
                  </ul>
              </div>
              <div class="span3 footer-col">
                  <h5>Latest Comments</h5>
                  <ul>
                      @foreach (\App\NewsComment::orderBy('created_at', 'desc')->limit('3')->get() as $key => $value)
                        <li><a href="/news/{{$value->news->id}}">{{$value->user->username}}</a> {{$value->comment}}</li>
                      @endforeach
                  </ul>
              </div>
              <div class="span3 footer-col">
                  <h5>Latest Posts</h5>
                   <ul class="post-list">
                      @foreach (\App\News::orderBy('created_at', 'desc')->limit('5')->get() as $key => $value)
                        <li><a href="/news/{{$value->id}}">{{$value->title}}</a></li>
                      @endforeach
                  </ul>
              </div>
              <div class="span3 footer-col">
                  <h5>Flickr Photos</h5>
                  <ul class="img-feed">
                    @foreach (\App\News::orderBy('created_at', 'desc')->limit('12')->get() as $key => $value)
                      <li><a class="imagess" href="/news/{{$value->id}}"><img src="{{asset('/images/news/'.$value->featured_image)}}" alt="Image Feed" width="60px"></a></li>
                    @endforeach
                  </ul>
              </div>
          </div>

          <div class="row"><!-- Begin Sub Footer -->
              <div class="span12 footer-col footer-sub">
                  <div class="row no-margin">
                      <div class="span6"><span class="left">Copyright 2017 Piccolo Theme edited by <a href="mailto:halimtuhuprasetyo@gmail.com?subject=PaulsWebsiteFeedback">Halim Tuhu Praseyto</a>. All rights reserved.</span></div>
                      <div class="span6">
                          <span class="right">
                            <a href="/">Home</a> | <a href="/news">News</a> | <a href="/education">Education</a> | <a href="/shop">Shop</a> | <a href="/forum">Forum</a> | <a href="/about">About</a>
                          </span>
                      </div>
                  </div>
              </div>
          </div><!-- End Sub Footer -->

      </div>
  </div><!-- End Footer -->

  <!-- Scroll to Top -->
  <div id="toTop" class="hidden-phone hidden-tablet">Back to Top</div>
