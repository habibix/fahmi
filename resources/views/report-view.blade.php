@extends('layout')

@section('head')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.googlemap/1.5.1/jquery.googlemap.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyDZGCoJLniH-3xUOaBlX2aKrkG6KNeRecM"></script>
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 600px;
      }
      
</style>
<script>
  $(document).ready(function() {

    $("#map").height(500);

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 14,

      center: {
        lat: <?php echo ($data->north+$data->south)/2 ?>,
        lng: <?php echo ($data->east+$data->west)/2 ?>
        },
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
        north: <?php echo $data->north ?>,
        south: <?php echo $data->south ?>,
        east: <?php echo $data->east ?>,
        west: <?php echo $data->west ?>
      }
    });
});
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
                                <div id="map"></div>
                            </div>

                            <div class="form-group">
                                <div class="panel-heading">
                                    <h5>Data Singkapan</h5>
                                </div>
                            </div>
                            
                            <table id="club-table" class="table table-striped">
                                <thead>
                                <tr>
                                    <th width="30">ID</th>
                                    <th>NO</th>
                                    <th>KODE SINGKAPAN</th>
                                    <th>NAMA BATUAN</th>
                                    <th>JENIS BATUAN</th>
                                    <th>LONGITUDE</th>
                                    <th>LATITUDE</th>
                                    <th>ELEVASI</th>
                                    <th></th>
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
                                    <tr>
                                      <td width="100%" colspan="8"><div class="map-2">MAP</div></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->


    </div> <!-- container -->
@endsection

@section('scripts')

<script type="text/javascript">
// STATIC-PARENT              on  EVENT    DYNAMIC-CHILD
$(document).ready(function() {

    $("#map").height(500);

    $(".map-2").height(500);
    $(".map-2").googleMap();
      $(".map-2").addMarker({
        coords: [22, 32], // GPS coords
        title : 'TITLE',
        label : 'Label',
        type : 'TERRAIN'
      });
});
</script>
@endsection