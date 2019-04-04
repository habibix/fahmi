@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard - Merpati</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('input.store') }}" >
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
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
                        </div>
                        <div class="col-md-8">
                            map disini
                            <div id="map"></div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection