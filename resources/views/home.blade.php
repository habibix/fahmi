@extends('layouts.app')

@section('header')
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Data Input Mahasiswa</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                      <table class="table table-striped" id="myTable">
                        <thead>
                          <tr>
                            <th>NO</th>
                            <th>Nama</th>
                            <th>NPM</th>
                            <th>Judul</th>
                            <th>Lokasi</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach($input as $key => $data)
                                <tr>
                                    <th>{{ ++$key }}</th>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->npm }}</td>
                                    <td>{{ $data->judul }}</td>
                                    <td>{{ $data->lokasi }}</td>
                                    <th>
                                        <a href="{{ url('home') }}/view/{{ $data->id }}" type="button" class="btn btn-success">View</a>
                                        <a href="{{ url('home') }}/delete/{{ $data->id }}" type="button" class="btn btn-danger">Delete</a>
                                    </th>
                                </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Data File Attachment</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                      <table class="table table-striped" id="myTable2">
                        <thead>
                          <tr>
                            <th>NO</th>
                            <th>Kode Singkapan</th>
                            <th>Jenis Batuan</th>
                            <th>Nama Batuan</th>
                            <th>Attachment</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach($singkapan as $key => $data)
                                <tr>
                                    <th>{{ ++$key }}</th>
                                    <td>{{ $data->singkapan_kode }}</td>
                                    <td>{{ $data->singkapan_jenis_batuan }}</td>
                                    <td>{{ $data->singkapan_nama_batuan }}</td>
                                    <td>{{ $data->singkapan_attach }}</td>
                                    <td><a href="{{ url('uploads') }}/{{ $data->singkapan_attach }}">Download</a></td>
                                </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('footer')
<script type="text/javascript" src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(document).ready( function () {
        $('#myTable').DataTable();
        $('#myTable2').DataTable();
    } );
</script>
@endsection