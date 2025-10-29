<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // عرض كل المهام بما فيها المحذوفة مؤقتًا
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    // فورم إنشاء مهمة جديدة
    public function create()
    {
        return view('tasks.create');
    }

    // حفظ المهمة الجديدة
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'تم إضافة المهمة بنجاح ✅');
    }

    // عرض صفحة تعديل مهمة
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // تحديث بيانات المهمة
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'in:Pending,Done',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'تم تعديل المهمة بنجاح ✏️');
    }

    // حذف المهمة (Soft Delete)
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'تم حذف المهمة مؤقتًا 🗑️');
    }

    // استرجاع المهمة المحذوفة
    public function restore($id)
    {
        $task = Task::withTrashed()->findOrFail($id);
        $task->restore();
        return redirect()->route('tasks.index')->with('success', 'تم استرجاع المهمة 🔁');
    }

    // عرض تفاصيل مهمة معينة
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }
}
