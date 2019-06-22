@extends('layouts.app')

@section('header')
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    
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
                                @foreach ($data->singkapan as $sing)
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

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End row -->


</div> <!-- container -->
@endsection

@section('footer')
<script type="text/javascript" src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
@endsection