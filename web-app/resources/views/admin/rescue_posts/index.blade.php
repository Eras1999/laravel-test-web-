@extends('admin.layouts.master')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Manage Rescue Posts</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Rescue Posts List
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" style="width: 100%; min-width: 800px;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Animal Type</th>
                                <th>Status</th>
                                <th>Location</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rescuePosts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->author_name }}</td>
                                    <td>{{ $post->animal_type }}</td>
                                    <td>{{ $post->rescued ? 'Rescued' : 'Not Rescued' }}</td>
                                    <td>{{ $post->place ?? $post->city }}, {{ $post->district }}</td>
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
                                                <button type="submit" class="btn btn-success btn-sm">Rescued</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No rescue posts found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection