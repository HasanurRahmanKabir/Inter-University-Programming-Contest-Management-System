<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Contest;
use App\Models\TeamRegistration;
use App\Models\KitStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VolunteersController extends Controller
{
    public function index()
    {
        $volunteer = Auth::guard('volunteer')->user();
        $contest = Contest::latest('contest_id')->first();
        $teams = TeamRegistration::leftJoin('kit_statuses', 'team_registration_infos.team_id', '=', 'kit_statuses.team_id')
            ->select(
                'team_registration_infos.*',
                'kit_statuses.kit_received'
            )
            ->get();

        return view('website.volunteer.volunteer', compact('volunteer', 'teams', 'contest'));
    }

    public function saveKitStatus(Request $request)
    {
        try {
            $request->validate([
                'team_id' => 'required|integer',
                'kit_received' => 'required|in:0,1',
            ]);

            KitStatus::updateOrCreate(
                ['team_id' => $request->team_id],
                [
                    'kit_received' => $request->kit_received,
                    'received_date' => now()
                ]
            );

            return response()->json(['success' => true, 'message' => 'Kit status updated!']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
