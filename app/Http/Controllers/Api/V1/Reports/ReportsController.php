<?php

namespace App\Http\Controllers\Api\V1\Reports;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportsResource;
use App\Models\Report;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    use HttpResponses;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // For Return All Reports User Have
        try {
            return ReportsResource::collection(
                Report::where('user_id', Auth::user()->id)->get()
            );
        }catch (\Exception $e){
            return $this->error('', 'Something went wrong!', 401);
        }
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
    public function show(Report $report)
    {
        // function for Show The Specific Report
        //====================================================

        // TODO: Make The Validation

        try{
            return $this->isNotAuthorized($report) ? $this->isNotAuthorized($report) : new ReportsResource($report);
        }catch(\Exception $e) {
            return $this->error('', 'Something went Wrong!', 500);
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
    public function destroy(Report $report)
    {
        // For Deleting The specified Report if the user Authorized
        return $this->isNotAuthorized($report) ? $this->isNotAuthorized($report) : $report->delete();
    }

    // Function To Check If User Is Authorized
    private function isNotAuthorized(Report $report){
        if(Auth::user()->id !== $report->user_id){
            return $this->error('', 'you are not authorized to make this request', 403);
        }
    }
}
