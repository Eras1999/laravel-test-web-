@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Rescue Posts</h1>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card mb-4 mx-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Rescue Posts List
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Animal Type</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Contact Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rescuePosts as $post)
                    <tr class="{{ !$post->rescued ? 'table-warning' : '' }}">
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->author_name }}</td>
                        <td>{{ ucfirst($post->animal_type) }}</td>
                        <td>
                            @if ($post->rescued)
                                <span class="badge bg-success">Rescued</span>
                            @else
                                <span class="badge bg-warning text-dark">Not Rescued</span>
                            @endif
                        </td>
                        <td>{{ $post->place ?? $post->city }}, {{ $post->district }}</td>
                        <td>{{ $post->contact_number ?? 'N/A' }}</td>
                        <td>
                            <form action="{{ route('admin.rescue-posts.delete', $post->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            @if (!$post->rescued)
                                <form action="{{ route('admin.rescue-posts.rescued', $post->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure this animal has been rescued?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">Mark Rescued</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No rescue posts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
            order: [[3, "desc"]] // Status column
        });
    });
</script>
@endsection
