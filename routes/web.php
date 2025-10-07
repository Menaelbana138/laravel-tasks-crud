<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// تحويل الصفحة الرئيسية إلى قائمة المهام
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// CRUD الأساسي
Route::resource('tasks', TaskController::class);

//  Route خاص باسترجاع المهام المحذوفة
Route::get('tasks/{id}/restore', [TaskController::class, 'restore'])->name('tasks.restore');
