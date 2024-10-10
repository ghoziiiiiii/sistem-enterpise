<!DOCTYPE html>
<html>
<head>
    <title>Departments</title>
</head>
<body>
    <h1>Departments</h1>
    <a href="{{ route('departments.create') }}">Add Department</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
            <tr>
                <td>{{ $department->id }}</td>
                <td>{{ $department->name }}</td>
                <td>{{ $department->description }}</td>
                <td>
                    <a href="{{ route('departments.edit', $department) }}">Edit</a>
                    <form action="{{ route('departments.destroy', $department) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
