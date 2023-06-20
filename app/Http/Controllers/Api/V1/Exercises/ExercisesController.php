<?php

namespace App\Http\Controllers\Api\V1\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exercise\StoreExerciseRequest;
use App\Http\Resources\ExercisesResource;
use App\Models\Exercise;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class ExercisesController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return ExercisesResource::collection(Exercise::all());
        }catch(\Exception $e) {
            return $this->error('', 'Something went Wrong', 501);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExerciseRequest $request)
    {
        try {
            $request->validated($request->all());
            $coverName = 'assets/exercises/covers/' . $request->file('cover')->getClientOriginalName();

            // Save Image On local Storage
            //Storage::disk('public')->put($coverName, file_get_contents($request->cover));

            // Save Image On Cloudinary
            //$uploadedImageUrl = cloudinary()->upload($request->file('cover')->getRealPath())->getSecurePath();

            // Create Exercise
            $exercise = Exercise::create([
                'name'        => $request->name,
                'description' => $request->description,
                'body_part'   => $request->body_part,
                'repetitions' => $request->repetitions,
                'sets'        => $request->sets,
                'duration'    => $request->duration,
                'cover'       => $coverName,
                'link'        => $request->link
            ]);

            // Make The Exercise Resource
            $exercise = new ExercisesResource($exercise);

            // Return Success Response
            return $this->success($exercise, 'You have successfully added New Exercise.', 201);
        } catch (\Exception $e) {
            // Return JSON Response
            return $this->error('', 'Something went Wrong'. $e, 501);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise)
    {
        return new ExercisesResource($exercise);
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
