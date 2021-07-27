@extends('adminlte::page')

@section('title', 'Tipo de cambio')

@section('content_header')
<h2>Listado de tipo de cambio</h2>
@stop

@section('content')
    <tipo-cambio-editar-component></tipo-cambio-editar-component>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('./css/app.css') }}"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    {{-- <script src="{{ asset('./js/app.js') }}"></script> --}}
@stop
