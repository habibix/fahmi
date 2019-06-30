@extends('layouts.app')

@section('header')
<!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.googlemap/1.5.1/jquery.googlemap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyDZGCoJLniH-3xUOaBlX2aKrkG6KNeRecM"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 2;
            $("#addButton").click(function() {
                if (counter > 10) {
                    alert("Only 10 textboxes allow");
                    return false;
                }

                var newTextBoxDiv = $(document.createElement('div'))
                    .attr("id", "isi-singkapan-" + counter);

                newTextBoxDiv.after().html('<div id="input-grup" class="form-group row"><div class="col-xs-4"> <input name="kode_singkapan[]" type="text" class="form-control" placeholder="Kode Singkapan"></div><div class="col-xs-4"> <input name="nama_batuan[]" type="text" class="form-control" placeholder="Nama Batuan"></div><div class="col-xs-4"><select name="jenis_batuan[]" class="form-control"><option value="Batuan Sedimen">Batuan Sedimen</option><option value="Batuan Beku">Batuan Beku</option><option value="Batuan Metamorf">Batuan Metamorf</option><option value="Batuan Piroklastik">Batuan Piroklastik</option> </select></div></div><div class="form-group row lng"><div class="col-xs-4"> <input id="longitude-' + counter + '" name="longitude[]" type="text" class="form-control" placeholder="Longitude"></div><div class="col-xs-4"> <input id="latitude-' + counter + '" name="latitude[]" type="text" class="form-control" placeholder="Latitude"></div><div class="col-xs-4"> <input name="elevasi[]" type="text" class="form-control" placeholder="Elevasi"></div></div><div class="form-group row"><div class="col-xs-12"> <input name="attach[]" type="file" class="form-control"></div></div>');

                newTextBoxDiv.appendTo("#singkapan");
                counter++;
            });

            $("#removeButton").click(function() {
                if (counter == 1) {
                    alert("No more textbox to remove");
                    return false;
                }
                counter--;

                $("#isi-singkapan" + counter).remove();

            });
        });
    </script>
    <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        
        @media (min-width: 992px) .col-md-1,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-10,
        .col-md-11,
        .col-md-12 {
            float: none !important;
        }
        
        /*#map {
            height: 700px;
            width: 100%;
            background: #eee;
        }*/
        
        .map-button {
            margin-top: 10px;
            padding: 20px;
            cursor: default;
            background: #000;
            color: #fff;
            width: 150px;
            text-align: center;
        }
        
        Optional: Makes the sample page fill the window. html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <script type="text/javascript">
        

        var map,
            searchArea,
            searchAreaMarker,
            searchAreaRadius = 1000, // metres
            north = 33.685,
            south = 33.671,
            east = -116.234,
            west = -116.251;

        function initMap() {

            $("#map").css('width', '100%').css('height', '700');

            var n = Number(document.getElementsByName('north')[0].value);
            var s = Number(document.getElementsByName('south')[0].value);
            var e = Number(document.getElementsByName('east')[0].value);
            var w = Number(document.getElementsByName('west')[0].value);

            if(n == "" || s == "" || e == "" || w == ""){
              alert("Koordinat Daerah Penelitian tidak boleh kosong");
              return false;
            }

            var clat = (n + s) / 2;
            var clng = (e + w) / 2;

            var startLatLng = new google.maps.LatLng(clat, clng);

            var lng = $('input[name^=longitude]').map(function(idx, elem) {
              return $(elem).val();
            }).get();

            var lat = $('input[name^=latitude]').map(function(idx, elem) {
              return $(elem).val();
            }).get();

            var title = $('input[name^=nama_batuan]').map(function(idx, elem) {
              return $(elem).val();
            }).get();

            console.log(lng);
            console.log(lat);

            map = new google.maps.Map(document.getElementById('map'), {
                center: startLatLng,
                zoom: 14
            });

            searchArea = new google.maps.Rectangle({
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35,
                center: startLatLng,
                map: map,
                bounds: {
                    north: n,
                    south: s,
                    east: e,
                    west: w
                }
            });

            for (var i = 0; i < lng.length; i++) {
              if(lng[i] == "" || lat[i] == "" || title[i] == ""){
                alert("Koordinat Singkapan dan nama batuan tidak boleh kosong");
                return false;
              }
                lng[i].marker = new google.maps.Marker({
                    position: new google.maps.LatLng(lat[i], lng[i]),
                    map: map,
                    title: title[i]
                });

                console.log("hai");
            }
        }

        //google.maps.event.addDomListener(window, 'load', initMap);
    </script>

    <script>
        // This example adds a red rectangle to a map.
        function initaMap() {
            var n = Number(document.getElementsByName('north')[0].value);
            var s = Number(document.getElementsByName('south')[0].value);
            var e = Number(document.getElementsByName('east')[0].value);
            var w = Number(document.getElementsByName('west')[0].value);

            var clat = (n + s) / 2;
            var clng = (e + w) / 2;
            //var center = (33.685+33.671)/2;

            console.log(clat);
            console.log(clng);

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: {
                    lat: 33.678,
                    lng: -116.243
                },
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

            var myLatLng = {
                lat: 33.685,
                lng: 33.671
            };
            /*var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 14,
              center: myLatLng
            });*/

            new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Hello World!'
            });

        }
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="col-md-8 center-block">
            <div class="card">
                <div class="card-header"></div>
           
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card-body">

                    <form method="POST" action="{{ route('input.store') }}" enctype="multipart/form-data">

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
                            <label for="sel1">Singkapan</label>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <i id="addButton" style="cursor: pointer; position:absolute; top:0px; right: -450px" class="fa fa-plus-circle fa-5x text-success"></i>
                                <i id="removeButton" style="cursor: pointer; position:absolute; top:70px; right: -450px" class="fa fa-minus-circle fa-5x text-danger"></i>

                            </div>
                        </div>

                        <div id="singkapan">
                            <div id="isi-singkapan-1">
                                <div id="input-grup" class="form-group row">
                                    <div class="col-xs-4">
                                        <input name="kode_singkapan[]" type="text" class="form-control" placeholder="Kode Singkapan" value="{{ old('kode_singkapan') }}">
                                    </div>
                                    <div class="col-xs-4">
                                        <input name="nama_batuan[]" type="text" class="form-control" placeholder="Nama Batuan">
                                    </div>
                                    <div class="col-xs-4">
                                        
                                        <select name="jenis_batuan[]" class="form-control">
                                            <option value="Batuan Sedimen">Batuan Sedimen</option>
                                            <option value="Batuan Beku">Batuan Beku</option>
                                            <option value="Batuan Metamorf">Batuan Metamorf</option>
                                            <option value="Batuan Piroklastik">Batuan Piroklastik</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row lng">
                                    <div class="col-xs-4">
                                        <input id="longitude-1" name="longitude[]" type="text" class="form-control" placeholder="Longitude">
                                    </div>
                                    <div class="col-xs-4">
                                        <input id="latitude-1" name="latitude[]" type="text" class="form-control" placeholder="Latitude">
                                    </div>
                                    <div class="col-xs-4">
                                        <input name="elevasi[]" type="text" class="form-control" placeholder="Elevasi">
                                    </div>

                                </div>
                                <div class="form-group row">

                                    <div class="col-xs-12">
                                        <input name="attach[]" type="file" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div id="map-1" style="width: 100%"></div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-control btn btn-success" onclick="initMap()">View Map</div>
                        </div>

                        <div class="form-group">
                            <div id="map"></div>
                        </div>

                        <div class="form-group">
                            <input class="form-control btn btn-primary" type="submit" name="submit" value="SAVE">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        // STATIC-PARENT              on  EVENT    DYNAMIC-CHILD
        $('#singkapan').on('click', '#viewMap', function() {

            //var lng = $(this).find('#longitude');
            var v = $(this).attr("idx");
            var vlng = $("#longitude-" + v).val();
            var vlat = $("#latitude-" + v).val();
            //alert(v);

            /*$("#isi-singkapan-"+v).append('<div class="form-group"><input class="form-control btn btn-primary" type="submit" name="submit" value="SAVE"></div>');*/
            console.log(vlng + vlat);

            $('#map-' + v).height(400);
            $("#map-" + v).googleMap();
            $("#map-" + v).addMarker({
                coords: [vlng, vlat], // GPS coords
                title: 'TITLE',
                label: 'Label',
                type: 'TERRAIN'
            });
        });
    </script>

    <script type="text/javascript">
        $("select[name='provinsi']").change(function() {
            var id_kab = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "<?php echo route('select-kab') ?>",
                method: 'POST',
                data: {
                    id_kab: id_kab,
                    _token: token
                },
                success: function(data) {
                    $("select[name='kabupaten'").html('');
                    $("select[name='kabupaten'").html(data.options);
                }
            });
        });
    </script>

    <script type="text/javascript">
        $("select[name='kabupaten']").change(function() {
            var id_kec = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "<?php echo route('select-kec') ?>",
                method: 'POST',
                data: {
                    id_kec: id_kec,
                    _token: token
                },
                success: function(data) {
                    $("select[name='kecamatan'").html('');
                    $("select[name='kecamatan'").html(data.options);
                }
            });
        });
    </script>
@endsection