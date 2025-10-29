<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        input, select { 
            width: 100%; 
            padding: 12px 16px; 
            border: 2px solid #e5e7eb; 
            border-radius: 8px; 
            font-size: 16px;
            transition: border-color 0.2s;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #667eea;
        }
        .error {
            color: #ef4444;
            font-size: 14px;
            margin-top: 5px;
        }
        .btn { 
            padding: 12px 30px; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
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
        <h2>✏️ Edit User</h2>
        
        @if(session('error'))
            <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #ef4444;">
                {{ session('error') }}
            </div>
        @endif
        
        @if(session('success'))
            <div style="background: #d1fae5; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #10b981;">
                {{ session('success') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="role">Role *</label>
                <select id="role" name="role" required>
                    <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>User</option>
                </select>
            </div>
            
            <button type="submit" class="btn">Update User</button>
            <a href="{{ route('users.index') }}" class="back">↩️ Back</a>
        </form>
    </div>
</body>
</html>
