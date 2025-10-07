<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8fafc; margin: 30px; }
        h1 { text-align: center; color: #0d6efd; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #0d6efd; color: white; }
        a, button { padding: 5px 10px; text-decoration: none; border-radius: 5px; }
        .add-btn { background-color: #198754; color: white; }
        .show-btn { background-color: #0dcaf0; color: black; }
        .edit-btn { background-color: #ffc107; color: black; }
        .delete-btn { background-color: #dc3545; color: white; }
        .restore-btn { background-color: #20c997; color: white; }
        .status-done { color: green; font-weight: bold; }
        .status-pending { color: orange; font-weight: bold; }
        .top-actions { display: flex; justify-content: flex-end; margin-bottom: 15px; }
    </style>
</head>
<body>

    <h1>📋 Task List</h1>

    <!-- 🔝 Add Button -->
    <div class="top-actions">
        <a href="{{ route('tasks.create') }}" class="add-btn">➕ Add New Task</a>
    </div>

    @if(session('success'))
        <p style="color: green; margin-top: 10px;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr @if($task->trashed()) style="opacity:0.5;" @endif>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        @if($task->status == 'Done')
                            <span class="status-done">Completed ✅</span>
                        @else
                            <span class="status-pending">In Progress ⏳</span>
                        @endif
                    </td>
                    <td>{{ $task->due_date ?? '-' }}</td>
                    <td>
                        @if(!$task->trashed())
                            <a href="{{ route('tasks.show', $task->id) }}" class="show-btn">👁️ View</a>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="edit-btn">✏️ Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">🗑️ Delete</button>
                            </form>
                        @else
                            <a href="{{ route('tasks.restore', $task->id) }}" class="restore-btn">🔁 Restore</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="color: gray;">No tasks available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
