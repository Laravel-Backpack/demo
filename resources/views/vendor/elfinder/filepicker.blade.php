<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        
        @include('vendor.elfinder.common_scripts')
        @include('vendor.elfinder.common_styles')
        
        <script type="text/javascript">
            $().ready(function () {
                var theme = 'default';

                var elf = $('#elfinder').elfinder({
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
                    ui: ['toolbar', 'path','stat'],
                    onlyMimes: [{{ $mimeTypes }}],
                    rememberLastDir : false,
                    height: 300,
                    defaultView: 'list',
                    getFileCallback: function (file) {
                        window.parent.processSelectedFile(file, '{{ $input_id }}');
                        console.log(file);
                    },
                    uiOptions : {
                        // toolbar configuration
                        toolbar : [
                            ['home', 'up'],
                            ['upload'],
                            ['quicklook'],
                        ],
                        // directories tree options
                        tree : {
                            // expand current root on init
                            openRootOnLoad : true,
                            // auto load current dir parents
                            syncTree : true
                        },
                        // navbar options
                        navbar : {
                            minWidth : 150,
                            maxWidth : 500
                        },
                        // current working directory options
                        cwd : {
                            // display parent directory in listing as ".."
                            oldSchool : false
                        }
                    },
                    themes: {
                        default : 'https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme/manifests/material-gray.json',
                        dark : 'https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme/manifests/material-default.json',
                    },
                    theme: theme
                },
                function(fm, extraObj) {
                    fm.bind('open', function() {
                        setElFinderColorMode();
                    });
                }).elfinder('instance');

                function isElfinderInDarkMode() {
                    return typeof window.parent?.colorMode !== 'undefined' && window.parent.colorMode.result === 'dark';
                }

                function setElFinderColorMode() {
                    theme = isElfinderInDarkMode() ? 'dark' : 'default';

                    let instance = $('#elfinder').elfinder('instance');
                    instance.changeTheme(theme).storage('theme', theme);
                }
            });
        </script>
    </head>
    <body style="margin: 0;">

        <!-- Element where elFinder will be created (REQUIRED) -->
        <div id="elfinder"></div>

    </body>
</html>
