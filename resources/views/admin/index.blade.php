@extends('adminlte::page')

@section('title', 'Tipo de cambio')

@section('content_header')
    <h1>Inicio</h1>
   @stop

@section('content')
    <p>Aqui podrá adminitrar los tipos de cambio de moneda.</p>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    {{--  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">  --}}


@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="{{ asset('js/app.js') }}"></script>
    {{--  <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>  --}}
@stop
