<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\KitStatus;
use App\Models\TeamRegistration;
use Illuminate\Http\Request;

class KitStatusController extends Controller
{
    public function index(Request $request = null)
    {
        $request = $request ?? request();

        $totalTeams = TeamRegistration::count();

        $kitsDistributed = KitStatus::join('team_registration_infos', 'kit_statuses.team_id', '=', 'team_registration_infos.team_id')
            ->where('kit_statuses.kit_received', 1)->count();

        $pendingDistribution = $totalTeams - $kitsDistributed;

        $query = TeamRegistration::select(
                'team_registration_infos.team_id',
                'team_registration_infos.team_name',
                'kit_statuses.kit_id',
                'kit_statuses.kit_received',
                'kit_statuses.received_date',
                'kit_statuses.comments'
            )
            ->leftJoin('kit_statuses', 'team_registration_infos.team_id', '=', 'kit_statuses.team_id');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('team_registration_infos.team_name', 'like', "%{$q}%");
        }

        if ($request->filled('filter') && $request->filter !== '') {
            $filter = $request->filter;
            if ($filter === '1') {
                $query->where('kit_statuses.kit_received', 1);
            } elseif ($filter === '0') {
                $query->where(function($q) {
                    $q->where('kit_statuses.kit_received', 0)
                      ->orWhereNull('kit_statuses.kit_received');
                });
            }
        }

        $kits = $query->orderBy('team_registration_infos.team_name')->paginate(15)->withQueryString();

        return view('admin.kitstatus.kitstatus', compact(
            'totalTeams',
            'kitsDistributed',
            'pendingDistribution',
            'kits'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kitid' => 'nullable|string|max:255',
            'teamid' => 'required|exists:team_registration_infos,team_id',
            'kitreceived' => 'required|boolean',
            'receiveddate' => 'nullable|date',
            'comments' => 'nullable|string'
        ]);

        $insert = KitStatus::create([
            'kit_id' => $request->kitid,
            'team_id' => $request->teamid,
            'kit_received' => $request->kitreceived,
            'received_date' => $request->receiveddate,
            'comments' => $request->comments,
        ]);

        return redirect('/admin/dashboard/kitstatus')->with('success', 'Kit Received Successfully');
    }

    public function update(Request $request, $team_id)
    {
        $request->validate([
            'kit_received' => 'required|boolean',
            'received_date' => 'nullable|date',
            'comments' => 'nullable|string'
        ]);

        KitStatus::updateOrCreate(
            ['team_id' => $team_id],
            [
                'kit_received' => $request->kit_received,
                'received_date' => $request->received_date,
                'comments' => $request->comments,
            ]
        );

        return redirect()->back()->with('success', 'Kit Status Updated Successfully');
    }
}