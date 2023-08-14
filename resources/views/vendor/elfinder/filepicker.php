<!DOCTYPE html>
<html lang="<?= app()->getLocale() ?>">
    <head>
        <meta charset="utf-8">
        <title>elFinder 2.0</title>

        <!-- jQuery and jQuery UI (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/themes/smoothness/jquery-ui.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

        <!-- elFinder CSS (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="<?= asset($dir.'/css/elfinder.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= asset($dir.'/css/theme.css') ?>">

        <!-- elFinder JS (REQUIRED) -->
        <script src="<?= asset($dir.'/js/elfinder.min.js') ?>"></script>

        <?php if ($locale) { ?>
            <!-- elFinder translation (OPTIONAL) -->
            <script src="<?= asset($dir."/js/i18n/elfinder.$locale.js") ?>"></script>
        <?php } ?>
        <!-- Include jQuery, jQuery UI, elFinder (REQUIRED) -->

        <script type="text/javascript">
            $().ready(function () {
                var theme = 'default';

                var elf = $('#elfinder').elfinder({
                    // set your elFinder options here
                    <?php if ($locale) { ?>
                        lang: '<?= $locale ?>', // locale
                    <?php } ?>
                    customData: {
                        _token: '<?= csrf_token() ?>'
                    },
                    url: '<?= route('elfinder.connector') ?>',  // connector URL
                    soundPath: '<?= asset($dir.'/sounds') ?>',
                    resizable: false,
                    ui: ['toolbar', 'path','stat'],
                    onlyMimes: [<?= $mimeTypes ?>],
                    rememberLastDir : false,
                    height: 300,
                    defaultView: 'list',
                    getFileCallback: function (file) {
                        window.parent.processSelectedFile(file, '<?= $input_id?>');
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
