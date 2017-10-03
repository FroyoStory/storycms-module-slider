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
    <div id="app">
      @include('cms::layouts.navbar')
      <div class="menu-wrapper fixed">
        @include('cms::layouts.sidebar')
      </div>
      <div class="page-wrapper">
        <div class="page-header">
          <div class="page-header-content">
            <div class="page-title">@yield('title')</div>
            @yield('heading-elements')
          </div>
        </div>
        <div class="container-fluid">

        </div>
        @yield('content')
      </div>
    </div>
    @yield('template')
  @section('js')
    <script>
      var STORY = {
        locale: '<?php echo App::getLocale() ;?>',
        locales: { <?php echo implode(': "", ', config()->get('multilangual.locales'));?>: "" }
      }
    </script>
    <script src="{{ mix('js/backend.js', 'vendor/storycms') }}"></script>
  @show

  <script type="text/javascript">
    var app = new Vue({
      el: '#app',
      data: function () {
        return {
          user: {!! Auth::user() !!}
        }
      }
    })
  </script>

  </body>
</html>
