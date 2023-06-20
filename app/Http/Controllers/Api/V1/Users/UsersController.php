<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\userRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // - Show All Users
        return UserResource::collection(
            User::all()
        );
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
    public function show(User $user)
    {
        try {
            return $this->isNotAuthorized($user) ? $this->isNotAuthorized($user) : new UserResource($user);
        } catch (\Exception $e) {
            return $this->error('', 'Something Went Wrong', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(userRequest $request, User $user)
    {
        try {
            if (Auth::user()->id !== $user->id) {
                return $this->error('', 'you are not authorized to make this request', 403);
            }

            if (!$request->has('profile_picture')) {
                $user->update($request->all());
            }

            // Save Image On Cloudinary
            //$uploadedImageUrl = cloudinary()->upload($request->file('profile_picture')->getRealPath())->getSecurePath();

            //$user->update($request->all());
            //$user->update(['profile_picture' => $uploadedImageUrl]);

            return new UserResource($user);
        } catch (\Exception $e) {
            return $this->error('', 'Something went wrong!', 501);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // To Delete The Account
        try {
            return $this->isNotAuthorized($user) ? $this->isNotAuthorized($user) : $user->delete();
        } catch (\Exception $e) {
            return $this->error('', "user's Account cannot be delete right now", 405);
        }
    }

    // Function To Check If User Is Authenticated
    private function isNotAuthorized(User $user)
    {
        if (Auth::user()->id !== $user->id) {
            return $this->error('', 'you are not authorized to make this request', 403);
        }
    }
}
