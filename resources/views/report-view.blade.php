@extends('layouts.app')

@section('header')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.googlemap/1.5.1/jquery.googlemap.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyDZGCoJLniH-3xUOaBlX2aKrkG6KNeRecM"></script>

<script>
        var map,
            searchArea,
            searchAreaMarker,
            searchAreaRadius = 1000, // metres
            north = {!! $data->north !!},
            south = {!! $data->south !!},
            east =  {!! $data->east !!},
            west =  {!! $data->west !!};

        function initMap() {

            var clat = (north + south) / 2;
            var clng = (east + west) / 2;

            var startLatLng = new google.maps.LatLng(clat, clng);

            var singkapan = {!! $singkapan_arr !!};

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
                    north: north,
                    south: south,
                    east: east,
                    west: west
                }
            });

            for( var value in singkapan ){
                console.log("LNG " + singkapan[value].singkapan_lng);
                singkapan[value].marker = new google.maps.Marker({
                    position: new google.maps.LatLng(singkapan[value].singkapan_lat, singkapan[value].singkapan_lng),
                    map: map,
                    title: singkapan[value].singkapan_nama_batuan
                });
                console.log("lat "+singkapan[value].singkapan_lat)
                console.log("lng "+singkapan[value].singkapan_lng)
            }
        }
    </script>
 
@endsection

@section('content')
<div class="container">

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Data Report</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>NAMA : </label>
                            <label>{{ $data->nama }}</label>
                        </div>
                        <div class="form-group">
                            <label>NPM : </label>
                            <label>{{ $data->npm }}</label>
                        </div>
                        <div class="form-group">
                            <label>JUDUL : </label>
                            <label>{{ $data->judul }}</label>
                        </div>
                        <div class="form-group">
                            <label>LOKASI : </label>
                            <label>{{ $data->lokasi }}</label>
                        </div>
                        <div class="form-group">
                            <label>PROVINSI : </label>
                            <label>{{ $data->provinsi }} - {{ $prov->nama }}</label>
                        </div>
                        <div class="form-group">
                            <label>KABUPATEN : </label>
                            <label>{{ $data->kabupaten }} - {{ $kab->nama }}</label>
                        </div>

                        <div class="form-group">
                            <label>KECAMATAN : </label>
                            <label>{{ $data->kecamatan }} - {{ $kec->nama }}</label>
                        </div>

                        <div class="form-group">
                            <label>KOORDINAT : </label>
                        </div>

                        <p><label>Lintang / Latitude / North : {{ $data->north }}</label></p>
                        <p><label>Bujur / Longitude / East : {{ $data->east }}</label></p>
                        <p><label>Lintang / Latitude / South : {{ $data->south }}</label></p>
                        <p><label>Bujur / Longitude / West : {{ $data->west }}</label></p>
                        
                        <table id="club-table" class="table table-striped">
                            <thead>
                            <tr>
                                <th width="30">NO</th>
                                <th>KODE SINGKAPAN</th>
                                <th>NAMA BATUAN</th>
                                <th>JENIS BATUAN</th>
                                <th>LONGITUDE</th>
                                <th>LATITUDE</th>
                                <th>ELEVASI</th>
                                <th>ATTACHMENT</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($singkapan as $sing)
                                <tr>
                                    <td>1</td>
                                    <td>{{ $sing->singkapan_kode }}</td>
                                    <td>{{ $sing->singkapan_nama_batuan }}</td>
                                    <td>{{ $sing->singkapan_jenis_batuan }}</td>
                                    <td>{{ $sing->singkapan_lng }}</td>
                                    <td>{{ $sing->singkapan_lat }}</td>
                                    <td>{{ $sing->singkapan_elevasi }}</td>
                                    <td><a href="/uploads/{{ $sing->singkapan_attach }}">Download {{ $sing->singkapan_attach }}</a></td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <div class="form-group">
                            <div id="map">maps</div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End row -->


</div> <!-- container -->
@endsection

@section('footer')

<script type="text/javascript">

$(document).ready(function() {

    $("#map").height(600);
    initMap();

});
</script>

@endsection