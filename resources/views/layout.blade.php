<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>

      // This example adds a red rectangle to a map.
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: 33.678, lng: -116.243},
          mapTypeId: 'terrain'
        });

        var rectangle = new google.maps.Rectangle({
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35,
          map: map,
          bounds: {
            north: 33.685,
            south: 33.671,
            east: -116.234,
            west: -116.251
          }
        });
      }
    </script>
</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZGCoJLniH-3xUOaBlX2aKrkG6KNeRecM&callback=initMap">
    </script>
    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{ asset('js/jquery.mask.min.js')}}"></script>
    <!-- <script type="text/javascript">
        $(document).ready(function(){
          $('.koordinat').mask('00/00/0000');
        });
    </script> -->
    <script>
    $( ".koordinat" )
      .change(function () {
        var north = $( "input[name*='north']" ).val();
        var south = $( "input[name*='south']" ).val();
        var east = $( "input[name*='east']" ).val();
        var west = $( "input[name*='west']" ).val();
        console.log('your message ' + north + south + east + west);
      })
    </script>
</body>
</html>