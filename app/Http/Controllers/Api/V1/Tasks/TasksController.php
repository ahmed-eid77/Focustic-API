<?php

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Resources\TasksResource;
use App\Models\Task;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return TasksResource::collection(
                Task::where('user_id', Auth::user()->id)->get()
            );
        }catch(\Exception $e) {
            return $this->error('', 'Something went wrong!', 501);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $request->validated($request->all());
            $task = Task::create([
                'user_id'       => Auth::user()->id,
                'name'          => $request->name,
                'note'          => $request->note,
                'state'         => $request->state,
                'duration'      => $request->duration,
                'initiated_at'  => $request->initiated_at,
                'due_date'      => $request->due_date,
                'kind'          => $request->kind,
                'reminder'      => $request->reminder,
                'reminder_date' => $request->reminder_date,
                'repeat'        => $request->repeat
            ]);
            return new TasksResource($task);
        }catch(\Exception $e) {
            return $this->error('', 'Something went wrong!', 501);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        try{
            return $this->isNotAuthorized($task) ? $this->isNotAuthorized($task) : new TasksResource($task);
        }catch(\Exception $e) {
            return $this->error('', 'Something went wrong!', 501);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        try {
            if(Auth::user()->id !== $task->user_id){
                return $this->error('', 'you are not authorized to make this request', 403);
            }
            $task->update($request->all());
            return new TasksResource($task);
        }catch(\Exception $e) {
            return $this->error('', 'Something went wrong!', 501);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            return $this->isNotAuthorized($task) ? $this->isNotAuthorized($task) : $task->delete();
        }catch(\Exception $e){
            return $this->error('', 'Cannot delete right now', 405);
        }
    }

    // Function To Check If User Is Authenticated
    private function isNotAuthorized(Task $task){
        if(Auth::user()->id !== $task->user_id){
            return $this->error('', 'you are not authorized to make this request', 403);
        }
    }
}
