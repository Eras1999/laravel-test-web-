@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4 text-primary fw-bold">Official Blogs Management</h1>
</div>

<div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

<!-- Add New Blog Card -->
<div class="card mb-4 shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex align-items-center">
        <i class="fas fa-blog me-2"></i>
        <span class="fw-semibold">Add New Official Blog</span>
    </div>
    <div class="card-body">
        <form action="{{ route('official_blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label fw-medium">Featured Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label fw-medium">Blog Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter blog title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label fw-medium">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" placeholder="Write the blog content here" required></textarea>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label fw-medium">Publication Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ now()->format('Y-m-d') }}" required>
            </div>
            <button type="submit" class="btn btn-primary px-4">Publish Blog</button>
        </form>
    </div>
</div>

<!-- Blog List Card -->
<div class="card mb-4 shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex align-items-center">
        <i class="fas fa-list me-2"></i>
        <span class="fw-semibold">All Official Blogs</span>
    </div>
    <div class="card-body">
        @if ($blogs->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                No official blogs available yet.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content Preview</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="rounded" width="60" height="40" style="object-fit: cover;">
                                </td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ Str::limit($blog->content, 50) }}</td>
                                <td>{{ $blog->date->format('Y-m-d') }}</td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $blog->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <a href="{{ route('official_blogs.delete', $blog->id) }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this blog?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $blog->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $blog->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="editModalLabel{{ $blog->id }}">Edit Official Blog</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('official_blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="mb-3">
                                                            <label for="edit_image_{{ $blog->id }}" class="form-label fw-medium">Featured Image</label>
                                                            <input type="file" class="form-control" id="edit_image_{{ $blog->id }}" name="image" accept="image/*">
                                                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="mt-2 rounded" width="100" style="object-fit: cover;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_title_{{ $blog->id }}" class="form-label fw-medium">Blog Title</label>
                                                            <input type="text" class="form-control" id="edit_title_{{ $blog->id }}" name="title" value="{{ $blog->title }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_content_{{ $blog->id }}" class="form-label fw-medium">Content</label>
                                                            <textarea class="form-control" id="edit_content_{{ $blog->id }}" name="content" rows="5" required>{{ $blog->content }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_date_{{ $blog->id }}" class="form-label fw-medium">Publication Date</label>
                                                            <input type="date" class="form-control" id="edit_date_{{ $blog->id }}" name="date" value="{{ $blog->date->format('Y-m-d') }}" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary px-4">Update Blog</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $blogs->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
    <style>
        .card {
            border-radius: 10px;
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-outline-primary, .btn-outline-danger {
            transition: all 0.3s ease;
        }
        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: white;
        }
        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }
    </style>
@endsection