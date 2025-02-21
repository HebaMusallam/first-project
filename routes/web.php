<?php

use Carbon\Factory;
//use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', action:function (): Factory|View{
    return view('welcome');
});
Route::get(uri:'/about',action:function(): Factory|View{
    $name = 'Heba';
    $departments = [
       '1' => 'Technical',
       '2' => 'Financial',
       '3' => 'Sales'
    ];
    //return View('about',['name' => $name]);
    //return View('about')->with('name',$name);
    return view('about',data:compact('name','departments'));

 });
Route::post(uri:'/about',action:function(): Factory|View{
   $name= $_POST['name'];
   $departments = [
     '1' => 'Technical',
     '2' => 'Financial',
     '3' => 'Sales'
   ];
   //return view(view:'about',data:compact(var_name:'name'));
   //return view('about',['name'=>$name]);
   //return view(about)->with('name',$name)
   return view('about',compact('name','departments'));
});
// Route::get('task',action:function(): Factory|View{
//     $task = DB::table(table:'task')->get();
//    return view(view:'task',data:compact(var_name:'task'));
// });
// Route::get(uri:'create',action:function(){
//     $task_name = $_POST['name'];
//     DB::table(table:'task')->insert(values:['name' => $task_name]);
//     return redirect()->back();
// });


// Route::post('delete/{id}', action:function ($id){

//     DB::table('task')->where('id', $id)->delete();
//     return redirect()->back();
// });

// Route::post('edit/{id}', function ($id) {
//     // جلب السجل باستخدام ID
//     $task = DB::table('task')->where('id', $id)->first();
//     // التحقق مما إذا كان السجل موجودًا
//     if ($task) {
//         // إذا تم العثور على السجل، يمكنك إرسال البيانات إلى الـ view
//         $tasks = DB::table('task')->get(); // جلب كل السجلات من جدول task
//         return view('task', compact('task', 'tasks'));
//     } else {
//         // إذا لم يتم العثور على السجل، إعادة التوجيه مع رسالة خطأ
//         return redirect()->back()->with('error', 'we dont find the record');
//     }
// });
// use App\Models\User;

// Route::get('/users', function () {
//     $users = User::all();
//     foreach ($users as $user) {
//         echo $user->id;  // عرض الـ id لكل مستخدم
//     }
// });

// Route::get(uri:'edit/{id}',action:function($id):Factory|View{
//     $task = DB::table('task')->where('id',"=",$id)->first();
//     $tasks = DB::table(table:'task')->get();
//     return view('task',data:compact(var_name:'task',var_names:'tasks'));
// });
// Route::get(uri:'update',action:function($id){
//      $id = $_POST['id'];
//      DB::table('task')->where('id',"=",$id)->update(['name'=>$_POST['name']]);
//      return redirect()->to('task');
// });

//view task
Route::get('task', function() {
    $tasks =    DB::table('task')->get();
    return view('task', compact('tasks')); // تمرير tasks إلى الـ view
});

// add a new task
Route::post('create', function (Request $request) {
    $task_name = $request->input('name');
    DB::table('task')->insert(['name' => $task_name]);
    return redirect()->back(); // إعادة التوجيه إلى الصفحة السابقة
});

// حذف مهمة
Route::post('delete/{id}', function ($id) {
    DB::table('task')->where('id', $id)->delete();
    return redirect()->back(); // إعادة التوجيه بعد الحذف
});

// Edit task
Route::get('edit/{id}', function ($id) {
    $task = DB::table('task')->where('id', $id)->first(); // جلب المهمة بواسطة الـ id
    if ($task) {
        $tasks = DB::table('task')->get(); // جلب جميع المهام
        return view('task', compact('task', 'tasks')); // تمرير البيانات إلى الـ view
    }
    return redirect()->back()->with('error', 'Task not found');
});

// update task
Route::post('update', function (Request $request) {
    $id = $request->input('id');
    $task_name = $request->input('name');

    DB::table('task')->where('id', $id)->update(['name' => $task_name]);

    return redirect()->to('task'); // إعادة التوجيه إلى صفحة المهام بعد التحديث
});

?>

