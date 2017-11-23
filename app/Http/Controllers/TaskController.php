<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use EllipseSynergie\ApiResponse\Contracts\Response;
use App\Task;
use App\Transformer\TaskTransformer;

class TaskController extends Controller
{

    protected $response;
    
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function index()
    {
        $tasks = Task::paginate(15);
        return $this->response->withPaginator($tasks, new TaskTransformer());
    }

    public function store(Request $request)
    {
        if ($request->isMethod('put')) {
            $task = Task::find($request->task_id);
                if (!$task) {
                    return $this->response->errorNotFound('Task Not Found');}
                } else {
            $task = new Task; }
            $task->id = $request->input('task_id');
            $task->name = $request->input('name');
            $task->description = $request->input('description');
            $task->user_id = $request->user_id;
                if($task->save()) {
                    return $this->response->withItem($task, new TaskTransformer());
                } else {
                    return $this->response->errorInternalError('Could not updated/created a task');
        }
    }
    
    public function show($id)
    {
        $task = Task::find($id);
        if (!$task) {
        return $this->response->errorNotFound('Task Not Found'); }
        return $this->response->withItem($task, new TaskTransformer());
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        if (!$task) {
        return $this->response->errorNotFound('Task Not Found'); }
        if($task->delete()) {
        return $this->response->withItem($task, new TaskTransformer());
        } else {
        return $this->response->errorInternalError('Could not delete a task');
        }
    }
}
