<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // public function test()
    // {
    //     return view('test');
    // }
    public function create()
    {
        $tasks = Task::orderBy('priority', 'asc')->get();
        return view('tasks/index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        // echo $request->name. "||"; 
        // echo $request->priority;
        // exit;
        Task::create(['task_name' => $request->name, 'priority' => $request->priority]);
        return redirect('http://localhost:8989/create');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $task->update(['task_name' => $request->name, 'priority' => $request->priority]);
        //return redirect()->route('tasks.index');
        return redirect('http://localhost:8989/create');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        //return redirect()->route('tasks.index');
        return redirect('http://localhost:8989/create');
    }

    public function reorder(Request $request)
    {
        $ids = $request->input('ids', []);
        foreach ($ids as $index => $id) {
            Task::where('id', $id)->update(['priority' => $index + 1]);
        }
        return response()->json(['status' => 'success']);
    }
}