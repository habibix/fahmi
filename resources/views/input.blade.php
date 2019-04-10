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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
          var counter = 2;
          $("#addButton").click(function() {
              if (counter > 10) {
                  alert("Only 10 textboxes allow");
                  return false;
              }
              
              var newTextBoxDiv = $(document.createElement('div'))
                  .attr("id", 'isi-singkapan' + counter);
              
              newTextBoxDiv.after().html('<div id="input-grup" class="form-group row"> <div class="col-xs-4"> <input name="kode_singkapan[]" type="text" class="form-control" placeholder="Kode Singkapan"> </div><div class="col-xs-4"> <input name="nama_batuan[]" type="text" class="form-control" placeholder="Nama Batuan"> </div><div class="col-xs-4"> <input name="jenis_batuan[]" type="text" class="form-control" placeholder="Jenis Batuan"> </div></div><div class="form-group row"> <div class="col-xs-4"> <input name="longitude[]" type="text" class="form-control" placeholder="Longitude"> </div><div class="col-xs-4"> <input name="latitude[]" type="text" class="form-control" placeholder="Latitude"> </div><div class="col-xs-4"> <input name="elevasi[]" type="text" class="form-control" placeholder="Elevasi"> </div></div><div class="form-group row"> <div class="col-xs-4"> <input name="attach[]" type="file" class="form-control"> </div><div class="col-xs-8"> <input class="btn btn-success col-xs-12" type="button" value="View Map" id="viewMap"> </div></div>'
                  );
              
              newTextBoxDiv.appendTo("#singkapan");
              counter++;
          });

          $("#removeButton").click(function() {
              if (counter == 1) {
                  alert("No more textbox to remove");
                  return false;
              }
              counter--;

              $("#TextBoxDiv" + counter).remove();

          });
      });
    </script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */

       @media (min-width: 992px)
.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
    float: none !important;
}
      #map {
        height: 700px;
        width: 100%;
        background: #eee;
      }

      .map-button {
        margin-top: 10px;
        padding: 20px;
        cursor: default;
        background: #000;
        color: #fff;
        width: 150px;
        text-align: center;
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
          zoom: 14,
          //center: {lat: 33.678, lng: -116.243},
          center: {lat: clat, lng: clng},
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
            /*north: 33.685,
            south: 33.671,
            east: -116.234,
            west: -116.251*/
            north: n,
            south: s,
            east: e,
            west: w
          }
        });
      }
    </script>
  </head>
  <body>
    <div class="container">
    <div class="col-md-8 center-block">
            <div class="card">
                <div class="card-header">INPUT DATA</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="text-success">{{ Session::get('success') }}</div>
                @endif
                <div class="card-body">
                    
                    <form method="POST" action="{{ route('input.store') }}" enctype="multipart/form-data" >
                      
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <input class="form-control" placeholder="Nama" name="nama" type="text" value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="NPM" name="npm" type="text" value="{{ old('npm') }}">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Judul" name="judul" type="text" value="{{ old('judul') }}">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Lokasi" name="lokasi" type="text" value="{{ old('lokasi') }}">
                        </div>
                        <div class="form-group">
                          <label for="sel1">Provinsi</label>
                          <select name="provinsi" class="form-control" id="sel1">
                            <option value=""> -- Select Provinsi -- </option>
                            @foreach ($provs as $prov)
                                <option value="{{ $prov->kode }}">{{ $prov->nama }}</option>
                            @endforeach
                          </select>
                        </div>
                        
                        <div class="form-group">
                          <label for="sel1">Kabupaten</label>
                          <select name="kabupaten" class="form-control" id="sel1">
                            <option value=""> -- Select Kabupaten -- </option>
                            
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="sel1">Kecamatan</label>
                          <select name="kecamatan" class="form-control" id="sel1">
                            <option value=""> -- Select Kecamatan -- </option>
                          </select>
                        </div>
                        
                        <div class="form-group">
                          <label for="sel1">Keperluan</label>
                          <select name="keperluan" class="form-control" id="sel1">
                            <option value="PGL">PGL</option>
                            <option value="TA">TA</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="sel1">Koordinat Daerah Penelitian</label>
                        </div>

                          <div class="form-group row">
                            <div class="col-xs-6">
                              <input name="north" type="text" class="form-control koordinat" placeholder="Lintang / Latitude / North" value="{{ old('north') }}">
                            </div>

                            <div class="col-xs-6">
                              <input name="east" type="text" class="form-control koordinat" placeholder="Bujur / Longitude / East" value="{{ old('east') }}">
                            </div>
                          </div>
                        
                        <div class="form-group row">
                            <div class="col-xs-6">
                              <input name="south" type="text" class="form-control koordinat" placeholder="Lintang / Latitude / South" value="{{ old('south') }}">
                            </div>
                            <div class="col-xs-6">
                              <input name="west" type="text" class="form-control koordinat" placeholder="Bujur / Longitude / West" value="{{ old('west') }}">
                            </div>
                          </div>

                        <div class="form-group">
                          <div class="form-control btn btn-success" onclick="initMap()">View Map</div>
                        </div>

                        <div class="form-group">
                          <div id="map"></div>
                        </div>

