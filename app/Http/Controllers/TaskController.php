<?php

namespace App\Http\Controllers;

use App\Models\task;
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

        if ($request->task == null) {
            abort(404);
    }

            $newTask->tasks = $request->task; //! $request->task is referring to the name="" in our view 
            $newTask->is_complete = 0;
            $newTask->task_date = date("Y-m-d");
            
            if($request->day === "tomorrow") {

                $date = date_create(date("Y-m-d"));
                date_add($date, date_interval_create_from_date_string("2 days"));
                $newTask->date_of_completion = date_format($date, "Y-m-d");
                
            } elseif($request->day === "today") {

                $newTask->date_of_completion = date("Y-m-d");
            }
            
            $newTask->save(); //^ Do this to save it into our database.
            return redirect('/');
      
        /* return view('mainpage', ['tasks' => task::all()]); *///& confirm resubmission will always pop up using this, therefore we redirect to main route

         //* after saving item when we click the button, it will redirect us to our default route.
    }
    public function index(/* Task $task */)
    {   
       /*  $currentDate = date_create(date("Y-m-d"));
        $taskDate = date_create($task->date);
        $date_differences = date_diff($currentDate, $taskDate); */
        
        return view('mainpage', [
            /* 'date_differences' => $date_differences, */
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
    } /* catch (\Exception $e) {

        return redirect()->withErrors(['msg' => 'The Error: '.$e->getMessage()]);
    
    } */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(task $task)
    {
        //
    }
}
