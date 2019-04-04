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
                            <input class="form-control" required="required" placeholder="Nama" name="nama" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control" required="required" placeholder="Nama" name="nama" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control" required="required" placeholder="Nama" name="nama" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control" required="required" placeholder="Nama" name="nama" type="text">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection