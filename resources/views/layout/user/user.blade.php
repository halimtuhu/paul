<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Paul's Website</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@yield('meta')

<!-- CSS
================================================== -->
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/user/css/bootstrap.css">
<link rel="stylesheet" href="/user/css/bootstrap-responsive.css">
<link rel="stylesheet" href="/user/css/prettyPhoto.css" />
<link rel="stylesheet" href="/user/css/flexslider.css" />
<link rel="stylesheet" href="/user/css/custom-styles.css">

<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link rel="stylesheet" href="css/style-ie.css"/>
<![endif]-->

<!-- Favicons
================================================== -->
<link rel="shortcut icon" href="/user/img/favicon.ico">
<link rel="apple-touch-icon" href="/user/img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="/user/img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="/user/img/apple-touch-icon-114x114.png">

<!-- JS
================================================== -->
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="/user/js/bootstrap.js"></script>
<script src="/user/js/jquery.prettyPhoto.js"></script>
<script src="/user/js/jquery.flexslider.js"></script>
<script src="/user/js/jquery.custom.js"></script>
<script type="text/javascript">

   $(window).load(function(){

      $('.flexslider').flexslider({
          animation: "slide",
          slideshow: true,
          start: function(slider){
            $('body').removeClass('loading');
          }
      });
  });

</script>


</head>

<body class="home">
    @yield('js')

    <!-- Color Bars (above header)-->
	  <div class="color-bar-1"></div>
    <div class="color-bar-2 color-bg"></div>

    <div class="container">
      @include('layout.user.header')
      @yield('content')
    </div> <!-- End Container -->

    <!-- Footer Area -->

    @include('layout.user.footer');

</body>
</html>
