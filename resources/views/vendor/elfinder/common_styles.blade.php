        <meta charset="utf-8">
        <title>File Manager</title>

        {{-- elFinder CSS (REQUIRED) --}}
        @bassetArchive('https://github.com/Studio-42/elFinder/archive/refs/tags/2.1.61.zip', 'elfinder-2.1.61')
        @basset('elfinder-2.1.61/elFinder-2.1.61/css/elfinder.min.css')

        {{-- elFinder Backpack Theme --}}
        @basset(base_path('vendor/backpack/filemanager/resources/assets/css/elfinder.backpack.theme.css'))
