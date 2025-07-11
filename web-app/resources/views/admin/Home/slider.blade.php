@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mt-4 mb-0">Slider Manager</h1>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-lg shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-plus me-2"></i>Add New Slide
            </button>
        </div>
    </div>

    <!-- SweetAlert will handle these alerts via JavaScript -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fas fa-images me-2"></i>Add New Slider
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row">
                            <!-- Top Heading -->
                            <div class="col-md-6 mb-3">
                                <label for="topHeading" class="form-label fw-bold">
                                    <i class="fas fa-heading me-2 text-primary"></i>Top Heading
                                </label>
                                <input type="text" class="form-control form-control-lg" id="topHeading" name="top_heading" placeholder="Enter top heading" value="{{ old('top_heading') }}">
                                @error('top_heading')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Sub Heading -->
                            <div class="col-md-6 mb-3">
                                <label for="subHeading" class="form-label fw-bold">
                                    <i class="fas fa-text-height me-2 text-primary"></i>Sub Heading
                                </label>
                                <input type="text" class="form-control form-control-lg" id="subHeading" name="sub_heading" placeholder="Enter sub heading" value="{{ old('sub_heading') }}">
                                @error('sub_heading')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Content -->
                            <div class="col-12 mb-3">
                                <label for="content" class="form-label fw-bold">
                                    <i class="fas fa-align-left me-2 text-primary"></i>Content
                                </label>
                                <textarea class="form-control form-control-lg" id="content" name="content" rows="3" placeholder="Enter content">{{ old('content') }}</textarea>
                                @error('content')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label fw-bold">
                                    <i class="fas fa-image me-2 text-primary"></i>Image Upload
                                </label>
                                <input type="file" class="form-control form-control-lg" id="image" name="image" accept="image/*">
                                @error('image')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- View More Link -->
                            <div class="col-md-6 mb-3">
                                <label for="viewMoreLink" class="form-label fw-bold">
                                    <i class="fas fa-link me-2 text-primary"></i>View More Link
                                </label>
                                <input type="url" class="form-control form-control-lg" id="viewMoreLink" name="view_more_link" placeholder="Enter link for more info" value="{{ old('view_more_link') }}">
                                @error('view_more_link')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Close
                        </button>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Add Slider
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Modal -->

    <div class="card mb-4 border-0 shadow-lg">
        <div class="card-header bg-gradient-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-table me-2"></i>Slider Management Dashboard
                </h5>
                <div class="btn-group">
                    <button type="button" class="btn btn-light btn-sm" onclick="exportTableToPDF()">
                        <i class="fas fa-file-pdf me-2"></i>Export PDF
                    </button>
                    <button type="button" class="btn btn-light btn-sm" onclick="exportTableToCSV()">
                        <i class="fas fa-file-csv me-2"></i>Export CSV
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="fw-bold"><i class="fas fa-heading me-2"></i>Top Heading</th>
                            <th class="fw-bold"><i class="fas fa-text-height me-2"></i>Sub Heading</th>
                            <th class="fw-bold"><i class="fas fa-align-left me-2"></i>Content</th>
                            <th class="fw-bold"><i class="fas fa-image me-2"></i>Image</th>
                            <th class="fw-bold"><i class="fas fa-link me-2"></i>View More Link</th>
                            <th class="fw-bold"><i class="fas fa-cogs me-2"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $slider)
                        <tr>
                            <td class="fw-semibold">{{ $slider->top_heading }}</td>
                            <td class="text-muted">{{ $slider->sub_heading }}</td>
                            <td>
                                <div class="text-truncate" style="max-width: 200px;" title="{{ $slider->content }}">
                                    {{ $slider->content }}
                                </div>
                            </td>
                            <td>
                                <img width="80" height="60" src="{{ asset('storage/' . $slider->image_link) }}" alt="" class="img-thumbnail border-0 shadow-sm rounded" />
                            </td>
                            <td>
                                <a href="{{ $slider->view_more_link }}" target="_blank" class="text-primary text-decoration-none">
                                    <i class="fas fa-external-link-alt me-1"></i>View Link
                                </a>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#slideModal{{ $slider->id }}">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </button>
                                    <a href="/deleteSlider/{{ $slider->id }}" class="btn btn-outline-danger btn-sm" onclick="return confirmDelete({{ $slider->id }}, '{{ addslashes($slider->top_heading) }}')">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="slideModal{{ $slider->id }}" tabindex="-1" aria-labelledby="slideModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title" id="slideModalLabel">
                                            <i class="fas fa-edit me-2"></i>Edit Slide #{{ $slider->id }}
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="/sliderUpdate" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="slider_id" value="{{ $slider->id }}">
                                        <div class="modal-body p-4">
                                            <div class="row">
                                                <!-- Top Heading -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="topHeading" class="form-label fw-bold">
                                                        <i class="fas fa-heading me-2 text-success"></i>Top Heading
                                                    </label>
                                                    <input type="text" class="form-control form-control-lg" id="topHeading" name="top_heading" value="{{ $slider->top_heading }}">
                                                    @error('top_heading')
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- Sub Heading -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="subHeading" class="form-label fw-bold">
                                                        <i class="fas fa-text-height me-2 text-success"></i>Sub Heading
                                                    </label>
                                                    <input type="text" class="form-control form-control-lg" id="subHeading" name="sub_heading" value="{{ $slider->sub_heading }}">
                                                    @error('sub_heading')
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- Content -->
                                                <div class="col-12 mb-3">
                                                    <label for="content" class="form-label fw-bold">
                                                        <i class="fas fa-align-left me-2 text-success"></i>Content
                                                    </label>
                                                    <textarea class="form-control form-control-lg" id="content" name="content" rows="3">{{ $slider->content }}</textarea>
                                                    @error('content')
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- Current Image Preview -->
                                                <div class="col-12 mb-3">
                                                    <label class="form-label fw-bold">
                                                        <i class="fas fa-eye me-2 text-success"></i>Current Image
                                                    </label>
                                                    <div class="border rounded p-3 bg-light">
                                                        <img width="150" height="100" src="{{ asset('storage/' . $slider->image_link) }}" alt="" class="img-thumbnail shadow-sm" />
                                                    </div>
                                                </div>

                                                <!-- Image Upload -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="imageUpload" class="form-label fw-bold">
                                                        <i class="fas fa-image me-2 text-success"></i>Update Image
                                                    </label>
                                                    <input type="file" class="form-control form-control-lg" id="imageUpload" name="image">
                                                    <div class="form-text">Leave empty to keep current image</div>
                                                    @error('image')
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- View More Link -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="viewMoreLink" class="form-label fw-bold">
                                                        <i class="fas fa-link me-2 text-success"></i>View More Link
                                                    </label>
                                                    <input type="url" class="form-control form-control-lg" id="viewMoreLink" name="view_more_link" value="{{ $slider->view_more_link }}">
                                                    @error('view_more_link')
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">
                                                <i class="fas fa-times me-2"></i>Close
                                            </button>
                                            <button type="submit" class="btn btn-success btn-lg" onclick="return confirmUpdateSlider()">
                                                <i class="fas fa-save me-2"></i>Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }
        
        .shadow-lg {
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
        }
        
        .card-header {
            border-bottom: none;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }
        
        .btn-group .btn {
            margin: 0 2px;
        }
        
        .modal-content {
            border-radius: 15px;
        }
        
        .modal-header {
            border-radius: 15px 15px 0 0;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        .img-thumbnail {
            border-radius: 10px;
        }
        
        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        @media (max-width: 768px) {
            .btn-group {
                flex-direction: column;
            }
            
            .btn-group .btn {
                margin: 2px 0;
            }
            
            .modal-dialog {
                margin: 1rem;
            }
            
            .table-responsive {
                font-size: 0.875rem;
            }
        }
    </style>

    <script>
        // Initialize SweetAlert for success/error messages
        document.addEventListener('DOMContentLoaded', function() {
            // Check for Laravel session messages
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#007bff',
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Errors',
                    html: '<ul style="text-align: left; margin: 0; padding-left: 20px;">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: 'Got it!'
                });
            @endif
        });

        // Confirm Add Slider
        function confirmAddSlider() {
            event.preventDefault();
            
            Swal.fire({
                title: 'Add New Slider?',
                text: "Are you sure you want to add this new slider?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-plus me-2"></i>Yes, Add It!',
                cancelButtonText: '<i class="fas fa-times me-2"></i>Cancel',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-primary btn-lg',
                    cancelButton: 'btn btn-secondary btn-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Adding your slider, please wait.',
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Submit the form
                    event.target.closest('form').submit();
                }
            });
            
            return false;
        }

        // Confirm Update Slider
        function confirmUpdateSlider() {
            event.preventDefault();
            
            Swal.fire({
                title: 'Update Slider?',
                text: "Are you sure you want to save these changes?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-save me-2"></i>Yes, Save Changes!',
                cancelButtonText: '<i class="fas fa-times me-2"></i>Cancel',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-success btn-lg',
                    cancelButton: 'btn btn-secondary btn-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Updating...',
                        text: 'Saving your changes, please wait.',
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Submit the form
                    event.target.closest('form').submit();
                }
            });
            
            return false;
        }

        // Confirm Delete
        function confirmDelete(id, title) {
            event.preventDefault();
            
            Swal.fire({
                title: 'Delete Slider?',
                html: `Are you sure you want to delete:<br><strong>"${title}"</strong>?<br><br><small class="text-muted">This action cannot be undone!</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash me-2"></i>Yes, Delete It!',
                cancelButtonText: '<i class="fas fa-shield-alt me-2"></i>Keep It Safe',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-danger btn-lg',
                    cancelButton: 'btn btn-secondary btn-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Deleting...',
                        text: 'Removing slider, please wait.',
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Redirect to delete URL
                    window.location.href = `/deleteSlider/${id}`;
                }
            });
            
            return false;
        }

        // Export to PDF with SweetAlert
        function exportTableToPDF() {
            Swal.fire({
                title: 'Generating PDF...',
                text: 'Please wait while we prepare your report.',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            // Simulate processing time
            setTimeout(() => {
                try {
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();
                    
                    // Add title
                    doc.setFontSize(20);
                    doc.text('Slider Management Report', 14, 22);
                    
                    // Add date
                    doc.setFontSize(12);
                    doc.text('Generated on: ' + new Date().toLocaleDateString(), 14, 32);
                    
                    // Get table data
                    const table = document.getElementById('datatablesSimple');
                    const rows = [];
                    
                    // Headers
                    const headers = ['Top Heading', 'Sub Heading', 'Content', 'View More Link'];
                    
                    // Data rows
                    const tableRows = table.querySelectorAll('tbody tr');
                    tableRows.forEach(row => {
                        const cells = row.querySelectorAll('td');
                        if (cells.length > 0) {
                            rows.push([
                                cells[0].textContent.trim(),
                                cells[1].textContent.trim(),
                                cells[2].textContent.trim(),
                                cells[4].querySelector('a') ? cells[4].querySelector('a').href : ''
                            ]);
                        }
                    });
                    
                    // Add table to PDF
                    doc.autoTable({
                        head: [headers],
                        body: rows,
                        startY: 40,
                        styles: {
                            fontSize: 8,
                            cellPadding: 3,
                        },
                        headStyles: {
                            fillColor: [0, 123, 255],
                            textColor: [255, 255, 255],
                            fontStyle: 'bold'
                        },
                        alternateRowStyles: {
                            fillColor: [245, 245, 245]
                        },
                        margin: { left: 14, right: 14 }
                    });
                    
                    // Save the PDF
                    doc.save('slider-report-' + new Date().toISOString().split('T')[0] + '.pdf');
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'PDF Generated!',
                        text: 'Your report has been downloaded successfully.',
                        confirmButtonColor: '#007bff',
                        timer: 2000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Export Failed',
                        text: 'There was an error generating the PDF. Please try again.',
                        confirmButtonColor: '#dc3545'
                    });
                }
            }, 1000);
        }
        
        
        
        // Export to CSV with SweetAlert
        function exportTableToCSV() {
            Swal.fire({
                title: 'Generating CSV...',
                text: 'Please wait while we prepare your data file.',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(() => {
                try {
                    const table = document.getElementById('datatablesSimple');
                    const rows = [];
                    
                    // Headers
                    rows.push(['Top Heading', 'Sub Heading', 'Content', 'View More Link']);
                    
                    // Data rows
                    const tableRows = table.querySelectorAll('tbody tr');
                    tableRows.forEach(row => {
                        const cells = row.querySelectorAll('td');
                        if (cells.length > 0) {
                            rows.push([
                                '"' + cells[0].textContent.trim().replace(/"/g, '""') + '"',
                                '"' + cells[1].textContent.trim().replace(/"/g, '""') + '"',
                                '"' + cells[2].textContent.trim().replace(/"/g, '""') + '"',
                                '"' + (cells[4].querySelector('a') ? cells[4].querySelector('a').href : '').replace(/"/g, '""') + '"'
                            ]);
                        }
                    });
                    
                    // Create CSV content
                    const csvContent = rows.map(row => row.join(',')).join('\n');
                    
                    // Download CSV
                    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                    const link = document.createElement('a');
                    const url = URL.createObjectURL(blob);
                    link.setAttribute('href', url);
                    link.setAttribute('download', 'slider-report-' + new Date().toISOString().split('T')[0] + '.csv');
                    link.style.visibility = 'hidden';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'CSV Generated!',
                        text: 'Your data file has been downloaded successfully.',
                        confirmButtonColor: '#6f42c1',
                        timer: 2000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Export Failed',
                        text: 'There was an error generating the CSV file. Please try again.',
                        confirmButtonColor: '#dc3545'
                    });
                }
            }, 1000);
        }
    </script>
    
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Required CDN for export functionality -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
@endsection