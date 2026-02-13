<?php 
namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class TaskService {
    public function createTask(array $request){
        $user_id = Auth::id();
        $task = Task::create([
       'title'=> $request['title'],
       'description'=>$request['description']??null,
       'is_high_priority'=>$request['is_high_priority']??false,
       'is_done'=>false,
       'user_id'=>$user_id,
        ]);
        return $task;
    }


    public function indexTasks(){
     $user_id = Auth::id();
     $tasks = Task::where('user_id',$user_id)->orderBy('created_at','desc')->paginate(10);
     return $tasks;
    }

    public function getTaskById($id){
        $task = Task::where(['id'=>$id,'user_id'=>Auth::id()])->firstOrFail();
      
        return $task;

    }

    public function deleteTask($id){
        $task = Task::where(['id'=>$id,'user_id'=>Auth::id()])->firstOrFail();
        $task->delete();
    }

    public function updateTask(array $request,$id){
        $task = Task::where(['id'=>$id,"user_id"=>Auth::id()])->firstOrFail();
        $task->update($request);
       return $task;
    }
}