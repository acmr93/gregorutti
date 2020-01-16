@extends('adm.layouts.master')

@section('title', $empresa->nombre.'| ADMIN')

@section('css')

@endsection

@section('contenido')
    <div class="callout callout-info">
      <h5>Bienvenido {{auth()->user()->name}}</h5>

      <p>Empiece a gestionar.</p>

    </div>
@endsection

@section('js')
@endsection