<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>📊 Task Manager</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <span class="nav-icon">🏠</span>
                    <span class="nav-text">Dashboard</span>
                </a>
                @auth
                    @if(Auth::user()->hasRole('admin'))
                    <a href="{{ route('users.index') }}" class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <span class="nav-icon">👥</span>
                        <span class="nav-text">Manage Users</span>
                    </a>
                    @endif
                    <a href="{{ route('tasks.index') }}" class="nav-item {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                        <span class="nav-icon">📋</span>
                        <span class="nav-text">Manage Tasks</span>
                    </a>
                @endauth
            </nav>
            <div class="sidebar-footer">
                @auth
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">{{ Auth::user()->getRoleNames()->first() }}</div>
                </div>
                <form action="/logout" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="btn-logout">🚪 Logout</button>
                </form>
                @else
                <a href="/login" class="btn-login">🔐 Login</a>
                @endauth
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="content-header">
                <h1>@yield('page-title')</h1>
                <div class="header-actions">
                    @yield('header-actions')
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('message'))
                <div class="alert alert-info">
                    {{ session('message') }}
                </div>
            @endif

            <div class="content-body">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>

