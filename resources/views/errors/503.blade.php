@extends('errors.layout')

@php
  $error_number = 503;
  $exception_message = isset($exception) ? e($exception->getMessage()) : null;
@endphp

@section('title')
  It's not you, it's me.
@endsection

@section('description')
  @php
    $default_error_message = "The server is overloaded or down for maintenance. Please try again later.";
  @endphp
  {!! $exception_message ?? $default_error_message !!}
@endsection
