@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Snake Catchers</h1>
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

<div class="card mb-4 mx-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Snake Catchers List ({{ $snakeCatchers->count() }} records)
        <a href="#" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addCatcherModal">Add Snake Catcher</a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($snakeCatchers as $catcher)
                    <tr class="{{ $catcher->status === 'pending' ? 'table-warning' : '' }}">
                        <td>{{ $catcher->id }}</td>
                        <td>{{ $catcher->name }}</td>
                        <td>
                            @if ($catcher->image)
                                <img src="{{ asset('storage/' . $catcher->image) }}" alt="{{ $catcher->name }}" style="width: 100px; height: auto;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.snake-catchers.update', $catcher->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="pending" {{ $catcher->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $catcher->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $catcher->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $catcher->id }}">See Details</a>
                            <form action="{{ route('admin.snake-catchers.delete', $catcher->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="detailsModal{{ $catcher->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $catcher->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailsModalLabel{{ $catcher->id }}">Details for {{ $catcher->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Email:</strong> {{ $catcher->email ?? 'Not provided' }}</p>
                                    <p><strong>District:</strong> {{ $catcher->district }}</p>
                                    <p><strong>Description:</strong> {{ $catcher->description }}</p>
                                    <p><strong>Mobile Number:</strong> {{ $catcher->mobile_number }}</p>
                                    <p><strong>Facebook Link:</strong> <a href="{{ $catcher->facebook_link }}" target="_blank">{{ $catcher->facebook_link }}</a></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No snake catchers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addCatcherModal" tabindex="-1" aria-labelledby="addCatcherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCatcherModalLabel">Add Snake Catcher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.snake-catchers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="district" class="form-label">District</label>
                        <select name="district" id="district" class="form-select" required>
                            <option value="">Select District</option>
                            @foreach (['Colombo', 'Gampaha', 'Kalutara', 'Kandy', 'Matale', 'Nuwara Eliya', 'Galle', 'Matara', 'Hambantota', 'Jaffna', 'Kilinochchi', 'Mannar', 'Vavuniya', 'Mullaitivu', 'Batticaloa', 'Ampara', 'Trincomalee', 'Kurunegala', 'Puttalam', 'Anuradhapura', 'Polonnaruwa', 'Badulla', 'Moneragala', 'Ratnapura', 'Kegalle'] as $district)
                                <option value="{{ $district }}">{{ $district }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="mobile_number" class="form-label">Mobile Number</label>
                        <input type="text" name="mobile_number" id="mobile_number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="facebook_link" class="form-label">Facebook Link</label>
                        <input type="url" name="facebook_link" id="facebook_link" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Catcher</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .table-warning {
        background-color: #fff3cd;
        font-weight: bold;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new simpleDatatables.DataTable("#datatablesSimple", {
            perPage: 10,
            perPageSelect: [10, 25, 50, 100],
            sortable: true,
            order: [[3, "desc"]]
        });
    });
</script>
@endsection