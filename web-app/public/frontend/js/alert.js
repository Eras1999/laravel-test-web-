function showAlert(type, title, message, redirectUrl = null) {
    // Create overlay
    let overlay = document.querySelector('.alert-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'alert-overlay';
        document.body.appendChild(overlay);
    }

    // Create alert container
    let alertBox = document.querySelector('.custom-alert');
    if (!alertBox) {
        alertBox = document.createElement('div');
        alertBox.className = 'custom-alert';
        document.body.appendChild(alertBox);
    }

    // Set alert content
    alertBox.className = `custom-alert ${type}`;
    alertBox.innerHTML = `
        <div class="icon"><i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i></div>
        <div class="title">${title}</div>
        <div class="message">${message}</div>
        <button class="btn">OK</button>
    `;

    // Show overlay and alert
    overlay.classList.add('show');
    alertBox.classList.add('show');

    // Handle close on button click
    const btn = alertBox.querySelector('.btn');
    btn.addEventListener('click', () => {
        overlay.classList.remove('show');
        alertBox.classList.remove('show');
        if (redirectUrl) {
            window.location.href = redirectUrl;
        }
    });

    // Close on overlay click
    overlay.addEventListener('click', () => {
        overlay.classList.remove('show');
        alertBox.classList.remove('show');
        if (redirectUrl) {
            window.location.href = redirectUrl;
        }
    });
}