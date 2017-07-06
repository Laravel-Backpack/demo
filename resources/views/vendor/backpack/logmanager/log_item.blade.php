@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    {{ trans('backpack::logmanager.log_manager') }}<small>{{ trans('backpack::logmanager.log_manager_description') }}</small>
	  </h1>
	  <ol class="breadcrumb">
      <li><a href="{{ url(config('backpack.base.route_prefix'),'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/log') }}">{{ trans('backpack::logmanager.log_manager') }}</a></li>
      <li class="active">{{ trans('backpack::logmanager.preview') }}</li>
	  </ol>
	</section>
@endsection

@section('content')

  <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/log') }}"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::logmanager.back_to_all_logs') }}</a><br><br>
<!-- Default box -->
  <div class="box">
    <div class="box-body">
      <h3>{{ \Carbon\Carbon::createFromTimeStamp($log['last_modified'])->formatLocalized('%d %B %Y') }}:</h3>
      <pre>
        <code>
          {{ $log['content'] }}
        </code>
      </pre>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/styles/default.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/highlight.min.js"></script>
  <script>hljs.initHighlightingOnLoad();</script>
@endsection
