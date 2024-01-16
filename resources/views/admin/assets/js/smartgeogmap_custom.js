
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

window.addEventListener("DOMContentLoaded", (event) => {
    copyToClipboard();
});
