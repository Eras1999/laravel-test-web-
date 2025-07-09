@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Adoption Posts</h1>
</div>
<div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        All Adoption Posts
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Author Name</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Mobile</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr class="{{ $post->status === 'pending' ? 'table-warning' : '' }}">
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->author_name }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ ucfirst($post->category) }}</td>
                        <td>{{ Str::limit($post->description, 50) }}</td>
                        <td>{{ $post->city }}, {{ $post->district }}</td>
                        <td>{{ $post->mobile_number }}</td>
                        <td>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="width: 100px; height: auto;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.adoption-posts.update', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="pending" {{ $post->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $post->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $post->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="expired" {{ $post->status === 'expired' ? 'selected' : '' }}>Expired</option>
                                    <option value="adopted" {{ $post->status === 'adopted' ? 'selected' : '' }}>Adopted</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.adoption-posts.delete', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No adoption posts available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Display Approved Post Details -->
@if (session('approved_post'))
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-check-circle me-1"></i>
            Recently Approved Adoption Post Details
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ session('approved_post.title') }}</h5>
            <p><strong>Author:</strong> {{ session('approved_post.author_name') }}</p>
            <p><strong>Category:</strong> {{ ucfirst(session('approved_post.category')) }}</p>
            <p><strong>Location:</strong> {{ session('approved_post.city') }}, {{ session('approved_post.district') }}</p>
            <p><strong>Mobile:</strong> {{ session('approved_post.mobile_number') }}</p>
            <p><strong>Description:</strong> {{ session('approved_post.description') }}</p>
            @if (session('approved_post.image'))
                <p><strong>Image:</strong></p>
                <img src="{{ asset('storage/' . session('approved_post.image')) }}" alt="{{ session('approved_post.title') }}" style="width: 300px; height: auto;">
            @else
                <p><strong>Image:</strong> No Image</p>
            @endif
        </div>
    </div>
@endif

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
    document.addEventListener('DOMContentLoaded', function() {
        new simpleDatatables.DataTable('#datatablesSimple', {
            perPage: 10,
            perPageSelect: [10, 25, 50, 100],
            sortable: true,
            order: [[8, 'desc']] // Sort by status column (index 8) in descending order to prioritize pending
        });
    });
</script>
@endsection