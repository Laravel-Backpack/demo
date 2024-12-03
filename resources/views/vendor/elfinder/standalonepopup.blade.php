<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        
        @include('vendor.elfinder.common_scripts')
        @include('vendor.elfinder.common_styles', ['styleBodyElement' => true])
        <style type="text/css">
        .elfinder-workzone {
            min-height: max-content !important;
        }

        #elfinder {
            height: 100% !important;
            width: 100% !important;
            top:0;
            left: 0;
        }
        </style>

        <script type="text/javascript">
            $(document).ready(function () {
                let elfinderConfig = {
                    cssAutoLoad : false,
                    speed: 100,
                    // set your elFinder options here
                    @if($locale)
                        lang: '{{ $locale }}', // locale
                    @endif
                    customData: { 
                        _token: '{{ csrf_token() }}'
                    },
                    url: '{{ route("elfinder.connector") }}',  // connector URL
                    soundPath: '{{ Basset::getUrl(base_path("vendor/studio-42/elfinder/sounds")) }}',
                    resizable: false,
                    onlyMimes: @json(unserialize(urldecode(request('mimes'))), JSON_UNESCAPED_SLASHES),
                    commandsOptions: {
                        getfile: {
                            multiple: {{ request('multiple') ? 'true' : 'false' }},
                            oncomplete: 'destroy'
                        }
                    },
                    getFileCallback: (file) => {
                        @if (request()->has('multiple') && request()->input('multiple') == 1)
                            window.parent.processSelectedMultipleFiles(file, '{{ $input_id  }}');
                        @else
                            window.parent.processSelectedFile(file.path, '{{ $input_id  }}');
                        @endif
                        window.parent.jQuery.colorbox.close();
                    },                    
                };
                let elfinderOptions = window.parent.elfinderOptions ?? {};
                var elf = $('#elfinder').elfinder({...elfinderConfig, ...elfinderOptions}).elfinder('instance');

                document.getElementById('elfinder').style.opacity = 1;   
            });          
        </script>
    </head>
    <body style="margin:0;position:absolute;top:0;left:0;width:100%;height:100%;">

        <!-- Element where elFinder will be created (REQUIRED) -->
        <div id="elfinder" style="position:absolute;top:0;left:0;width:100%;height:100%;"></div>
    </body>
</html>
