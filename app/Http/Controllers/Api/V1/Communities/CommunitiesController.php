<?php

namespace App\Http\Controllers\Api\V1\Communities;

use App\Http\Controllers\Controller;
use App\Http\Requests\Community\CommunityRequest;
use App\Http\Resources\CommunityResource;
use App\Models\Community;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunitiesController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // - Show All communities
        try {

            return CommunityResource::collection(Community::all());
        } catch (\Exception $e) {
            return $this->error('', 'Something went wrong', 501);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommunityRequest $request)
    {
        // - Create Community
        try {
            //$request = $request->only('name', 'description');
            $community = Community::create([
                'name'        => $request->name,
                'description' => $request->description,
                'users_count' => 1,
                'created_by'  => Auth::user()->id
            ]);
            # To Join The user Who Create The Community
            $community->users()->syncWithoutDetaching(Auth::user());
            # Return The Response
            return new CommunityResource($community);
        } catch (\Exception $e) {
            return $this->error('', 'Something went wrong!', 501);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Show The Specified Community
        try {
            $community = Community::where('id', $id)->with('users')->first();
            return new CommunityResource($community);
        } catch (\Exception $e) {
            return $this->error('', 'Something went Wrong', 501);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function join(Request $request, Community $community)
    {
        try {
            $user = User::find(Auth::user()->id);
            // To Check If user already in the community
            if ($community->users->contains($user)) {
                return $this->error('', 'You are already a member of this community.', 422);
            }
            $community->users()->syncWithoutDetaching($user);
            $community->users_count += 1;
            $community->save();
            return $this->success('', 'You have successfully joined the Community!');
        } catch (\Exception $e) {
            return $this->error('', 'Something went wrong!', 501);
        }
    }


    public function leave(Request $request, Community $community)
    {
        try {
            $user = User::find(Auth::user()->id);
            // To Check If user already NOT in the community
            if (!$community->users->contains($user)) {
                return $this->error('', 'You are already not a member of this community.', 422);
            }
            $community->users()->detach($user);
            $community->users_count -= 1;
            $community->save();
            return $this->success('', 'You have successfully leaved the Community!');
        } catch (\Exception $e) {
            return $this->error('', 'Something went wrong!', 501);
        }
    }
}
