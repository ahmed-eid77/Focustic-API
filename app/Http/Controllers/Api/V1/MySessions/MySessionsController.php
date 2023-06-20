<?php

namespace App\Http\Controllers\Api\V1\MySessions;

use App\Http\Controllers\Controller;
use App\Http\Requests\MySession\MySessionRequest;
use App\Http\Resources\MySessionResource;
use App\Models\MySession;
use App\Models\Task;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MySessionsController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return MySessionResource::collection(
                MySession::where('user_id', Auth::user()->id)->with('tasks')->get()
            );
        } catch (\Exception $e) {
            return $this->error('', 'Something went wrong!', 501);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MySessionRequest $request)
    {
        // TODO: Ask The Way they want to add the task to the session
        //=============================================================
        try {
            $request->validated($request->all());
            $tasks = Task::where('user_id', Auth::user()->id)
                ->whereIn('id', $request->task_id)
                ->get();
            $mySession = MySession::create([
                'user_id'       => Auth::user()->id,
                'name'          => $request->name,
                'state'         => $request->state,
                'start_time'    => $request->start_time,
                'end_time'      => $request->end_time
            ]);
            $mySession->tasks()->syncWithoutDetaching($tasks);
            return new MySessionResource($mySession);
        } catch (\Exception $e) {
            return $this->error('', 'Something went wrong!', 501);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MySession $mySession)
    {
        try {
            $my_Session = MySession::where('id', $mySession->id)->with('tasks')->first();
            return $this->isNotAuthorized($mySession) ? $this->isNotAuthorized($mySession) : new MySessionResource($my_Session);
        } catch (\Exception $e) {
            return $this->error('', 'Something went wrong!', 501);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MySession $mySession)
    {
        try {
            if (Auth::user()->id !== $mySession->user_id) {
                return $this->error('', 'you are not authorized to make this request', 403);
            }
            if ($request->task_id) {
                $tasks = Task::where('user_id', Auth::user()->id)
                    ->whereIn('id', $request->task_id)
                    ->get();
                $mySession->update($request->all());
                $mySession->tasks()->syncWithoutDetaching($tasks);
                $my_Session = MySession::where('id', $mySession->id)->with('tasks')->first();
                return new MySessionResource($my_Session);
            }
            $mySession->update($request->all());
            $my_Session = MySession::where('id', $mySession->id)->with('tasks')->first();
            return new MySessionResource($my_Session);
        } catch (\Exception $e) {
            return $this->error('', 'Something went wrong!', 501);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MySession $mySession)
    {
        try {
            return $this->isNotAuthorized($mySession) ? $this->isNotAuthorized($mySession) : $mySession->delete();
        } catch (\Exception $e) {
            return $this->error('', 'Cannot delete right now', 405);
        }
    }

    // Function To Check If User Is Authenticated
    private function isNotAuthorized(MySession $mySession)
    {
        if (Auth::user()->id !== $mySession->user_id) {
            return $this->error('', 'you are not authorized to make this request', 403);
        }
    }

}
