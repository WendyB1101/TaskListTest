<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $tasks = $query->latest()->paginate(10)->withQueryString();

        return view('tasks.index', [
            'tasks'    => $tasks,
            'statuses' => Task::STATUSES,
        ]);
    }

    public function create()
    {
        return view('tasks.create', ['statuses' => Task::STATUSES]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:new,in_progress,done',
        ]);

        Task::create($request->only('title', 'description', 'status'));

        return redirect()->route('tasks.index')->with('success', 'Задача создана.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', ['task' => $task, 'statuses' => Task::STATUSES]);
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' => $task, 'statuses' => Task::STATUSES]);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:new,in_progress,done',
        ]);

        $task->update($request->only('title', 'description', 'status'));

        return redirect()->route('tasks.show', $task)->with('success', 'Задача обновлена.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Задача удалена.');
    }

    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:new,in_progress,done',
        ]);

        $task->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Статус обновлён.');
    }
}
