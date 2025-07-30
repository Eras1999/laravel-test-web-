@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Elephant Alerts</h1>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card mb-4 border-0 shadow-lg mx-4">
    <div class="card-header bg-gradient-primary text-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-table me-2"></i>Elephant Alerts Dashboard ({{ $elephantAlerts->count() }} records)
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
        <div class="mt-2">
            <form action="{{ route('admin.elephant-alerts.index') }}" method="GET" class="d-inline">
                <input type="date" name="date" value="{{ request('date') }}" class="form-control d-inline" style="width: 200px;">
                <button type="submit" class="btn btn-primary btn-sm">Filter by Date</button>
            </form>
            <form action="{{ route('admin.elephant-alerts.index') }}" method="GET" class="d-inline ms-2">
                <input type="hidden" name="date" value="">
                <button type="submit" class="btn btn-secondary btn-sm">All Report Alerts</button>
            </form>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="datatablesSimple" class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="fw-bold"><i class="fas fa-hashtag me-2"></i>ID</th>
                        <th class="fw-bold"><i class="fas fa-user me-2"></i>Name</th>
                        <th class="fw-bold"><i class="fas fa-map-marker-alt me-2"></i>District</th>
                        <th class="fw-bold"><i class="fas fa-paw me-2"></i>Elephant Count</th>
                        <th class="fw-bold"><i class="fas fa-heartbeat me-2"></i>Health Status</th>
                        <th class="fw-bold"><i class="fas fa-cogs me-2"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($elephantAlerts as $alert)
                        <tr>
                            <td class="fw-semibold">{{ $alert->id }}</td>
                            <td class="text-muted">{{ $alert->name }}</td>
                            <td>{{ $alert->district }}</td>
                            <td>{{ $alert->elephant_count }}</td>
                            <td>{{ ucfirst($alert->health_status) }}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $alert->id }}">See Details</a>
                                <form action="{{ route('admin.elephant-alerts.delete', $alert->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="detailsModal{{ $alert->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $alert->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailsModalLabel{{ $alert->id }}">Details for {{ $alert->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Mobile Number:</strong> {{ $alert->mobile_number }}</p>
                                        <p><strong>District:</strong> {{ $alert->district }}</p>
                                        <p><strong>Location:</strong> Lat: {{ $alert->latitude }}, Lng: {{ $alert->longitude }}</p>
                                        <p><strong>Elephant Count:</strong> {{ $alert->elephant_count }}</p>
                                        <p><strong>Health Status:</strong> {{ ucfirst($alert->health_status) }}</p>
                                        <p><strong>Description:</strong> {{ $alert->description }}</p>
                                        @if ($alert->image)
                                            <p><strong>Image:</strong><br>
                                            <img src="{{ asset('storage/' . $alert->image) }}" alt="Elephant" style="width: 200px; height: auto;"></p>
                                        @endif
                                        <p><strong>Date & Time:</strong> {{ $alert->created_at->setTimezone('Asia/Colombo')->format('Y-m-d H:i') }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No elephant alerts found.</td>
                        </tr>
                    @endforelse
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

        setTimeout(() => {
            try {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();
                
                // Add title
                doc.setFontSize(20);
                doc.text('Elephant Alerts Report', 14, 22);
                
                // Add date filter info
                const filterDate = '{{ request('date') }}';
                const today = '{{ \Carbon\Carbon::now()->setTimezone('Asia/Colombo')->format('Y-m-d') }}';
                doc.setFontSize(12);
                doc.text('Report Date: ' + (filterDate === '' ? 'All' : (filterDate === today ? today : filterDate)), 14, 32);
                
                // Get table data
                const table = document.getElementById('datatablesSimple');
                const rows = [];
                
                // Headers
                const headers = ['ID', 'Name', 'District', 'Elephant Count', 'Health Status', 'Telephone Number'];
                
                // Data rows
                const tableRows = table.querySelectorAll('tbody tr');
                tableRows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    if (cells.length > 0) {
                        rows.push([
                            cells[0].textContent.trim(),
                            cells[1].textContent.trim(),
                            cells[2].textContent.trim(),
                            cells[3].textContent.trim(),
                            cells[4].textContent.trim(),
                            '{{ $elephantAlerts->pluck('mobile_number')->join(',') }}'.split(',')[row.rowIndex - 1] || ''
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
                doc.save('elephant-alerts-report-' + (filterDate === '' ? 'all' : (filterDate === today ? today : filterDate)) + '.pdf');
                
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
                rows.push(['ID', 'Name', 'District', 'Elephant Count', 'Health Status', 'Telephone Number']);
                
                // Data rows
                const tableRows = table.querySelectorAll('tbody tr');
                tableRows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    if (cells.length > 0) {
                        rows.push([
                            '"' + cells[0].textContent.trim().replace(/"/g, '""') + '"',
                            '"' + cells[1].textContent.trim().replace(/"/g, '""') + '"',
                            '"' + cells[2].textContent.trim().replace(/"/g, '""') + '"',
                            '"' + cells[3].textContent.trim().replace(/"/g, '""') + '"',
                            '"' + cells[4].textContent.trim().replace(/"/g, '""') + '"',
                            '"' + '{{ $elephantAlerts->pluck('mobile_number')->join(',') }}'.split(',')[row.rowIndex - 1] + '"'
                        ]);
                    }
                });
                
                // Create CSV content
                const csvContent = rows.map(row => row.join(',')).join('\n');
                
                // Download CSV
                const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                const link = document.createElement('a');
                const filterDate = '{{ request('date') }}';
                const today = '{{ \Carbon\Carbon::now()->setTimezone('Asia/Colombo')->format('Y-m-d') }}';
                const url = URL.createObjectURL(blob);
                link.setAttribute('href', url);
                link.setAttribute('download', 'elephant-alerts-report-' + (filterDate === '' ? 'all' : (filterDate === today ? today : filterDate)) + '.csv');
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

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new simpleDatatables.DataTable('#datatablesSimple', {
            perPage: 10,
            perPageSelect: [10, 25, 50, 100],
            sortable: true,
            order: [[0, "desc"]]
        });
    });
</script>
@endsection