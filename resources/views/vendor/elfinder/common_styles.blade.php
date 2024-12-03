<meta charset="utf-8">
<title>File Manager</title>
{{-- elFinder CSS (REQUIRED) --}}
@php
    $themeStylesheetVersion = '3.0.0';
@endphp
@bassetArchive('https://github.com/Studio-42/elFinder/archive/refs/tags/2.1.64.tar.gz', 'elfinder-2.1.64')
@basset('elfinder-2.1.64/elFinder-2.1.64/css/elfinder.min.css')
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@'.$themeStylesheetVersion.'/Material/css/theme.min.css')
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@'.$themeStylesheetVersion.'/Material/images/loading.svg', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@'.$themeStylesheetVersion.'/Material/font/material.eot', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@'.$themeStylesheetVersion.'/Material/font/material.svg', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@'.$themeStylesheetVersion.'/Material/images/icons-big.svg', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@'.$themeStylesheetVersion.'/Material/images/icons-small.svg', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@'.$themeStylesheetVersion.'/Material/font/material.woff', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@'.$themeStylesheetVersion.'/Material/font/material.ttf', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@'.$themeStylesheetVersion.'/Material/font/material.woff2', false)

@bassetBlock('elfinderThemeSwitcherScript.js')
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    function getElfinderStyleSheet(main = true) {
        let themeStylesheetVersion = '{{$themeStylesheetVersion}}';
        const regex =  new RegExp(main ? `RobiNN1\/elFinder-Material-Theme@${themeStylesheetVersion}\/Material\/css\/theme\.min\.css` : `RobiNN1\/elFinder-Material-Theme@${themeStylesheetVersion}\/Material\/css\/theme-gray\.min\.css`);
        const linkElements = document.querySelectorAll('link[rel="stylesheet"]');
        // Find the main elfinder stylesheet
        let selectedLinkElement;
        for (const linkElement of linkElements) {
            if (regex.test(linkElement.href)) {
                selectedLinkElement = linkElement;
                break;
            }
        }
        return selectedLinkElement;
    }

    function addElfinderLightStylesheet() {
        let themeLightAsset = `{{ Basset::basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@'.$themeStylesheetVersion.'/Material/css/theme-gray.min.css') }}`;
        const match = themeLightAsset.match(/<link\s+href="([^"]+)"/i);
        if (match && match.length > 1) {
            let mainStyleSheet = getElfinderStyleSheet();
            let lightStyleSheet = getElfinderStyleSheet(false);
            // if found append the light mode css to the main theme stylesheet
            if (mainStyleSheet && ! lightStyleSheet) {
                let themeLight = document.createElement('link');
                themeLight.href = match[1];
                themeLight.rel = 'stylesheet';
                themeLight.type = 'text/css';
                mainStyleSheet.insertAdjacentElement('afterend', themeLight);
            }
        }
    }

    let colorMode = window.parent.colorMode?.result ?? window.colorMode?.result ?? false;
   
    if(colorMode !== 'dark') {
        addElfinderLightStylesheet();
    }

    // register a color mode change event so that we remove
    // the light stylesheet when the color mode change
    if(colorMode) {
        let colorModeClass = window.parent.colorMode ?? window.colorMode;
        colorModeClass.onChange(function(scheme) {
            let getMainStylesheet = scheme === 'dark' ? false : true;
            let selectedLinkElement = getElfinderStyleSheet(getMainStylesheet);

            if (! selectedLinkElement) {
                return true;
            }
            // in case we switched to dark mode, remove the ligth theme css
            if(scheme === 'dark') {
                selectedLinkElement.parentNode.removeChild(selectedLinkElement);
                return true; 
            }
            addElfinderLightStylesheet()
        });
    }

    // we dont want to style the body when elfinder is loaded as a component in a backpack view
    // we pass true when loading elfinder inside an iframe to style the iframe body.
    @if($styleBodyElement ?? false) 
        // use the topbar and footbar darker color as the background to ease transitions
        document.getElementsByTagName('body')[0].style.background = '#061325';
        document.getElementsByTagName('body')[0].style.opacity = 1;
    @endif
});
</script>
@endBassetBlock
