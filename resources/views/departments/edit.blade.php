<!DOCTYPE html>
<html>
<head>
    <title>Edit Department</title>
</head>
<body>
    <h1>Edit Department</h1>
    <form action="{{ route('departments.update', $department) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Name:</label>
        <input type="text" name="name" value="{{ $department->name }}" required>
        <br>
        <label>Description:</label>
        <textarea name="description">{{ $department->description }}</textarea>
        <br>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('departments.index') }}">Back</a>
</body>
</html>
