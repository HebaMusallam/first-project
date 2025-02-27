<?php

namespace App\Http\Controllers;

use Carbon\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

class TaskController extends Controller
{
    public function index():Factory|View{
        // $tasks =    DB::table('task')->get();
        $tasks = Task::all();//to retrieve all tasks use eloquent model
        return view('task', compact('tasks')); // تمرير tasks إلى الـ view
    }

    public function create(Request $request ){
        $task_name = $request->input('name');
        // DB::table('task')->insert(['name' => $task_name]);
        Task::create(['name'=>$task_name]);// to add a new task using elquent model
        return redirect()->back(); // إعادة التوجيه إلى الصفحة السابقة
    }
    public function destroy($id){
        // DB::table('task')->where('id', $id)->delete();
        $task = Task::find($id);//search for the task using elquent model
        if($task){
            $task->delete();//delete the task using elquent model
        }
        return redirect()->back(); // redirect the page after delete
    }
    public function edit($id){
        // $task = DB::table('task')->where('id', $id)->first(); // bring the task by id
        $task = Task::find($id);//find the task using eloquent model
        if ($task) {
            // $tasks = DB::table('task')->get(); // bring all tasks
            $tasks = Task::all();//bring all the task using eloquent model
            return view('task', compact('task', 'tasks')); // pass data to view
        }
        return redirect()->back()->with('error', 'Task not found');
    }
    public function update(Request $request)
{
    $id = $request->input('id'); // bring the id
    $task_name = $request->input('name'); // bring a new name to the task

    // update the task in DB
    // DB::table('task')->where('id', $id)->update(['name' => $task_name]);
    $task = Task::find($id);
    if($task){
        $task->name = $task_name;
        $task->save();
    }

    // redirect to the page after update
    return redirect()->route('task.index'); // replace by the url that view all the task
}

}
