<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;
    
    public function index()
    {
        $totalProjects = Auth::user()->projects()->count();
        $completedTasksToday = Task::where('status', 'done')
            ->whereDate('updated_at', now())
            ->whereIn('project_id', Auth::user()->projects->pluck('id'))
            ->count();

        $projects = Auth::user()->projects;
        return view('projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
        ]);

        Auth::user()->projects()->create($validated);
        return redirect()->back()->with('success', 'Project created!');
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);
        return view('projects.show', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);
        $project->update($request->only('title', 'description', 'deadline'));
        return back()->with('success', 'Project updated!');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();
        return redirect()->route('projects.index');
    }
}
