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
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 500px;
        width: 100%;
      }
       Optional: Makes the sample page fill the window. 
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <script>
      // This example adds a red rectangle to a map.
      function initMap() {
      	var n = Number(document.getElementsByName('north')[0].value);
      	var s = Number(document.getElementsByName('south')[0].value);
      	var e = Number(document.getElementsByName('east')[0].value);
      	var w = Number(document.getElementsByName('west')[0].value);

      	var clat = (n+s)/2;
      	var clng = (e+w)/2;
      	//var center = (33.685+33.671)/2;

      	console.log(clat);
      	console.log(clng);

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: 33.678, lng: -116.243},
          //center: {lat: clat, lng: clng},
          mapTypeId: 'terrain'
        });

        var rectangle = new google.maps.Rectangle({
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.1,
          map: map,
          bounds: {
          	north: 33.685,
            south: 33.671,
            east: -116.234,
            west: -116.251
            /*north: n,
            south: s,
            east: e,
            west: w*/
          }
        });
      }
    </script>
  </head>
  <body>

  	<div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard - Merpati</div>

                <div class="card-body">
                    
                    <form method="POST" action="http://127.0.0.1:8000/input" >
                        <input name="_token" type="hidden" value="LVQ7fftil5FkHjQGCyqYYUmRwPe94sJCAmUNN20p">
                        <div class="form-group">
                            <input class="form-control" required="required" placeholder="Nama" name="nama" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control" required="required" placeholder="NPM" name="npm" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control" required="required" placeholder="Judul" name="judul" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control" required="required" placeholder="Lokasi" name="lokasi" type="text">
                        </div>
                        <div class="form-group">
                          <label for="sel1">Kecamatan</label>
                          <select class="form-control" id="sel1">
                            <option>1</option>
                            <option>2</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="sel1">Kabupaten</label>
                          <select class="form-control" id="sel1">
                            <option>1</option>
                            <option>2</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="sel1">Provinsi</label>
                          <select class="form-control" id="sel1">
                            <option>1</option>
                            <option>2</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="sel1">Keperluan</label>
                          <select class="form-control" id="sel1">
                            <option value="PGL">PGL</option>
                            <option value="TA">TA</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="sel1">Koordinat Daerah Penelitian</label>
                            <input class="form-control koordinat" required="required" placeholder="North" name="north" type="text">
                            <input class="form-control koordinat" required="required" placeholder="South" name="south" type="text">
                            <input class="form-control koordinat" required="required" placeholder="East" name="east" type="text">
                            <input class="form-control koordinat" required="required" placeholder="West" name="west" type="text">
                            <button class="form-control" onclick="initMap()">CLICK</button>
                        </div>
                        <div class="col-md-8">
                            map disini
                            <div id="map"></div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZGCoJLniH-3xUOaBlX2aKrkG6KNeRecM">
    </script>
  </body>
</html>