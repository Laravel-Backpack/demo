<!DOCTYPE html>
<html>
<head>
    
    @include('vendor.elfinder.common_scripts')
    @include('vendor.elfinder.common_styles', ['styleBodyElement' => true])

    <!-- elFinder initialization (REQUIRED) -->
    <script type="text/javascript">
        $(document).ready(function () {

            var FileBrowserDialogue = {
                init: function() {
                    // Here goes your code for setting your custom things onLoad.
                },
                mySubmit: function (file) {
                    window.parent.postMessage({
                        mceAction: 'fileSelected',
                        data: {
                            file: file
                        }
                    }, '*');
                }
            };

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
                getFileCallback: function(file) { // editor callback
                    FileBrowserDialogue.mySubmit(file); // pass selected file path to TinyMCE
                },
                height: $(window).height()
            };

            var elf = $('#elfinder').elfinder(elfinderConfig);
            document.getElementById('elfinder').style.opacity = 1;
        });
    </script>
</head>
<body style="margin:0;top:0;left:0;bottom:0;width:100%;height:100%;">

<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>

</body>
</html>
