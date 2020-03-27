{{-- Bootstrap Notifications using Prologue Alerts & PNotify JS --}}
<script type="text/javascript">
  Noty.overrideDefaults({
    layout   : 'topRight',
    theme    : 'backstrap',
    timeout  : 2500, 
    closeWith: ['click', 'button'],
  });

  @foreach (\Alert::getMessages() as $type => $messages)

      @foreach ($messages as $message)

        new Noty({
          type: "{{ $type }}",
          text: "{!! str_replace('"', "'", $message) !!}"
        }).show();

      @endforeach
  @endforeach

  @if (app('env') != 'local')
  @php
    $now = \Carbon\Carbon::now();
    $refreshTime = \Carbon\Carbon::now()->endOfHour();

    if ($now->diffInMinutes($refreshTime) < 3) {
      @endphp
        new Noty({
          type: "info",
          text: "<strong>Demo Refresh in {{ $now->diffInMinutes($refreshTime) }} Minutes</strong><br>You'll lose all changes.",
          timeout  : 5000, 
        }).show();
      @php
    }
    if ($now->diffInMinutes($refreshTime) > 57) {
      @endphp
        new Noty({
          type: "info",
          text: "<strong>Demo Refreshed {{ 60-$now->diffInMinutes($refreshTime) }} Minutes Ago</strong><br>All custom entries & files have been deleted.",
          timeout  : 5000, 
        }).show();
      @php
    }
  @endphp
  @endif
</script>