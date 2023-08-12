<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
   
        @vite('resources/css/app.css')
        @vite('resources/assets/vendor/bootstrap/css/bootstrap.min.css')
        @vite('resources/assets/vendor/bootstrap-icons/bootstrap-icons.css')
        @vite('resources/assets/vendor/boxicons/css/boxicons.min.css')
        <!-- Styles -->
        
    </head>
    <body class="antialiased">
         <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="/" class="logo d-flex align-items-center">
    <img src="assets/img/logo.png" alt="">
    <span class="d-none d-lg-block">Stock App</span>
  </a>
 
</div><!-- End Logo -->
 

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
      </a>
    </li><!-- End Search Icon-->

    <li class="nav-item dropdown">



    </li><!-- End Notification Nav -->

 
    <li class="nav-item dropdown pe-3">

 

      
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->
        <div id="app"></div>
        @vite('resources/js/app.js')
    </body>
</html>
