<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{

  protected $taskService;
  public function __construct(TaskService $taskService)
  {
    $this->taskService = $taskService;
  }

  use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $tasks = $this->taskService->indexTasks();
            if($tasks->isEmpty()){
                return $this->response(true,"No tasks found",[]);
            }
            return $this->response(true,"All tasks",TaskResource::collection($tasks));
        }catch(\Exception $e){
       return $this->response(false,$e->getMessage(),null,$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        
        try{
            $task = $this->taskService->createTask($data);
            return $this->response(true,"Task created successfully",new TaskResource($task),201);
         
        }catch(\Exception $e){
            return $this->response(false,$e->getMessage(),null,500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( int $id)
    {
        try{
        $task = $this->taskService->getTaskById($id);
         return $this->response(true,'Task details',new TaskResource($task));
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
        return $this->response(false,"Task not found or unauthorized",null,404);
        }catch(\Exception $e){
            return $this->response(false,$e->getMessage(),null,500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, int $id)
    {
        try{
            $data = $request->validated();
           $task = $this->taskService->updateTask($data,$id);
           if(!$task->wasChanged()){
             return $this->response(true,'No changes were made',new TaskResource($task));
           }

           return $this->response(true,"Task has been updated successfully",new TaskResource($task));

        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){

            return $this->response(false,"Task not found or unauthorized",null,404);

        }catch(\Exception $e){
         return $this->response(false,$e->getMessage(),null,500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
         $this->taskService->deleteTask($id);
         return $this->response(true,"Taks has been deleted successfully",[]);

        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
         
         return $this->response(false,"Task not fount or unauthorized " ,null,404);

        }catch(\Exception $e){
            return $this->response(false,$e->getMessage(),null,500);
        }
    }
}
