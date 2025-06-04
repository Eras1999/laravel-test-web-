@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Community Blogs</h1>
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
        All Blogs
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Author Name</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $blog)
                    <tr class="{{ $blog->status === 'pending' ? 'table-warning' : '' }}">
                        <td>{{ $blog->id }}</td>
                        <td>{{ $blog->author_name ?? $blog->user->name }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ Str::limit($blog->content, 50) }}</td>
                        <td>
                            @if ($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" style="width: 100px; height: auto;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $blog->date }}</td>
                        <td>
                            <form action="{{ route('admin.community-blogs.update', $blog->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="pending" {{ $blog->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $blog->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $blog->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.community-blogs.delete', $blog->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No blogs available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Display Approved Blog Details -->
@if (session('approved_blog'))
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-check-circle me-1"></i>
            Recently Approved Blog Details
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ session('approved_blog.title') }}</h5>
            <p><strong>Author:</strong> {{ session('approved_blog.author_name') }}</p>
            <p><strong>Date:</strong> {{ session('approved_blog.date') }}</p>
            <p><strong>Content:</strong> {{ session('approved_blog.content') }}</p>
            @if (session('approved_blog.image'))
                <p><strong>Image:</strong></p>
                <img src="{{ asset('storage/' . session('approved_blog.image')) }}" alt="{{ session('approved_blog.title') }}" style="width: 300px; height: auto;">
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
                order: [[6, 'desc']] // Sort by status column (index 6) in descending order to prioritize pending
            });
        });
    </script>
@endsection