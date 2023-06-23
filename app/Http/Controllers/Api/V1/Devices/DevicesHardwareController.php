<?php

namespace App\Http\Controllers\Api\V1\Devices;

use App\Http\Controllers\Controller;
use App\Http\Requests\Device\DeviceRequest;
use App\Http\Resources\DevicesResource;
use App\Models\Device;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class DevicesHardwareController extends Controller
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
    public function store(DeviceRequest $request)
    {
        // - Function: To Store Hardware Date
        //=============================================
        try {
            $request->validated($request->all());

            $device = Device::create([
                'user_id'     => 102,
                'rotation_x'  => (float) $request->json("rotation_x"),
                'rotation_y'  => (float) $request->json("rotation_y"),
                'rotation_z'  => (float) $request->json("rotation_z"),
                'ultrasonic'  => (float) $request->json("ultrasonic"),
            ]);
            return new DevicesResource($device);
        } catch (\Exception $e) {
            return $this->error('', 'Something Went Wrong', 501);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
