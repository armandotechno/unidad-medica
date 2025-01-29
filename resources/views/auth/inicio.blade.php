@extends('layouts.sidebar')
@section('title', 'Hola')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/datatables/media/css/dataTables.bootstrap4.css') }}">
@endsection
@section('body')

<h3>Estás logueado</h3>

<form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: inline;">
    @csrf
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-power-off"></i>
        Salir
    </a>
</form>
@endsection
