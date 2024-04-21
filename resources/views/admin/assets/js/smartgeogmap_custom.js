
function copyToClipboard()
{
    let els = document.querySelectorAll('.smartgeogmap_dashicons .dashicons-clipboard');

    if (els) {
        els.forEach((el) => {
            el.addEventListener("click", (event) => {

                event.preventDefault()

                let target = document.querySelector('#' + el.dataset.inputid);

                window.prompt("Copy to clipboard: Ctrl+C, Enter", target.value);
            });
        });
    }
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
    let el = document.querySelector('.smartgeogmap_dashicons .dashicons-welcome-view-site');
    if (el) {
        el.addEventListener("click", (event) => {
            event.preventDefault()

            let target = document.querySelector('#' + el.dataset.inputid);

            target.type = (target.type === 'text') ? 'password' : 'text';
        });
    }
}

window.addEventListener("DOMContentLoaded", (event) => {
    copyToClipboard();
    trySubmitFile();
    addEventListenerToShowGoogleKey();
});
