@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', '📊 Dashboard')

@section('content')
<style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }
        .stat-card.users::before { background: linear-gradient(90deg, #3b82f6, #2563eb); }
        .stat-card.admins::before { background: linear-gradient(90deg, #f59e0b, #d97706); }
        .stat-card.tasks::before { background: linear-gradient(90deg, #10b981, #059669); }
        .stat-card.pending::before { background: linear-gradient(90deg, #f59e0b, #d97706); }
        .stat-card.completed::before { background: linear-gradient(90deg, #10b981, #059669); }
        .stat-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        .stat-title {
            color: #6b7280;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }
        .stat-value {
            color: #1f2937;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .stat-change {
            color: #10b981;
            font-size: 14px;
        }
        .recent-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .recent-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .recent-card h3 {
            color: #1f2937;
            font-size: 20px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e5e7eb;
        }
        .recent-item {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .recent-item:last-child {
            border-bottom: none;
        }
        .recent-item:hover {
            background: #f9fafb;
        }
    </style>

        <div class="stats-grid">
            @if(Auth::user()->hasRole('admin'))
            <div class="stat-card users">
                <div class="stat-icon">👥</div>
                <div class="stat-title">Total Users</div>
                <div class="stat-value">{{ $totalUsers }}</div>
                <div class="stat-change">+{{ $totalAdmins }} admins</div>
            </div>

            <div class="stat-card admins">
                <div class="stat-icon">👤</div>
                <div class="stat-title">Regular Users</div>
                <div class="stat-value">{{ $totalRegularUsers }}</div>
                <div class="stat-change">Active accounts</div>
            </div>
            @endif

            <div class="stat-card tasks">
                <div class="stat-icon">📋</div>
                <div class="stat-title">Total Tasks</div>
                <div class="stat-value">{{ $totalTasks }}</div>
                <div class="stat-change">All tasks</div>
            </div>

            <div class="stat-card pending">
                <div class="stat-icon">⏳</div>
                <div class="stat-title">Pending Tasks</div>
                <div class="stat-value">{{ $pendingTasks }}</div>
                <div class="stat-change">In progress</div>
            </div>

            <div class="stat-card completed">
                <div class="stat-icon">✅</div>
                <div class="stat-title">Completed Tasks</div>
                <div class="stat-value">{{ $completedTasks }}</div>
                <div class="stat-change">{{ $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0 }}% completion rate</div>
            </div>
        </div>

        <div class="recent-section">
            @if(Auth::user()->hasRole('admin'))
            <div class="recent-card">
                <h3>👥 Recent Users</h3>
                @forelse($recentUsers as $user)
                <div class="recent-item">
                    <div>
                        <div style="font-weight: 600; color: #1f2937;">{{ $user->name }}</div>
                        <div style="font-size: 14px; color: #6b7280;">{{ $user->email }}</div>
                    </div>
                    <span class="role-badge role-{{ strtolower($user->getRoleNames()->first()) }}">
                        {{ $user->getRoleNames()->first() }}
                    </span>
                </div>
                @empty
                <div style="color: #6b7280; text-align: center; padding: 20px;">
                    No users yet
                </div>
                @endforelse
            </div>
            @endif

            <div class="recent-card">
                <h3>📋 Recent Tasks</h3>
                @forelse($recentTasks as $task)
                <div class="recent-item">
                    <div>
                        <div style="font-weight: 600; color: #1f2937;">{{ $task->title }}</div>
                        <div style="font-size: 14px; color: #6b7280;">{{ Str::limit($task->description ?? 'No description', 40) }}</div>
                    </div>
                    <span style="padding: 6px 12px; border-radius: 20px; color: white; font-size: 12px; font-weight: 600; background: {{ $task->status == 'Done' ? '#10b981' : '#f59e0b' }}">
                        {{ $task->status }}
                    </span>
                </div>
                @empty
                <div style="color: #6b7280; text-align: center; padding: 20px;">
                    No tasks yet
                </div>
                @endforelse
            </div>
        </div>

@endsection

