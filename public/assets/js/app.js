document.addEventListener('DOMContentLoaded', () => {
    const flashes = document.querySelectorAll('.flash');

    flashes.forEach((flash) => {
        flash.setAttribute('role', 'status');
    });

    const clickableRows = document.querySelectorAll('[data-href]');

    clickableRows.forEach((row) => {
        row.addEventListener('click', (event) => {
            if (event.target.closest('a, button, input, select, textarea')) {
                return;
            }

            window.location.href = row.dataset.href;
        });
    });
});
