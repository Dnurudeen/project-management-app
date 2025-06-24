<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Project $project)
    {
        $this->authorize('view', $project);
        $request->validate(['title' => 'required|string']);
        $project->tasks()->create($request->only('title', 'status', 'due_date'));
        return back()->with('success', 'Task added!');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string',
            'status' => 'required|in:pending,in_progress,done',
            'due_date' => 'nullable|date',
        ]);
        
        $task->update($request->only('title', 'status', 'due_date'));
        return back()->with('success', 'Task updated!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('success', 'Task deleted!');
    }

    public function filter(Request $request, Project $project)
    {
        $query = $project->tasks();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('due_date')) {
            $query->whereDate('due_date', $request->due_date);
        }

        $tasks = $query->get();

        return view('projects.show', [
            'project' => $project,
            'tasks' => $tasks,
        ]);
    }
}
