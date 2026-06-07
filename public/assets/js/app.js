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

    if (window.anime) {
        anime({
            targets: '.login-ring--one',
            scale: [1, 0.8],
            translateX: [30, -10],
            translateY: [30, -50],
            opacity: [0.16, 0.28],
            direction: 'alternate',
            loop: true,
            duration: 5200,
            easing: 'easeInOutSine',
        });


    }

});
