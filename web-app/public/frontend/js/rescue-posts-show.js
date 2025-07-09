function closeImageModal() {
    document.getElementById("imageModal").style.display = "none";
}

function openImageModal() {
    document.getElementById("imageModal").style.display = "block";
}

function closeCommentImageModal() {
    document.getElementById("commentImageModal").style.display = "none";
}

function openCommentImageModal(imageSrc) {
    document.getElementById('commentImageModal').style.display = 'block';
    document.getElementById('commentModalImage').src = imageSrc;
}

// Close modals when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-overlay')) {
        closeImageModal();
        closeCommentImageModal();
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