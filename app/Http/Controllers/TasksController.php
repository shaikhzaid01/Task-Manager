<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

use function Pest\Laravel\get;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        // return $task;
        return view('taskList', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addtask');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $request->user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'Pending', // better default than Active
        ]);

        return redirect()->route('task.list')->with('success', 'Task created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        // return $task;
        return view('editTask', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,Active,Completed',
        ]);

        $task = $request->user()->tasks()->findOrFail($id);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('task.list')->with('success', 'Task updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);
        $task->delete();

        return redirect()->route('task.list')->with('success', 'Task deleted successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);

        $request->validate([
            'status' => 'required|in:Active,Pending,Completed',
        ]);

        $task->status = $request->status;
        $task->save();

        return redirect()->back()->with('success', 'Task status updated successfully!');
    }



    public function search(Request $request)
    {
        $query = $request->user()->tasks()->latest();
        $search = $request->search;
        $status = $request->status;
        if (!empty($search)) {
            $query->where('title', 'like', '%' . $search . '%');
        }
        if (!empty($status)) {
            $query->where('status', $status);
        }

        $tasks = $query->get();

        return view('taskList', compact('tasks', 'search', 'status'));
    }
}
