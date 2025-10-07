<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Task</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8fafc; margin: 30px; }
        h1 { text-align: center; color: #0d6efd; }
        form { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        label { display: block; margin-bottom: 8px; color: #333; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; }
        button { background-color: #198754; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #157347; }
        a { display: inline-block; margin-top: 10px; color: #0d6efd; text-decoration: none; }
    </style>
</head>
<body>

    <h1>➕ Add New Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="Pending">In Progress</option>
            <option value="Done">Completed</option>
        </select>

        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date">

        <button type="submit">💾 Save Task</button>
    </form>

    <a href="{{ route('tasks.index') }}">⬅️ Back to Task List</a>

</body>
</html>
