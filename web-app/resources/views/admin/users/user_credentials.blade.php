@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mt-4 mb-0">User Credentials</h1>
        </div>
    </div>

    <div class="card mb-4 border-0 shadow-lg">
        <div class="card-header bg-gradient-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-users me-2"></i>User Management Dashboard
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
                            <th class="fw-bold"><i class="fas fa-hashtag me-2"></i>ID</th>
                            <th class="fw-bold"><i class="fas fa-user me-2"></i>Username</th>
                            <th class="fw-bold"><i class="fas fa-envelope me-2"></i>User Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userCredentials as $user)
                            <tr>
                                <td class="fw-semibold">{{ $user->id }}</td>
                                <td class="text-muted">{{ $user->name }}</td>
                                <td>
                                    <a href="mailto:{{ $user->email }}" class="text-primary text-decoration-none">
                                        <i class="fas fa-envelope me-1"></i>{{ $user->email }}
                                    </a>
                                </td>
                            </tr>
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
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        @media (max-width: 768px) {
            .btn-group {
                flex-direction: column;
            }
            
            .btn-group .btn {
                margin: 2px 0;
            }
            
            .table-responsive {
                font-size: 0.875rem;
            }
        }
    </style>

    <script>
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
                    doc.text('User Credentials Report', 14, 22);
                    
                    // Add date
                    doc.setFontSize(12);
                    doc.text('Generated on: ' + new Date().toLocaleDateString(), 14, 32);
                    
                    // Get table data
                    const table = document.getElementById('datatablesSimple');
                    const rows = [];
                    
                    // Headers
                    const headers = ['ID', 'Username', 'User Email'];
                    
                    // Data rows
                    const tableRows = table.querySelectorAll('tbody tr');
                    tableRows.forEach(row => {
                        const cells = row.querySelectorAll('td');
                        if (cells.length > 0) {
                            rows.push([
                                cells[0].textContent.trim(),
                                cells[1].textContent.trim(),
                                cells[2].textContent.trim()
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
                    doc.save('user-credentials-report-' + new Date().toISOString().split('T')[0] + '.pdf');
                    
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
                    rows.push(['ID', 'Username', 'User Email']);
                    
                    // Data rows
                    const tableRows = table.querySelectorAll('tbody tr');
                    tableRows.forEach(row => {
                        const cells = row.querySelectorAll('td');
                        if (cells.length > 0) {
                            rows.push([
                                '"' + cells[0].textContent.trim().replace(/"/g, '""') + '"',
                                '"' + cells[1].textContent.trim().replace(/"/g, '""') + '"',
                                '"' + cells[2].textContent.trim().replace(/"/g, '""') + '"'
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
                    link.setAttribute('download', 'user-credentials-report-' + new Date().toISOString().split('T')[0] + '.csv');
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

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new simpleDatatables.DataTable('#datatablesSimple');
        });
    </script>
@endsection