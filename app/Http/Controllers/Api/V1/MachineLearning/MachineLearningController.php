<?php

namespace App\Http\Controllers\Api\V1\MachineLearning;

use App\Http\Controllers\Controller;
use App\Http\Resources\MachineLearningResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class MachineLearningController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id = null)
    {
        try {
            if ($id === null) {
                $users = User::with('tasks')->get();
                return MachineLearningResource::collection($users);
            } else {
                $user = User::where('id', $id)->with('tasks')->first();
                return new MachineLearningResource($user);
            }
        } catch (\Exception $e) {
            return $this->error('', 'Something Went Wrong!', 501);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
