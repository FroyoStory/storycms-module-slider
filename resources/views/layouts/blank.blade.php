<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') Story CMS</title>
    <link rel="stylesheet" type="text/css" href="{{ mix('css/backend.css', 'vendor/storycms') }}">
    @yield('css')
  </head>
  <body>
    <div class="" id="app">
      @yield('content')
    </div>

    @yield('template')

    @section('js')
      <script src="{{ mix('js/backend.js', 'vendor/storycms') }}"></script>
    @show

    <script type="text/javascript">
      var app = new Vue({
        el: '#app',
        data: function () {
          return {
            message: ''
          }
        }
      })
    </script>
  </body>
</html>
