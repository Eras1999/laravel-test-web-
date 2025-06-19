@extends('admin.layouts.master')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Manage Snake Catchers</h1>
            <div class="card mb-4" style="width: 100%; max-width: 1200px; margin: 0 auto;">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Snake Catchers List
                    <a href="#" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addCatcherModal">Add Snake Catcher</a>
                </div>
                <div class="card-body" style="overflow-x: auto;">
                    <table id="datatablesSimple" style="width: 100%; min-width: 1200px;">
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
                                <tr>
                                    <td>{{ $catcher->id }}</td>
                                    <td>{{ $catcher->name }}</td>
                                    <td>
                                        @if ($catcher->image)
                                            <img src="{{ asset('storage/' . $catcher->image) }}" alt="{{ $catcher->name }}" width="50">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.snake-catchers.update', $catcher->id) }}" method="POST" style="display:inline;">
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
                                        <form action="{{ route('admin.snake-catchers.delete', $catcher->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this snake catcher?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Details Modal -->
                                <div class="modal fade" id="detailsModal{{ $catcher->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $catcher->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailsModalLabel{{ $catcher->id }}">Details for {{ $catcher->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
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
                                    <td colspan="5">No snake catchers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Add Catcher Modal -->
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
                        <label for="description" class="form-label">Description <small>(Note: Please specify the area you can cover)</small></label>
                        <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="mobile_number" class="form-label">Mobile Number (e.g., 0771234567)</label>
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