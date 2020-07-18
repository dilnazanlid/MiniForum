<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <title>@yield('title')</title>
        <style media="screen">
        a{
          color:white;
        }
        a:hover{
          color:orange;
          text-decoration: none;
          cursor: pointer;
        }
        a:focus{
          outline:none;
        }
        </style>
    </head>
    <body>
      <div class="flex py-4 justify-between items-center nav" style="background-color: #1d1d1f;">
        <a class="mx-4 font-bold text-xl" href="/">Talkative</a>
        <nav class="">
          <a class="pr-4" href="/">Home</a>
          <a class="pr-4" href="{{ route('all_posts') }}">Posts</a>
          @if(Cookie::get('auth') !== null)
            <a class="pr-4" href="{{route('dashboard')}}">Dashboard</a>
            <a class="pr-4" href="{{route('logout')}}">Logout</a>
          @else
            <a class="pr-4" href="{{route('login_page')}}">Login</a>
          @endif
        </nav>
      </div>
      @yield('content')
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      <script type="text/javascript">
        var token = '{{Session::token()}}';
        var urlLike = '{{route('like')}}';
      </script>
      <script src="{{asset('/js/like.js')}}"></script>
    </body>
</html>
