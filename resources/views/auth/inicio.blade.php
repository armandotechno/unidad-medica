@extends('layouts.sidebar')
@section('title', 'Bienvenidos')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/datatables/media/css/dataTables.bootstrap4.css') }}">
@endsection
@section('body')

    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 style="text-align: center; font-weight: bold; font-size: 40px">Bienvenidos al sistema Posta Médica</h3>
        </div>
        <img style="width: 100%; height: 100%;" src="{{ asset('images/background/background-login.jpeg') }}" />
    </div>
@endsection
