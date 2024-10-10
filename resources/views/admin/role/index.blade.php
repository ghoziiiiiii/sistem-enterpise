@extends('admin.app')

@section('content')
<div class="container">
    <h3>Roles</h3>

    <!-- Make the "Tambah Role" button smaller using btn-sm -->
    <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm mb-3">Tambah Role</a>

    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Role</th>
                <th>Permission</th>
                <th>Actions</th> <!-- Kolom aksi untuk edit dan delete -->
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $loop->iteration }}</td> <!-- Iteration for numbering -->
                    <td>{{ $role->name }}</td> <!-- Menampilkan nama role -->
                    <td>
                        @foreach($role->permissions as $permission)
                            <span class="badge bg-primary"> {{ $permission->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <div class="d-flex"> <!-- Bootstrap flexbox to align buttons -->
                            <!-- Edit Button -->
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>

                            <!-- Delete Button -->
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection