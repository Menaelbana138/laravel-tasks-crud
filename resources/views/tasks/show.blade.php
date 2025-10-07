<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8fafc; margin: 40px; }
        h1 { text-align: center; color: #198754; }
        .container { 
            max-width: 600px; 
            margin: 20px auto; 
            background: white; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
        }
        p { margin-bottom: 10px; font-size: 18px; }
        strong { color: #555; }
        .back-btn { 
            display: inline-block; 
            margin-top: 15px; 
            background-color: #0d6efd; 
            color: white; 
            text-decoration: none; 
            padding: 10px 15px; 
            border-radius: 5px; 
        }
    </style>
</head>
<body>

    <h1>📋 Task Details</h1>

    <div class="container">
        <p><strong>Title:</strong> {{ $task->title }}</p>
        <p><strong>Description:</strong> {{ $task->description ?? 'No description provided' }}</p>
        <p><strong>Due Date:</strong> {{ $task->due_date ?? 'Not set' }}</p>
        <p><strong>Status:</strong>
            @if($task->status == 'Done')
                ✅ Completed
            @else
                ⏳ In Progress
            @endif
        </p>

        <a href="{{ route('tasks.index') }}" class="back-btn">🔙 Back to Tasks</a>
    </div>

</body>
</html>
