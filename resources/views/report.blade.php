@extends('layout')

@section('content')
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Data List</h4>
                        </div>
                        <div class="panel-body">
                            <table id="club-table" class="table table-striped">
                                <thead>
                                <tr>
                                    <th width="30">ID</th>
                                    <th>NAMA</th>
                                    <th>NPM</th>
                                    <th>JUDUL</th>
                                    <th>KEPERLUAN</th>
                                    <th>TANGGAL</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->npm }}</td>
                                        <td>{{ $data->judul }}</td>
                                        <td>{{ $data->keperluan }}</td>
                                        <td>{{ $data->created_at }}</td>
                                        <th><a href="data/{{ $data->id }}"><button class="btn btn-primary"> View </button></a></th>
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
