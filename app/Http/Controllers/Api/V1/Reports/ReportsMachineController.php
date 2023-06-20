<?php

namespace App\Http\Controllers\Api\V1\Reports;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportsResource;
use App\Models\MySession;
use App\Models\Report;
use App\Models\Task;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportsMachineController extends Controller
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
        // TODO: validate the request with request file

        try {
            $report = Report::create([
                // TODO: Create The Report form coming data
            ]);
            return new ReportsResource($report);
        } catch (\Exception $e) {
            return $this->error('', 'Something went Wrong!', 501);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user, $date = null)
    {
        if ($request->date) {
            // This Function is return the statistics about user in Day
            //==============================================================
            // - User -> All Tasks
            $all_tasks        = Task::where('user_id', $user->id)->whereDate('due_date', $date)->get();
            $completed_tasks  = Task::where('user_id', $user->id)
                ->whereDate('due_date', $date)
                ->where('state', 'completed')
                ->get();
            $active_tasks = Task::where('user_id', $user->id)
                ->whereDate('due_date', $date)
                ->where('state', 'active')
                ->get();


            //==============================================================
            // - User -> Day Sessions
            $all_sessions = MySession::where('user_id', $user->id)->whereDate('end_time', $date)->get();
            $completed_sessions = MySession::where('user_id', $user->id)
                ->whereDate('end_time', $date)
                ->where('state', 'completed')
                ->get();
            $active_sessions = MySession::where('user_id', $user->id)
                ->whereDate('end_time', $date)
                ->where('state', 'active')
                ->get();


            //==============================================================
            // - Calculate How Many Hours user are spent in this day
            $hours = 0;
            $seconds = DB::table('my_sessions')->where('user_id', '=', $user->id)
                ->whereDate('end_time', $date)
                ->where('state', 'completed')
                ->selectRaw('SUM(end_time - start_time) as total')
                ->first();

            $hours = $seconds->total / 3600;
            //==============================================================
            // - Build The Response Data For Machine Learning Model
            // - it Should Take : ID

            $day = Carbon::parse($date)->toDateString();

            return response()->json([
                'id' => $user->id,
                'day' => $day,
                'attributes' => [
                    'all_tasks'          => (string) $all_tasks->count(),
                    'completed_tasks'    => (string) $completed_tasks->count(),
                    'active_tasks'       => (string) $active_tasks->count(),
                    'all_sessions'       => (string) $all_sessions->count(),
                    'completed_session'  => (string) $completed_sessions->count(),
                    'active_sessions'    => (string) $active_sessions->count(),
                    'spent_hours'        => $hours
                ],
            ]);
        }

        // - IF u Didn't Pass The Day Date
        //===================================================================

        $startWeek = Carbon::now()->startOfWeek(Carbon::SATURDAY);
        $endWeek = Carbon::now()->endOfWeek(Carbon::FRIDAY);

        // This Function is return the statistics about user in all time
        //==============================================================
        // - User -> All Tasks
        $all_tasks        = Task::where('user_id', $user->id)->whereBetween('due_date', [$startWeek, $endWeek])->get();
        $completed_tasks  = Task::where('user_id', $user->id)
            ->whereBetween('due_date', [$startWeek, $endWeek])
            ->where('state', 'completed')
            ->get();
        $active_tasks = Task::where('user_id', $user->id)
            ->whereBetween('due_date', [$startWeek, $endWeek])
            ->where('state', 'active')
            ->get();


        //==============================================================
        // - User -> All Sessions
        $all_sessions = MySession::where('user_id', $user->id)->whereBetween('end_time', [$startWeek, $endWeek])->get();
        $completed_sessions = MySession::where('user_id', $user->id)
            ->whereBetween('end_time', [$startWeek, $endWeek])
            ->where('state', 'completed')
            ->get();
        $active_sessions = MySession::where('user_id', $user->id)
            ->whereBetween('end_time', [$startWeek, $endWeek])
            ->where('state', 'active')
            ->get();


        //==============================================================
        // - Calculate How Many Hours user are spent
        $hours = 0;
        $seconds = DB::table('my_sessions')->where('user_id', '=', $user->id)
            ->whereBetween('end_time', [$startWeek, $endWeek])
            ->where('state', 'completed')
            ->selectRaw('SUM(end_time - start_time) as total')
            ->first();

        $hours = $seconds->total / 3600;
        //==============================================================
        // - Build The Response Data For Machine Learning Model
        // - it Should Take : ID for user and W For The Week

        return response()->json([
            'id' => $user->id,
            'week' => $startWeek->weekOfMonth,
            'attributes' => [
                'all_tasks'          => (string) $all_tasks->count(),
                'completed_tasks'    => (string) $completed_tasks->count(),
                'active_tasks'       => (string) $active_tasks->count(),
                'all_sessions'       => (string) $all_sessions->count(),
                'completed_session'  => (string) $completed_sessions->count(),
                'active_sessions'    => (string) $active_sessions->count(),
                'spent_hours'        => $hours
            ],
        ]);
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

    // Function To Check If User Is Authorized
    private function isNotAuthorized(Report $report)
    {
        if (Auth::user()->id !== $report->user_id) {
            return $this->error('', 'you are not authorized to make this request', 403);
        }
    }
}