<div id="singkapan">
  <div id="isi-singkapan">
                        <div id="input-grup" class="form-group row">
                          <div class="col-xs-4">
                              <input name="kode_singkapan[]" type="text" class="form-control" placeholder="Kode Singkapan">
                          </div>
                          <div class="col-xs-4">
                            <input name="nama_batuan[]" type="text" class="form-control" placeholder="Nama Batuan">
                          </div>
                          <div class="col-xs-4">
                              <input name="jenis_batuan[]" type="text" class="form-control" placeholder="Jenis Batuan">
                          </div>
                          
                          
                        </div>

                        <div class="form-group row">
                          <div class="col-xs-4">
                            <input name="longitude[]" type="text" class="form-control" placeholder="Longitude">
                          </div>
                          <div class="col-xs-4">
                            <input name="latitude[]" type="text" class="form-control" placeholder="Latitude">
                          </div>
                          <div class="col-xs-4">
                            <input name="elevasi[]" type="text" class="form-control" placeholder="Elevasi">
                          </div>
                          
                        </div>

                        <div class="form-group row">
                            
                          <div class="col-xs-4">
                            <input name="attach[]" type="file" class="form-control">
                          </div>
                          <div class="col-xs-8">
                            <input class="btn btn-success col-xs-12" type="button" value="View Map" id="viewMap">
                          </div>
                        </div>
  </div>
</div>
                        <div class="form-group row">
                          <div class="col-xs-6">
                            <input class="btn btn-success col-xs-12" type="button" value='Add Data' id='addButton'>
                          </div>
                          <div class="col-xs-6">
                            <input class="btn btn-danger col-xs-12" type="button" value="Remove Data" id='removeButton'>
                          </div>
                        </div>

                        <div class="form-group">
                          <input class="form-control btn btn-primary" type="submit" name="submit" value="SAVE">
                        </div>
                      
                    </form>

                </div>
            </div>
        </div>
      </div>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZGCoJLniH-3xUOaBlX2aKrkG6KNeRecM">
    </script>
    <script type="text/javascript">
      $("select[name='provinsi']").change(function(){
          var id_kab = $(this).val();
          var token = $("input[name='_token']").val();
          $.ajax({
              url: "<?php echo route('select-kab') ?>",
              method: 'POST',
              data: {id_kab:id_kab, _token:token},
              success: function(data) {
                $("select[name='kabupaten'").html('');
                $("select[name='kabupaten'").html(data.options);
              }
          });
      });
    </script>

    <script type="text/javascript">
      $("select[name='kabupaten']").change(function(){
          var id_kec = $(this).val();
          var token = $("input[name='_token']").val();
          $.ajax({
              url: "<?php echo route('select-kec') ?>",
              method: 'POST',
              data: {id_kec:id_kec, _token:token},
              success: function(data) {
                $("select[name='kecamatan'").html('');
                $("select[name='kecamatan'").html(data.options);
              }
          });
      });
    </script>
  </body>
</html>