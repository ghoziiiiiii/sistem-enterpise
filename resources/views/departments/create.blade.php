<!DOCTYPE html>
<html>
<head>
    <title>Add Department</title>
</head>
<body>
    <h1>Add Department</h1>
    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required>
        <br>
        <label>Description:</label>
        <textarea name="description"></textarea>
        <br>
        <button type="submit">Save</button>
    </form>
    <a href="{{ route('departments.index') }}">Back</a>
</body>
</html>
