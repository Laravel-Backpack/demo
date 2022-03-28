@extends('errors.layout')

@php
  $error_number = 400;
  $exception_message = isset($exception) ? e($exception->getMessage()) : null;
@endphp

@section('title')
  Bad request.
@endsection

@section('description')
  @php
    $default_error_message = "Please <a href='javascript:history.back()''>go back</a> or return to <a href='".url('')."'>our homepage</a>.";
  @endphp
  {!! $exception_message ?? $default_error_message !!}
@endsection
