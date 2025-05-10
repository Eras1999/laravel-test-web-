@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Contact Messages</h1>
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
        All Messages
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ Str::limit($contact->message, 50) }}</td>
                        <td>
                            <form action="{{ route('contact.updateStatus', $contact->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="Pending" {{ $contact->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Checked" {{ $contact->status === 'Checked' ? 'selected' : '' }}>Checked</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('contact.delete', $contact->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
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