<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8fafc; margin: 30px; }
        h1 { text-align: center; color: #ffc107; }
        form { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        label { display: block; margin-bottom: 8px; color: #333; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; }
        button { background-color: #ffc107; color: black; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #e0a800; }
        a { display: inline-block; margin-top: 10px; color: #0d6efd; text-decoration: none; }
    </style>
</head>
<body>

    <h1>✏️ Edit Task</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $task->title }}" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required>{{ $task->description }}</textarea>

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>In Progress</option>
            <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Completed</option>
        </select>

        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" value="{{ $task->due_date }}">

        <button type="submit">💾 Update Task</button>
    </form>

    <a href="{{ route('tasks.index') }}">⬅️ Back to Task List</a>

</body>
</html>
