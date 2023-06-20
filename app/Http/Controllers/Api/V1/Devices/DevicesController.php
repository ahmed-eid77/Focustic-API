<?php

namespace App\Http\Controllers\Api\V1\Devices;

use App\Http\Controllers\Controller;
use App\Http\Resources\DevicesResource;
use App\Models\Device;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DevicesController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Function To return all Sensor date for the user
        // TODO: Remember I hard coded the id for sending date => id = 1
        //=============================================================
       try {
            return DevicesResource::collection(
                Device::where('user_id', Auth::user()->id)->get()
        );
       } catch(\Exception $e) {
            return $this->error('', 'Something went wrong!', 500);
       }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // The Function OF Storing Date for Sensors only
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
    public function destroy($user_id)
    {
        // - Function To Clear All Sensor Data For The Specified use
        // - Take user Id And to Check if Authorized or not to delete all Sensor data
        //============================================================================
        try{
            if(Auth::user()->id == $user_id){
                $user_device_data = Device::where('user_id', $user_id)->get();
                $ids = $user_device_data->pluck('id');
                Device::destroy($ids);
                return $this->success('', 'Deleted Successfully', 200);
            }else {
                return $this->error('', 'Cannot delete right now', 405);
            }
        } catch (\Exception $e){
            return $this->error('', 'Something went wrong!', 501);
        }
    }
}
