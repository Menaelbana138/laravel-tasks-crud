<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: white;
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 600px;
            width: 100%;
        }
        h1 {
            color: #1f2937;
            margin-bottom: 30px;
            font-size: 36px;
        }
        .user-info {
            background: #f9fafb;
            padding: 25px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        .user-info p {
            margin: 10px 0;
            color: #374151;
            font-size: 16px;
        }
        .user-info strong {
            color: #667eea;
        }
        .role-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin-top: 5px;
        }
        .role-admin {
            background: #fef3c7;
            color: #92400e;
        }
        .role-user {
            background: #dbeafe;
            color: #1e40af;
        }
        .message {
            background: #dbeafe;
            border: 2px solid #3b82f6;
            color: #1e40af;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            padding: 14px 28px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin: 10px;
            transition: transform 0.2s, box-shadow 0.2s;
            font-weight: 500;
            font-size: 16px;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-secondary {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        .btn-danger {
            background: #ef4444;
        }
        .btn-danger:hover {
            background: #dc2626;
        }
        .login-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏠 Welcome to Dashboard</h1>
        
        @auth
            <div class="user-info">
                <p><strong>Welcome:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Role:</strong> 
                    <span class="role-badge role-{{ strtolower(Auth::user()->getRoleNames()->first()) }}">
                        {{ Auth::user()->getRoleNames()->first() }}
                    </span>
                </p>
            </div>
            
            @if(session('message'))
                <div class="message">{{ session('message') }}</div>
            @endif
            
            @if(Auth::user()->hasRole('admin'))
                <a href="{{ route('users.index') }}" class="btn">👥 Manage Users</a>
            @endif
            
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">📋 Manage Tasks</a>
            
            <form action="/logout" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="btn btn-danger">🚪 Logout</button>
            </form>
        @else
            <p style="color: #6b7280; margin-bottom: 20px;">Please login to access the system</p>
            <a href="/login" class="btn login-btn">🔐 Login</a>
        @endauth
    </div>
</body>
</html>
