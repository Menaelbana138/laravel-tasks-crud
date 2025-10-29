<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container { 
            max-width: 600px; 
            margin: 0 auto; 
            background: white; 
            padding: 40px; 
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h2 { 
            color: #1f2937; 
            margin-bottom: 30px;
            font-size: 28px;
        }
        .form-group { 
            margin-bottom: 25px; 
        }
        label { 
            display: block; 
            margin-bottom: 8px; 
            color: #374151; 
            font-weight: 600;
            font-size: 14px;
        }
        input, textarea, select { 
            width: 100%; 
            padding: 12px 16px; 
            border: 2px solid #e5e7eb; 
            border-radius: 8px; 
            font-size: 16px;
            transition: border-color 0.2s;
        }
        textarea { 
            min-height: 100px; 
            resize: vertical; 
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #10b981;
        }
        .error {
            color: #ef4444;
            font-size: 14px;
            margin-top: 5px;
        }
        .btn { 
            padding: 12px 30px; 
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer; 
            font-size: 16px;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn:hover { 
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
        }
        .back { 
            background: #6b7280; 
            display: inline-block; 
            margin-left: 10px; 
            text-decoration: none; 
            padding: 12px 24px; 
            border-radius: 8px; 
            color: white;
            font-weight: 500;
        }
        .back:hover {
            background: #4b5563;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>✏️ Edit Task</h2>
        
        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}" required>
                @error('title')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description">{{ old('description', $task->description) }}</textarea>
            </div>
            
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Done" {{ old('status', $task->status) == 'Done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" id="due_date" name="due_date" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
            </div>
            
            <button type="submit" class="btn">Update Task</button>
            <a href="{{ route('tasks.index') }}" class="back">↩️ Back</a>
        </form>
    </div>
</body>
</html>
