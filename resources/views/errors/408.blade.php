@extends('errors.layout')

@php
  $error_number = 408;
  $exception_message = isset($exception) ? e($exception->getMessage()) : null;
@endphp

@section('title')
  Request timeout.
@endsection

@section('description')
  @php
    $default_error_message = "Please <a href='javascript:history.back()''>go back</a>, refresh the page and tru again.";
  @endphp
  {!! $exception_message ?? $default_error_message !!}
@endsection
