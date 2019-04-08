@extends('layout')

@section('head')
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 600px;
      }
      
</style>
<script>
      // This example adds a red rectangle to a map.
function initMap() {
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
                            <h4>Data Report</h4>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->


    </div> <!-- container -->
@endsection

@section('scripts')
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZGCoJLniH-3xUOaBlX2aKrkG6KNeRecM&callback=initMap">
</script>
@endsection