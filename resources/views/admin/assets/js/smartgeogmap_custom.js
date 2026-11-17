
function copyToClipboard()
{
    let buttons = document.querySelectorAll('.smartgeogmap_dashicons.copy-to-clipboard');

    buttons.forEach((button) => {
        button.addEventListener("click", (event) => {

            event.preventDefault()

            let target = document.querySelector('#' + button.dataset.inputid);

            // The Clipboard API is only available in secure contexts (HTTPS or localhost)
            if (!navigator.clipboard) {
                window.prompt("Copy to clipboard: Ctrl+C, Enter", target.value);
                return;
            }

            navigator.clipboard.writeText(target.value).then(() => {
                let icon = button.querySelector('.dashicons');
                let title = button.title;

                icon.classList.replace('dashicons-clipboard', 'dashicons-yes');
                button.title = 'Copied!';

                setTimeout(() => {
                    icon.classList.replace('dashicons-yes', 'dashicons-clipboard');
                    button.title = title;
                }, 1500);
            }).catch(() => {
                window.prompt("Copy to clipboard: Ctrl+C, Enter", target.value);
            });
        });
    });
}

function trySubmitFile()
{
    let smartGeoGMapGeoJSONFiles = document.getElementById("smartgeogmap_geojson_files");

    if(!smartGeoGMapGeoJSONFiles) {
        return;
    }

    smartGeoGMapGeoJSONFiles.addEventListener("change", function(event) {
        if (this.files.length > this.dataset.maxGeojsonAllowed) {
            alert('You are only allowed to upload a maximum of ' + this.dataset.maxGeojsonAllowed + ' files at a time');
            this.value = null;
            event.preventDefault()
        }
    });
}

function addEventListenerToShowGoogleKey()
{
    let button = document.querySelector('.smartgeogmap_dashicons.show-google_key');
    if (button) {
        button.addEventListener("click", (event) => {
            event.preventDefault()

            let target = document.querySelector('#' + button.dataset.inputid);
            let icon = button.querySelector('.dashicons');

            target.type = (target.type === 'text') ? 'password' : 'text';

            icon.classList.toggle('dashicons-visibility', target.type === 'password');
            icon.classList.toggle('dashicons-hidden', target.type === 'text');
        });
    }
}

window.addEventListener("DOMContentLoaded", (event) => {
    copyToClipboard();
    trySubmitFile();
    addEventListenerToShowGoogleKey();
});
