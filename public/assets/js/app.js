document.addEventListener('DOMContentLoaded', () => {
    const flashes = document.querySelectorAll('.flash');

    flashes.forEach((flash) => {
        flash.setAttribute('role', 'status');
    });
});
