<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Show All Tasks (Only Logged-in User)
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();

        return view('tasks.index', compact('tasks'));
    }

    // Show Create Form
    public function create()
    {
        return view('tasks.create');
    }

    // Store Task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'due_date' => 'required|date'
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'pending',
            'due_date' => $request->due_date
        ]);

        return redirect()->route('tasks.index')
                         ->with('success', 'Task Created Successfully');
    }

    // Show Edit Form
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        // Security Check
        if ($task->user_id != Auth::id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    // Update Task
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|min:5'
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => $request->status,
            'due_date' => $request->due_date
        ]);

        return redirect()->route('tasks.index')
                         ->with('success', 'Task Updated Successfully');
    }

    // Delete Task
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id != Auth::id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')
                         ->with('success', 'Task Deleted Successfully');
    }
}