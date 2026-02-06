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

        $kitsDistributed = KitStatus::where('kit_received', 1)->count();

        $pendingDistribution = KitStatus::where('kit_received', 0)->count();

        $query = KitStatus::select('kit_statuses.*')
            ->leftJoin('team_registration_infos', 'kit_statuses.team_id', '=', 'team_registration_infos.team_id')
            ->addSelect('team_registration_infos.team_name');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('team_registration_infos.team_name', 'like', "%{$q}%");
        }

        if ($request->filled('filter') && $request->filter !== '') {
            $filter = $request->filter;
            if (in_array($filter, ['0', '1'])) {
                $query->where('kit_statuses.kit_received', $filter);
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
        $insert = KitStatus::create([
            'kit_id' => $request->kitid,
            'team_id' => $request->teamid,
            'kit_received' => $request->kitreceived,
            'received_date' => $request->receiveddate,
            'comments' => $request->comments,

        ]);

        return redirect('/admin/dashboard/kitstatus')->with('success', 'Kit received successfully');
    }
    public function update(Request $request, $id)
    {
        $kit = KitStatus::findOrFail($id);

        $kit->update([
            'kit_received' => $request->kit_received,
            'received_date' => $request->received_date,
            'comments' => $request->comments,
        ]);

        return redirect()->back()->with('success', 'Kit status updated successfully');
    }
}