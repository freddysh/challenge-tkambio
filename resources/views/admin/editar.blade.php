@extends('adminlte::page')

@section('title', 'Tipo de cambio')

@section('content_header')
<h2>Listado de tipo de cambio</h2>
@stop

@section('content')
<div id="app">
    <tipo-cambio-editar-component></tipo-cambio-editar-component>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}


@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    {{--  <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>  --}}
@stop
