@extends('layouts.sidebar')
@section('title', 'Historial Médico')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

@endsection
@section('body')
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3>Gestión de consultas médicas</h3>
        </div>
    </div>
@endsection
