<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        
        @include('vendor.elfinder.common_scripts')
        @include('vendor.elfinder.common_styles')

        <script type="text/javascript">
            $().ready(function () {
                var elf = $('#elfinder').elfinder({
                    // set your elFinder options here
                    @if($locale)
                        lang: '{{ $locale }}', // locale
                    @endif
                    customData: { 
                        _token: '{{ csrf_token() }}'
                    },
                    url: '{{ route("elfinder.connector") }}',  // connector URL
                    soundPath: '{{ asset($dir.'/sounds') }}',
                    dialog: {width: 900, modal: true, title: 'Select a file'},
                    resizable: false,
                    onlyMimes: @json(unserialize(urldecode(request('mimes')))),
                    commandsOptions: {
                        getfile: {
                            multiple: {{ request('multiple') ? 'true' : 'false' }},
                            oncomplete: 'destroy'
                        }
                    },
                    getFileCallback: function (file) {
                        @if (request()->has('multiple') && request()->input('multiple') == 1)
                            window.parent.processSelectedMultipleFiles(file, '{{ $input_id  }}');
                        @else
                            window.parent.processSelectedFile(file.path, '{{ $input_id  }}');
                        @endif

                        parent.jQuery.colorbox.close();
                    }
                }).elfinder('instance');
            });
        </script>

    </head>
    <body>

        <!-- Element where elFinder will be created (REQUIRED) -->
        <div id="elfinder"></div>

    </body>
</html>
