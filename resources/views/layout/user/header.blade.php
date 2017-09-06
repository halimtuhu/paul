<div class="row header"><!-- Begin Header -->

  <!-- Logo
  ================================================== -->
  <div class="span5 logo">
    <a href="index.htm"><img src="/user/img/piccolo-logo.png" alt="" /></a>
      <h5>Big Things... Small Packages</h5>
  </div>

  <!-- Main Navigation
  ================================================== -->
  <div class="span7 navigation">
      <div class="navbar hidden-phone">

      <ul class="nav">
        <li @if (Request::is('/')) class="active" @endif><a href="/">Home</a></li>
        <li @if (strpos(Request::url(), '/news')) class="active" @endif><a href="/news">News</a></li>
        <li @if (strpos(Request::url(), '/education')) class="active" @endif><a href="/education">Education</a></li>
        <li @if (strpos(Request::url(), '/shop')) class="active" @endif><a href="/shop">Shop</a></li>
        <li @if (strpos(Request::url(), '/forum')) class="active" @endif><a href="/forum">Forum</a></li>
        <li @if (strpos(Request::url(), '/scholarship')) class="active" @endif><a href="/scholarship">Scholarship</a></li>
        <li @if (strpos(Request::url(), '/about')) class="active" @endif><a href="/about">About</a></li>
        @if (Sentinel::check())
          <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="index.htm">Account <b class="caret"></b></a>
              <ul class="dropdown-menu">
                  <li><a href="/account">{{Sentinel::getUser()->username}}</a></li>
                  <li>
                    <form id="logout" action="/logout" method="post" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                    <a href="#" onclick="document.getElementById('logout').submit();">Logout</a>
                  </li>
              </ul>
          </li>
        @else
          <li><a href="/login">Login</a></li>
        @endif
      </ul>

      </div>

      <!-- Mobile Nav
      ================================================== -->
      <form action="#" id="mobile-nav" class="visible-phone">
          <div class="mobile-nav-select">
          <select onchange="window.open(this.options[this.selectedIndex].value,'_top')">
              <option value="">Navigate...</option>
              <option value="index.htm">Home</option>
                  <option value="index.htm">- Full Page</option>
                  <option value="index-gallery.htm">- Gallery Only</option>
                  <option value="index-slider.htm">- Slider Only</option>
              <option value="features.htm">Features</option>
              <option value="page-full-width.htm">Pages</option>
                  <option value="page-full-width.htm">- Full Width</option>
                  <option value="page-right-sidebar.htm">- Right Sidebar</option>
                  <option value="page-left-sidebar.htm">- Left Sidebar</option>
                  <option value="page-double-sidebar.htm">- Double Sidebar</option>
              <option value="gallery-4col.htm">Gallery</option>
                  <option value="gallery-3col.htm">- 3 Column</option>
                  <option value="gallery-4col.htm">- 4 Column</option>
                  <option value="gallery-6col.htm">- 6 Column</option>
                  <option value="gallery-4col-circle.htm">- Gallery 4 Col Round</option>
                  <option value="gallery-single.htm">- Gallery Single</option>
              <option value="blog-style1.htm">Blog</option>
                  <option value="blog-style1.htm">- Blog Style 1</option>
                  <option value="blog-style2.htm">- Blog Style 2</option>
                  <option value="blog-style3.htm">- Blog Style 3</option>
                  <option value="blog-style4.htm">- Blog Style 4</option>
                  <option value="blog-single.htm">- Blog Single</option>
              <option value="page-contact.htm">Contact</option>
          </select>
          </div>
          </form>

  </div>

</div><!-- End Header -->
