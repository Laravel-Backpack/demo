@extends('errors.layout')

@php
	$error_number = 500;
    $exception_message = isset($exception) ? e($exception->getMessage()) : null;
@endphp

@section('title')
	It's not you, it's me.
@endsection

@section('description')
	@php
	  $default_error_message = "An internal server error has occurred. If the error persists please contact the development team.";
	@endphp
	{!! $exception_message ?? $default_error_message !!}
@endsection
