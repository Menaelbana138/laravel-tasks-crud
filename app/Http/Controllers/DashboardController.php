<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Initialize variables
        $totalUsers = 0;
        $totalAdmins = 0;
        $totalRegularUsers = 0;
        $recentUsers = collect();

        // Statistics for admin
        if (Auth::user()->hasRole('admin')) {
            $totalUsers = User::count();
            $totalAdmins = User::role('admin')->count();
            $totalRegularUsers = User::role('user')->count();
            $recentUsers = User::latest()->take(5)->get();
        }

        // Statistics for all users
        $totalTasks = Task::count();
        $pendingTasks = Task::where('status', 'Pending')->count();
        $completedTasks = Task::where('status', 'Done')->count();
        $recentTasks = Task::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalRegularUsers',
            'recentUsers',
            'totalTasks',
            'pendingTasks',
            'completedTasks',
            'recentTasks'
        ));
    }
}

