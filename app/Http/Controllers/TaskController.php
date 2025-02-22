<?php

namespace App\Http\Controllers;

use Carbon\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class TaskController extends Controller
{
    public function index():Factory|View{
        $tasks =    DB::table('task')->get();
        return view('task', compact('tasks')); // تمرير tasks إلى الـ view
    }

    public function create(Request $request ){
        $task_name = $request->input('name');
        DB::table('task')->insert(['name' => $task_name]);
        return redirect()->back(); // إعادة التوجيه إلى الصفحة السابقة
    }
    public function destroy($id){
        DB::table('task')->where('id', $id)->delete();
        return redirect()->back(); // redirect the page after delete
    }
    public function edit($id){
        $task = DB::table('task')->where('id', $id)->first(); // bring the task by id
        if ($task) {
            $tasks = DB::table('task')->get(); // bring all tasks
            return view('task', compact('task', 'tasks')); // pass data to view
        }
        return redirect()->back()->with('error', 'Task not found');
    }
    public function update(Request $request)
{
    $id = $request->input('id'); // bring the id
    $task_name = $request->input('name'); // bring a new name to the task

    // update the task in DB
    DB::table('task')->where('id', $id)->update(['name' => $task_name]);

    // redirect to the page after update
    return redirect()->route('task.index'); // replace by the url that view all the task
}

}
