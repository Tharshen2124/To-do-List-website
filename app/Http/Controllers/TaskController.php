<?php

namespace App\Http\Controllers;

use App\Models\task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveItem(Request $request) {

        $newTask = new task; //? task in here represents the model

         $request->validate([
            'task' => 'required',
        ]);

        $newTask->tasks = $request->task;
            
        $newTask->is_complete = 0;

        if($request->day === "today") {
            $newTask->date_of_completion = now()->addDay();
        } elseif ($request->day === "tomorrow") {
            $newTask->date_of_completion = now()->addDays(2);
        }

        $newTask->save();
        return redirect('/');

    }
    public function index(/* Task $task */)
    {   
        
        return view('mainpage', [
            'currentTime' => Carbon::now(),
            'tasks' => task::where('is_complete', 0)->get(),
            'completedTasks' => task::where('is_complete', 1)->get()
        ]);
    }

    public function markComplete($id)
    {
        $completedTask = task::find($id);
        $completedTask->is_complete = 1;
        $completedTask->save();
        return redirect('/');
    }

    public function editRoute(Task $task) {

        return view('edit', [
            'task' => $task
        ]);

    }

    public function updateRoute(Request $request, Task $task) {
 
        $task->tasks = $request->task;
        $task->save();

        return redirect('/');
    }

    public function deleteRoute(Task $task) {
 
        $task->delete();
 
        return redirect('/');
    }
} 
