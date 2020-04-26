<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        
        @include('vendor.elfinder.common_scripts')
        @include('vendor.elfinder.common_styles')

        <!-- TinyMCE Popup class (REQUIRED) -->
        <script type="text/javascript" src="{{ asset($dir.'/js/tiny_mce_popup.js') }}"></script>

        <script type="text/javascript">
            var FileBrowserDialogue = {
                init: function() {
                    // Here goes your code for setting your custom things onLoad.
                },
                mySubmit: function (URL) {
                    var win = tinyMCEPopup.getWindowArg('window');

                    // pass selected file path to TinyMCE
                    win.document.getElementById(tinyMCEPopup.getWindowArg('input')).value = URL;

                    // are we an image browser?
                    if (typeof(win.ImageDialog) != 'undefined') {
                        // update image dimensions
                        if (win.ImageDialog.getImageData) {
                            win.ImageDialog.getImageData();
                        }
                        // update preview if necessary
                        if (win.ImageDialog.showPreviewImage) {
                            win.ImageDialog.showPreviewImage(URL);
                        }
                    }

                    // close popup window
                    tinyMCEPopup.close();
                }
            }

            tinyMCEPopup.onInit.add(FileBrowserDialogue.init, FileBrowserDialogue);

            $().ready(function() {
                var elf = $('#elfinder').elfinder({
                    // set your elFinder options here
                    @if($locale)
                        lang: '{{ $locale }}', // locale
                    @endif
                    customData: { 
                        _token: '{{ csrf_token() }}'
                    },
                    url : '{{ route("elfinder.connector") }}',  // connector URL
                    soundPath: '{{ asset($dir.'/sounds') }}',
                    getFileCallback: function(file) { // editor callback
                        FileBrowserDialogue.mySubmit(file.url); // pass selected file path to TinyMCE
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
