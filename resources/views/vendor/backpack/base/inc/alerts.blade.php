{{-- Bootstrap Notifications using Prologue Alerts & PNotify JS --}}
@php
  $now = \Carbon\Carbon::now();
  $refreshTime = \Carbon\Carbon::now()->endOfHour();
  $diffTime = $now->diffInMinutes($refreshTime);    
@endphp

<script type="text/javascript">

  // This is intentionaly run after dom loads so this way we can avoid showing duplicate alerts
  // when the user is beeing redirected by persistent table, that happens before this event triggers.
  
  window.addEventListener('DOMContentLoaded', function() {
      //get the php alerts
      var $crudAlerts = JSON.parse('{!! json_encode( \Alert::getMessages() , JSON_HEX_APOS) !!}');
      
      var $diffTime = parseInt('{{ $diffTime }}');

          Noty.overrideDefaults({
              layout   : 'topRight',
              theme    : 'backstrap',
              timeout  : 2500,
              closeWith: ['click', 'button'],
          });
  
  
      for (var type in $crudAlerts) {
          for(var message in $crudAlerts[type]) {
              new Noty({
                      type: type,
                      text: $crudAlerts[type][message]
                  }).show();
          }
      }
      //if the user was redirected by persistent table we get any alerts to show from localstorage
      //as they are not in session anymore but we previously stored them.
      $passedAlerts = JSON.parse(localStorage.getItem('passAlerts'));
  
      if(typeof $passedAlerts === 'object' && $passedAlerts !== null) {
          $passedAlerts.forEach(function($item) {
                  new Noty({
                      type: $item.type,
                      text: $item.text
                  }).show();
          });
      }
@if (app('env') != 'local')
      if ($diffTime < 3) {
        new Noty({
          type: "info",
          text: "<strong>Demo Refresh in {{ $now->diffInMinutes($refreshTime) }} Minutes</strong><br>You'll lose all changes.",
          timeout  : 5000, 
        }).show();
      }

      if ($diffTime > 57) {
        new Noty({
          type: "info",
          text: "<strong>Demo Refreshed {{ 60-$now->diffInMinutes($refreshTime) }} Minutes Ago</strong><br>All custom entries & files have been deleted.",
          timeout  : 5000, 
        }).show();
      }
@endif
      //clear the localstorage alerts
      localStorage.removeItem('passAlerts');
  });
  
  </script>
