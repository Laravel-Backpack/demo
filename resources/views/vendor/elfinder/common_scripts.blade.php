        {{-- jQuery (REQUIRED) --}}
        @if (!isset ($jquery) || (isset($jquery) && $jquery == true))
        @basset('https://unpkg.com/jquery@3.6.4/dist/jquery.min.js')
        @endif

        {{-- jQuery UI and Smoothness theme --}}
        @bassetArchive('https://github.com/jquery/jquery-ui/archive/refs/tags/1.13.2.tar.gz', 'jquery-ui-1.13.2')
        @basset('jquery-ui-1.13.2/jquery-ui-1.13.2/dist/themes/smoothness/jquery-ui.min.css')
        @basset('jquery-ui-1.13.2/jquery-ui-1.13.2/dist/jquery-ui.min.js')

        {{-- elFinder JS (REQUIRED) --}}
        @bassetArchive('https://github.com/Studio-42/elFinder/archive/refs/tags/2.1.61.tar.gz', 'elfinder-2.1.61')
        @basset('elfinder-2.1.61/elFinder-2.1.61/js/elfinder.min.js')

        {{-- elFinder translation (OPTIONAL) --}}
        @if($locale)
        @basset('https://cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.61/js/i18n/elfinder.'.$locale.'.min.js')
        @endif

        {{-- elFinder sounds --}}
        @basset(base_path('vendor/studio-42/elfinder/sounds/rm.wav'))
