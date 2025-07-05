
function closeMapPopup() {
    if (map) {
        map.remove();
        map = null;
    }
    document.getElementById("mapModal").style.display = "none";
}

function openImageModal() {
    document.getElementById("imageModal").style.display = "block";
}

function closeImageModal() {
    document.getElementById("imageModal").style.display = "none";
}

function confirmDeleteComment() {
    return confirm('Are you sure you want to delete this comment?');
}

// Close modals when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-overlay')) {
        closeMapPopup();
        closeImageModal();
    }
});

// Add smooth scrolling to comments when form is submitted
document.querySelector('.comment-form').addEventListener('submit', function() {
    setTimeout(() => {
        document.querySelector('.comments-section').scrollIntoView({ 
            behavior: 'smooth' 
        });
    }, 100);
});