<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container { 
            max-width: 700px; 
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
        .detail-item { 
            margin-bottom: 25px; 
            padding: 20px; 
            background: #f9fafb; 
            border-radius: 8px;
            border-left: 4px solid #10b981;
        }
        .detail-label { 
            font-weight: 600; 
            color: #10b981; 
            margin-bottom: 8px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .detail-value { 
            color: #1f2937; 
            font-size: 16px;
        }
        .status { 
            display: inline-block; 
            padding: 8px 16px; 
            border-radius: 20px; 
            color: white; 
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
        }
        .status.pending { 
            background: #f59e0b; 
        }
        .status.done { 
            background: #10b981; 
        }
        .btn { 
            padding: 12px 24px; 
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white; 
            text-decoration: none; 
            border-radius: 8px; 
            display: inline-block; 
            margin: 10px 5px;
            transition: transform 0.2s, box-shadow 0.2s;
            font-weight: 500;
        }
        .btn:hover { 
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
        }
        .edit { 
            background: #3b82f6; 
        }
        .delete-btn { 
            background: #ef4444; 
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }
        .delete-btn:hover {
            background: #dc2626;
        }
        .back { 
            background: #6b7280; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📋 Task Details</h2>
        
        <div class="detail-item">
            <div class="detail-label">Title</div>
            <div class="detail-value">{{ $task->title }}</div>
        </div>
        
        <div class="detail-item">
            <div class="detail-label">Description</div>
            <div class="detail-value">{{ $task->description ?? 'No description' }}</div>
        </div>
        
        <div class="detail-item">
            <div class="detail-label">Status</div>
            <div class="detail-value">
                <span class="status {{ strtolower($task->status) }}">{{ $task->status }}</span>
            </div>
        </div>
        
        <div class="detail-item">
            <div class="detail-label">Due Date</div>
            <div class="detail-value">{{ $task->due_date ? $task->due_date->format('Y-m-d') : 'Not set' }}</div>
        </div>
        
        <div class="detail-item">
            <div class="detail-label">Created At</div>
            <div class="detail-value">{{ $task->created_at->format('Y-m-d H:i') }}</div>
        </div>
        
        <div class="detail-item">
            <div class="detail-label">Last Updated</div>
            <div class="detail-value">{{ $task->updated_at->format('Y-m-d H:i') }}</div>
        </div>
        
        <div style="margin-top: 30px;">
            <a href="{{ route('tasks.edit', $task) }}" class="btn edit">✏️ Edit</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this task?')">🗑️ Delete</button>
            </form>
            <a href="{{ route('tasks.index') }}" class="btn back">↩️ Back</a>
        </div>
    </div>
</body>
</html>
