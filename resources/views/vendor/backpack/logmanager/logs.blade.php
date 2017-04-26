@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::logmanager.log_manager') }}<small>{{ trans('backpack::logmanager.log_manager_description') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix'),'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/log') }}">{{ trans('backpack::logmanager.log_manager') }}</a></li>
        <li class="active">{{ trans('backpack::logmanager.existing_logs') }}</li>
      </ol>
    </section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
      <table class="table table-hover table-condensed">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ trans('backpack::logmanager.date') }}</th>
            <th>{{ trans('backpack::logmanager.last_modified') }}</th>
            <th class="text-right">{{ trans('backpack::logmanager.file_size') }}</th>
            <th>{{ trans('backpack::logmanager.actions') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($logs as $k => $log)
          <tr>
            <th scope="row">{{ $k+1 }}</th>
            <td>{{ \Carbon\Carbon::createFromTimeStamp($log['last_modified'])->formatLocalized('%d %B %Y') }}</td>
            <td>{{ \Carbon\Carbon::createFromTimeStamp($log['last_modified'])->formatLocalized('%H:%M') }}</td>
            <td class="text-right">{{ round((int)$log['file_size']/1048576, 2).' MB' }}</td>
            <td>
                <a class="btn btn-xs btn-default" href="{{ url(config('backpack.base.route_prefix', 'admin').'/log/preview/'.$log['file_name']) }}"><i class="fa fa-eye"></i> {{ trans('backpack::logmanager.preview') }}</a>
                <a class="btn btn-xs btn-default" href="{{ url(config('backpack.base.route_prefix', 'admin').'/log/download/'.$log['file_name']) }}"><i class="fa fa-cloud-download"></i> {{ trans('backpack::logmanager.download') }}</a>
                <a class="btn btn-xs btn-danger" data-button-type="delete" href="{{ url(config('backpack.base.route_prefix', 'admin').'/log/delete/'.$log['file_name']) }}"><i class="fa fa-trash-o"></i> {{ trans('backpack::logmanager.delete') }}</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
<script>
  jQuery(document).ready(function($) {

    // capture the delete button
    $("[data-button-type=delete]").click(function(e) {
        e.preventDefault();
        var delete_button = $(this);
        var delete_url = $(this).attr('href');

        if (confirm("{{ trans('backpack::logmanager.delete_confirm') }}") == true) {
            $.ajax({
                url: delete_url,
                type: 'DELETE',
                data: {
                  _token: "<?php echo csrf_token(); ?>"
                },
                success: function(result) {
                    // delete the row from the table
                    delete_button.parentsUntil('tr').parent().remove();

                    // Show an alert with the result
                    new PNotify({
                        title: "{{ trans('backpack::logmanager.delete_confirmation_title') }}",
                        text: "{{ trans('backpack::logmanager.delete_confirmation_message') }}",
                        type: "success"
                    });
                },
                error: function(result) {
                    // Show an alert with the result
                    new PNotify({
                        title: "{{ trans('backpack::logmanager.delete_error_title') }}",
                        text: "{{ trans('backpack::logmanager.delete_error_message') }}",
                        type: "warning"
                    });
                }
            });
        } else {
            new PNotify({
                title: "{{ trans('backpack::logmanager.delete_cancel_title') }}",
                text: "{{ trans('backpack::logmanager.delete_cancel_message') }}",
                type: "info"
            });
        }
      });

  });
</script>
@endsection
