@extends('frontend.layouts.master')

@section('content')
<main class="rescue-detail-page">
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Rescue Mission Details</h1>
            <p class="hero-subtitle">Every animal deserves a second chance</p>
        </div>
    </div>

    <section class="rescue-detail-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="rescue-detail-card">
                        <div class="image-container">
                            @if ($rescuePost->image)
                                <img src="{{ asset('storage/' . $rescuePost->image) }}" alt="Rescue Image" class="rescue-detail-image">
                                <div class="image-overlay">
                                    <button class="zoom-btn" onclick="openImageModal()">
                                        <i class="fas fa-expand"></i>
                                    </button>
                                </div>
                            @else
                                <div class="rescue-placeholder">
                                    <i class="fas fa-paw"></i>
                                    <p>No image available</p>
                                </div>
                            @endif
                        </div>

                        <div class="action-container">
                            @if ($rescuePost->rescued)
                                <span class="status-badge rescued">
                                    <i class="fas fa-heart"></i> Successfully Rescued
                                </span>
                            @else
                                <span class="status-badge urgent">
                                    <i class="fas fa-exclamation-circle"></i> Needs Help
                                </span>
                            @endif
                            <a href="#" id="whatsapp-share-btn" class="btn-share" aria-label="Share this rescue post on WhatsApp" target="_blank">
                                <i class="fab fa-whatsapp"></i> Share
                            </a>
                            <button id="download-image-btn" class="btn-download" aria-label="Download this rescue post as an image">
                                <i class="fas fa-download"></i> Download Image
                            </button>
                        </div>

                        <div class="rescue-info-grid">
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Reported by</span>
                                    <span class="info-value">{{ $rescuePost->author_name }}</span>
                                </div>
                            </div>

                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-paw"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Animal Type</span>
                                    <span class="info-value">{{ $rescuePost->animal_type }}</span>
                                </div>
                            </div>

                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-heartbeat"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Health Status</span>
                                    <span class="info-value status-{{ strtolower(str_replace(' ', '-', $rescuePost->healthy_status)) }}">
                                        {{ $rescuePost->healthy_status }}
                                    </span>
                                </div>
                            </div>

                            <div class="info-card location-card">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Location</span>
                                    <span class="info-value">{{ $rescuePost->place ?? 'N/A' }}, {{ $rescuePost->district }}</span>
                                    <div class="location-actions">
                                        @if ($rescuePost->latitude && $rescuePost->longitude)
                                            <a href="https://www.google.com/maps?q={{ $rescuePost->latitude }},{{ $rescuePost->longitude }}" 
                                               class="btn-directions" target="_blank" aria-label="Get directions to {{ $rescuePost->place ?? 'rescue location' }}">
                                                <i class="fas fa-directions"></i> Get Directions
                                            </a>
                                        @else
                                            <span class="text-muted">No coordinates available</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Contact Number</span>
                                    <span class="info-value">{{ $rescuePost->contact_number ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="description-section">
                            <h3><i class="fas fa-file-alt"></i> Description</h3>
                            <p class="description-text">{{ $rescuePost->description }}</p>
                        </div>

                        <!-- Image Modal -->
                        <div id="imageModal" class="modal-overlay">
                            <div class="image-modal-content">
                                <button class="close-btn" onclick="closeImageModal()">
                                    <i class="fas fa-times"></i>
                                </button>
                                @if ($rescuePost->image)
                                    <img src="{{ asset('storage/' . $rescuePost->image) }}" alt="Rescue Image" class="modal-image">
                                @endif
                            </div>
                        </div>

                        <!-- Comments Section -->
                        <div class="comments-section">
                            <div class="comments-header">
                                <h3><i class="fas fa-comments"></i> Community Comments</h3>
                                <span class="comment-count">{{ count($comments) }} comments</span>
                            </div>
                            
                            <div class="comments-list">
                                @forelse ($comments as $index => $comment)
                                    <div class="comment-item">
                                        <div class="comment-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-header">
                                                <span class="comment-author">{{ $comment['user_name'] }}</span>
                                                @if ($comment['user_name'] === $rescuePost->author_name)
                                                    <span class="badge badge-reported">Reported by</span>
                                                @endif
                                                <div class="comment-meta">
                                                    <span class="comment-time">{{ $comment['created_at']->format('d M Y H:i') }}</span>
                                                    @if (Auth::guard('frontend')->check() && isset($comment['user_id']) && $comment['user_id'] === Auth::guard('frontend')->user()->id)
                                                        <form action="{{ route('rescue-posts.delete-comment', ['id' => $rescuePost->id, 'commentIndex' => $index]) }}" method="POST" class="delete-comment-form" id="delete-comment-form-{{ $index }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="delete-comment-btn" data-comment-index="{{ $index }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="comment-text">{{ $comment['comment'] }}</p>
                                            @if (isset($comment['image']) && $comment['image'])
                                                <div class="comment-image-container">
                                                    <img src="{{ asset('storage/' . $comment['image']) }}" alt="Comment Image" class="comment-image">
                                                    <div class="image-overlay">
                                                        <button class="zoom-btn" onclick="openCommentImageModal('{{ asset('storage/' . $comment['image']) }}')">
                                                            <i class="fas fa-expand"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="no-comments">
                                        <i class="fas fa-comment-slash"></i>
                                        <p>No comments yet. Be the first to share your thoughts!</p>
                                    </div>
                                @endforelse
                            </div>

                            <form action="{{ route('rescue-posts.comment', $rescuePost->id) }}" method="POST" class="comment-form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <textarea name="comment" class="comment-input" rows="3" 
                                              placeholder="Share your thoughts or offer help..." required></textarea>
                                    <input type="file" name="comment_image" class="form-control modern-input" accept="image/*">
                                    @error('comment_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-paper-plane"></i> Post Comment
                                </button><br>
                                <a href="{{ session()->has('_from_profile') ? route('profile') : route('rescue-posts.index') }}" class="btn back-btn">Back</a>
                            </form>

                            <!-- Comment Image Modal -->
                            <div id="commentImageModal" class="modal-overlay">
                                <div class="image-modal-content">
                                    <button class="close-btn" onclick="closeCommentImageModal()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <img id="commentModalImage" src="" alt="Comment Image" class="modal-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/rescue-posts-show.css') }}">

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('frontend/js/rescue-posts-show.js') }}"></script>
<script>
// WhatsApp Share Button
document.addEventListener('DOMContentLoaded', function() {
    const shareBtn = document.getElementById('whatsapp-share-btn');
    const postUrl = "{{ route('rescue-posts.show', $rescuePost->id) }}";
    const animalType = "{{ $rescuePost->animal_type }}";
    const location = "{{ $rescuePost->place ?? 'N/A' }}, {{ $rescuePost->district }}";
    const healthStatus = "{{ $rescuePost->healthy_status }}";
    const contact = "{{ $rescuePost->contact_number ?? 'N/A' }}";
    const description = "{{ Str::limit($rescuePost->description, 100) }}";
    const mapsUrl = "{{ $rescuePost->latitude && $rescuePost->longitude ? 'https://www.google.com/maps?q=' . $rescuePost->latitude . ',' . $rescuePost->longitude : 'N/A' }}";
    const shareText = encodeURIComponent(
        `🚨 URGENT RESCUE ALERT 🚨\n\n` +
        `🐾 ${animalType} needs immediate help!\n` +
        `📍 Location: ${location}\n` +
        `🏥 Condition: ${healthStatus}\n` +
        `📞 Contact: ${contact}\n` +
        `📝 Details: ${description}\n` +
        `${mapsUrl !== 'N/A' ? `🗺 Location: ${mapsUrl}\n` : ''}` +
        `📱 Full Post: ${postUrl}\n\n` +
        `Please share to help save this animal! 🙏\n` +
        `#SaveSathwa #AnimalRescue #SriLanka`
    );
    shareBtn.href = `https://api.whatsapp.com/send?text=${shareText}`;
});

// Enhanced Download Image Button - Updated for better clarity and spacing
document.addEventListener('DOMContentLoaded', function () {
    const downloadBtn = document.getElementById('download-image-btn');

    downloadBtn.addEventListener('click', async function () {
        const postImageUrl = "{{ $rescuePost->image ? asset('storage/' . $rescuePost->image) : '' }}";
        const animalType = "{{ $rescuePost->animal_type }}";
        const location = "{{ $rescuePost->place ?? 'N/A' }}, {{ $rescuePost->district }}";
        const healthStatus = "{{ $rescuePost->healthy_status }}";
        const contact = "{{ $rescuePost->contact_number ?? 'N/A' }}";
        const description = "{{ $rescuePost->description }}";
        // const author = "{{ $rescuePost->author_name }}"; // Reporter name removed
        const postUrl = "{{ route('rescue-posts.show', $rescuePost->id) }}";

        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = 700; // Standard width for social media sharing
        canvas.height = 1000; // Increased height to accommodate more content

        // Create gradient background (purple to blue)
        const gradient = ctx.createLinearGradient(0, 0, 0, canvas.height);
        gradient.addColorStop(0, '#8B5CF6'); // Purple
        gradient.addColorStop(1, '#6366F1'); // Blue
        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Header section - SaveSathwa.com
        ctx.fillStyle = '#ffffff';
        ctx.font = 'bold 38px Arial';
        ctx.textAlign = 'center';
        ctx.fillText('SaveSathwa.com', canvas.width / 2, 60);

        ctx.font = '20px Arial';
        ctx.fillText('Animal Rescue Platform', canvas.width / 2, 90);

        // White content card with more space
        const cardX = 40;
        const cardY = 130;
        const cardWidth = canvas.width - 80;
        const cardHeight = 840; // Increased card height
        const cardRadius = 20; // Rounded corners

        // Draw white rounded rectangle
        ctx.fillStyle = '#ffffff';
        ctx.beginPath();
        ctx.roundRect(cardX, cardY, cardWidth, cardHeight, cardRadius);
        ctx.fill();

        // Add subtle shadow (apply only once for the card)
        ctx.shadowColor = 'rgba(0, 0, 0, 0.15)';
        ctx.shadowBlur = 15;
        ctx.shadowOffsetX = 0;
        ctx.shadowOffsetY = 8;
        ctx.fill(); // Re-fill to apply shadow properly after path is closed

        // Reset shadow for subsequent drawing operations
        ctx.shadowColor = 'transparent';
        ctx.shadowBlur = 0;
        ctx.shadowOffsetX = 0;
        ctx.shadowOffsetY = 0;

        // Function to draw all text content
        function drawTextContent(startYForText) {
            let currentY = startYForText;
            const leftMargin = cardX + 50; // Increased left margin for content
            const contentWidth = cardWidth - 100; // Adjusted content width
            const lineHeight = 28; // Consistent line height

            // Section Header: URGENT RESCUE ALERT
            ctx.fillStyle = '#DC2626'; // Red color
            ctx.font = 'bold 30px Arial';
            ctx.textAlign = 'center';
            ctx.fillText('🚨 URGENT RESCUE ALERT 🚨', canvas.width / 2, currentY);
            currentY += 45; // Space after alert

            // Animal type
            ctx.fillStyle = '#EF4444'; // Slightly lighter red
            ctx.font = 'bold 24px Arial';
            ctx.fillText(`${animalType} needs immediate help!`, canvas.width / 2, currentY);
            currentY += 60; // More space before details

            ctx.textAlign = 'left'; // Align subsequent text to the left

            // Helper for labeled sections with icons
            function drawLabel(label, value, icon) {
                ctx.fillStyle = '#1F2937'; // Dark gray for labels
                ctx.font = 'bold 18px Arial';
                ctx.fillText(`${icon} ${label}`, leftMargin, currentY);
                currentY += 5; // Small gap between label and value

                ctx.font = '17px Arial';
                ctx.fillStyle = '#374151'; // Medium gray for values
                // Wrap text and update Y position
                const linesDrawn = wrapText(ctx, value, leftMargin + 25, currentY + 15, contentWidth - 25, lineHeight);
                currentY += 15 + (linesDrawn * lineHeight) + 20; // Adjust Y based on lines drawn + extra spacing
            }

            // Content Blocks
            drawLabel('LOCATION:', location, '📍');
            drawLabel('HEALTH STATUS:', healthStatus, '🏥');
            drawLabel('CONTACT:', contact, '📞');
            drawLabel('DESCRIPTION:', description, '📝'); // Reporter name removed

            // Call to action
            ctx.fillStyle = '#22C55E'; // Green color
            ctx.font = 'bold 20px Arial';
            ctx.textAlign = 'center';
            currentY += 20; // Extra space before CTA, adjust as needed for total height
            ctx.fillText('Please share to help save this animal! 🙏', canvas.width / 2, currentY);

            // Removed the hashtags line, so the next sentence moves up
            currentY += 30; // Reduced gap here (from 35)

            ctx.fillStyle = '#4F46E5'; // Indigo for website link
            ctx.font = 'bold 17px Arial';
            ctx.fillText('Visit: SaveSathwa.com for more details', canvas.width / 2, currentY); // Moved up to align with reduced gap

            // Trigger download
            const link = document.createElement('a');
            link.download = `rescue-alert-${animalType.toLowerCase().replace(/\s+/g, '-')}.png`;
            link.href = canvas.toDataURL('image/png', 1.0);
            link.click();
        }

        // Load and draw rescue image if available
        if (postImageUrl) {
            const image = new Image();
            image.crossOrigin = 'anonymous'; // Required for loading images from different origins
            image.src = postImageUrl;

            image.onload = function () {
                const imgX = cardX + 35;
                const imgY = cardY + 35;
                const imgWidth = cardWidth - 70;
                const imgHeight = 250; // Fixed height for image

                ctx.save();
                ctx.beginPath();
                ctx.roundRect(imgX, imgY, imgWidth, imgHeight, 15); // Rounded corners for image
                ctx.clip();
                ctx.drawImage(image, imgX, imgY, imgWidth, imgHeight);
                ctx.restore();

                drawTextContent(imgY + imgHeight + 40); // Start text below the image + padding
            };

            image.onerror = function () {
                // If image fails to load, draw text content higher up in the card
                console.error("Failed to load image for download:", postImageUrl);
                drawTextContent(cardY + 30); // Start text near the top of the card if no image
            };
        } else {
            // If no image is provided at all
            drawTextContent(cardY + 30); // Start text near the top of the card
        }
    });

    // Helper function to wrap text. Returns the number of lines drawn.
    function wrapText(context, text, x, y, maxWidth, lineHeight) {
        const words = text.split(' ');
        let line = '';
        let lines = 0;
        let tempY = y;

        for (let n = 0; n < words.length; n++) {
            const testLine = line + words[n] + ' ';
            const metrics = context.measureText(testLine);
            const testWidth = metrics.width;
            if (testWidth > maxWidth && n > 0) {
                context.fillText(line.trim(), x, tempY); // Trim trailing space for current line
                line = words[n] + ' ';
                tempY += lineHeight;
                lines++;
            } else {
                line = testLine;
            }
        }
        context.fillText(line.trim(), x, tempY); // Draw the last line
        lines++; // Count the last line
        return lines;
    }
});

// Helper function for rounded rectangles (if not natively supported by browser)
if (!CanvasRenderingContext2D.prototype.roundRect) {
    CanvasRenderingContext2D.prototype.roundRect = function (x, y, width, height, radius) {
        this.beginPath();
        this.moveTo(x + radius, y);
        this.lineTo(x + width - radius, y);
        this.quadraticCurveTo(x + width, y, x + width, y + radius);
        this.lineTo(x + width, y + height - radius);
        this.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
        this.lineTo(x + radius, y + height);
        this.quadraticCurveTo(x, y + height, x, y + height - radius);
        this.lineTo(x, y + radius);
        this.quadraticCurveTo(x, y, x + radius, y);
        this.closePath();
    };
}

// SweetAlert2 for delete confirmation
document.querySelectorAll('.delete-comment-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const form = this.closest('form');
        const commentIndex = this.getAttribute('data-comment-index');

        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone. Do you want to delete this comment?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endsection