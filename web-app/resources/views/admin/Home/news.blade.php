@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">News Management</h1>
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
        Add New News
    </div>
    <div class="card-body">
        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ now()->format('Y-m-d') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Add News</button>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        All News
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Content</th>
                    <śc th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($news as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" width="50"></td>
                        <td>{{ $item->title }}</td>
                        <td>{{ Str::limit($item->content, 50) }}</td>
                        <td>{{ $item->date->format('Y-m-d') }}</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit</a>
                            <a href="{{ route('news.delete', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit News</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('news.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="mb-3">
                                                    <label for="edit_image_{{ $item->id }}" class="form-label">Image</label>
                                                    <input type="file" class="form-control" id="edit_image_{{ $item->id }}" name="image">
                                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" width="100" class="mt-2">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_title_{{ $item->id }}" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="edit_title_{{ $item->id }}" name="title" value="{{ $item->title }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_content_{{ $item->id }}" class="form-label">Content</label>
                                                    <textarea class="form-control" id="edit_content_{{ $item->id }}" name="content" rows="3" required>{{ $item->content }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_date_{{ $item->id }}" class="form-label">Date</label>
                                                    <input type="date" class="form-control" id="edit_date_{{ $item->id }}" name="date" value="{{ $item->date->format('Y-m-d') }}" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update News</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No news items available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new simpleDatatables.DataTable('#datatablesSimple');
        });
    </script>
@endsection
