<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('home')->middleware('auth');

// تسجيل الدخول والخروج
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// إصلاح أدوار المستخدمين - مؤقت
Route::get('/fix-roles', function () {
    // إنشاء الأدوار إذا لم تكن موجودة
    Role::firstOrCreate(['name' => 'admin']);
    Role::firstOrCreate(['name' => 'user']);
    
    // إصلاح حساب Admin
    $admin = User::where('email', 'admin@example.com')->first();
    if ($admin) {
        $admin->syncRoles(['admin']);
        echo "✅ تم تحديث حساب Admin بنجاح! الدور الآن: " . $admin->getRoleNames()->first() . "<br>";
    } else {
        echo "❌ لم يتم العثور على حساب admin@example.com<br>";
    }
    
    // إصلاح حساب User
    $user = User::where('email', 'user@example.com')->first();
    if ($user) {
        $user->syncRoles(['user']);
        echo "✅ تم تحديث حساب User بنجاح! الدور الآن: " . $user->getRoleNames()->first() . "<br>";
    }
    
    echo "<br><a href='/login' style='padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px;'>تسجيل الدخول</a>";
});

// CRUD Users - محمي بالـ admin فقط
Route::middleware(['auth', 'role:admin'])->prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});

// CRUD Tasks - محمي بحاجة لتسجيل الدخول
Route::middleware(['auth'])->prefix('tasks')->name('tasks.')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::get('/create', [TaskController::class, 'create'])->name('create');
    Route::post('/', [TaskController::class, 'store'])->name('store');
    Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('edit');
    Route::put('/{task}', [TaskController::class, 'update'])->name('update');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('destroy');
    Route::get('/{task}', [TaskController::class, 'show'])->name('show');
    Route::post('/{task}/restore', [TaskController::class, 'restore'])->name('restore');
});
