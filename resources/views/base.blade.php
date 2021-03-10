<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Library</title>
    @php
      $i=0; $tot = 0;
      // GET LAST SEGMENT URL
      $urlArray = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      $segments = explode('/', $urlArray);
      $numSegments = count($segments);
      $target = $segments[$numSegments - 1];
    @endphp
    @if($target === 'member')
      <link rel="icon" type="image/png" href="{{ asset('login/images/icons/favicon.ico') }}"/>
      <!--===============================================================================================-->
          <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/bootstrap/css/bootstrap.min.css') }}">
      <!--===============================================================================================-->
          <link rel="stylesheet" type="text/css" href="{{ asset('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
      <!--===============================================================================================-->
          <link rel="stylesheet" type="text/css" href="{{ asset('login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
      <!--===============================================================================================-->
          <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/animate/animate.css') }}">
      <!--===============================================================================================-->	
          <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/css-hamburgers/hamburgers.min.css') }}">
      <!--===============================================================================================-->
          <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/animsition/css/animsition.min.css') }}">
      <!--===============================================================================================-->
          <!-- <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/select2/select2.min.css') }}"> -->
      <!--===============================================================================================-->	
          <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/daterangepicker/daterangepicker.css') }}">
      <!--===============================================================================================-->
          <link rel="stylesheet" type="text/css" href="{{ asset('login/css/util.css') }}">
          <link rel="stylesheet" type="text/css" href="{{ asset('login/css/main.css') }}">
    @else
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.4.1/flatly/bootstrap.min.css">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/font.css') }}">
      <link rel="stylesheet" href="{{ asset('css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('css/styleplus.css') }}">
      <link href="https://cdn.jsdelivr.net/lightgallery/1.3.9/css/lightgallery.min.css" rel="stylesheet">
    @endif
    <style>
        body{
            overflow: overlay;
        }
        /* width */
        ::-webkit-scrollbar {
        width: 6px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: transparent; 
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #C4C4C4; 
            border-radius: 8px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #888; 
        }
    </style>
</head>

<body>
    <div id="app">
    </div>

  
    <script src="{{ asset('login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>

  @if($target === 'member')
  <!--===============================================================================================-->
      <script src="{{ asset('login/vendor/animsition/js/animsition.min.js') }}"></script>
  <!--===============================================================================================-->
      <script src="{{ asset('login/vendor/bootstrap/js/popper.js') }}"></script>
      <script src="{{ asset('login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <!--===============================================================================================-->
      <!-- <script src="{{ asset('login/cvendor/select2/select2.min.js') }}"></script> -->
  <!--===============================================================================================-->
      <script src="{{ asset('login/vendor/daterangepicker/moment.min.js') }}"></script>
      <script src="{{ asset('login/vendor/daterangepicker/daterangepicker.js') }}"></script>
  <!--===============================================================================================-->
      <script src="{{ asset('login/vendor/countdowntime/countdowntime.js') }}"></script>
  <!--===============================================================================================-->
      <script src="{{ asset('login/js/main.js') }}"></script>
  @else
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="{{ asset('login/vendor/bootstrap/js/popper.js') }}"></script>
    <script>
        $( document ).ready(function() {
            var toggler = document.getElementsByClassName("caret");
            var i;

            for (i = 0; i < toggler.length; i++) {
                toggler[i].addEventListener("click", function() {
                    this.parentElement.querySelector(".nested").classList.toggle("activet");
                    this.classList.toggle("caret-down");
                });
            }
        });
       
    </script>
  @endif
  
</body>
</html>
