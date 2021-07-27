@extends('adminlte::page')

@section('title', 'Tipo de cambio')

@section('content_header')
    <h1>Inicio</h1>
   @stop

@section('content')
    <p>Aqui podrá adminitrar los tipos de cambio de moneda.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="{{ asset('js/app.js') }}"></script>
@stop
