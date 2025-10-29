<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container { 
            max-width: 1200px; 
            margin: 0 auto; 
            background: white; 
            padding: 30px; 
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e5e7eb;
        }
        h2 { 
            color: #1f2937; 
            font-size: 28px;
            font-weight: 600;
        }
        .btn { 
            padding: 12px 24px; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; 
            text-decoration: none; 
            border-radius: 8px; 
            display: inline-block; 
            margin-left: 10px;
            transition: transform 0.2s, box-shadow 0.2s;
            font-weight: 500;
        }
        .btn:hover { 
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-secondary {
            background: #6b7280;
        }
        .success { 
            background: #d1fae5; 
            color: #065f46; 
            padding: 15px; 
            border-radius: 8px; 
            margin-bottom: 20px;
            border-left: 4px solid #10b981;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
            background: white;
        }
        th, td { 
            padding: 15px; 
            text-align: left; 
            border-bottom: 1px solid #e5e7eb;
        }
        th { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; 
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        tr:hover { 
            background: #f9fafb;
        }
        .role-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .role-admin {
            background: #fef3c7;
            color: #92400e;
        }
        .role-user {
            background: #dbeafe;
            color: #1e40af;
        }
        .actions a { 
            margin: 0 5px; 
            padding: 8px 16px; 
            text-decoration: none; 
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.2s;
        }
        .edit { 
            background: #3b82f6; 
            color: white;
        }
        .edit:hover {
            background: #2563eb;
        }
        .delete-btn { 
            background: #ef4444; 
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
        }
        .delete-btn:hover {
            background: #dc2626;
        }
        .no-data {
            text-align: center;
            padding: 40px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>👥 Users Management</h2>
            <div>
                <a href="{{ route('users.create') }}" class="btn">➕ Add New User</a>
                <a href="{{ route('home') }}" class="btn btn-secondary">🏠 Home</a>
            </div>
        </div>
        
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="role-badge role-{{ strtolower($user->getRoleNames()->first()) }}">
                            {{ $user->getRoleNames()->first() }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="edit">✏️ Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?')">🗑️ Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="no-data">
                        No users found. Click "Add New User" to create one!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
