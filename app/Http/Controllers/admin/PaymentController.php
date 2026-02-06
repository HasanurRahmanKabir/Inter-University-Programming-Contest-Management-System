<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\TeamRegistration;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index()
    {
        $request = request();

        $totalCollected = Payment::where('payment_status', 1)->sum('amount');
        $pendingVerification = Payment::where('payment_status', 0)->count();
        $todaysCollection = Payment::where('payment_status', 1)
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');

        $query = Payment::join('team_registration_infos', 'payment_infos.team_name', '=', 'team_registration_infos.team_name')
            ->where('team_registration_infos.is_selected', 1)
            ->select('payment_infos.*');


        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('payment_infos.team_name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('payment_infos.transaction_id', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('payment_infos.payment_status', $request->status);
        }

        if ($request->filled('platform')) {
            $query->where('payment_infos.platform', $request->platform);
        }

        $payment = $query->orderBy('payment_infos.created_at', 'desc')->get();

        return view('admin.Payment.payment', compact('payment', 'totalCollected', 'pendingVerification', 'todaysCollection'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->platform = $request->platform;
        $payment->transaction_id = $request->transaction_id;
        $payment->amount = $request->amount;
        $payment->payment_status = $request->payment_status;
        $payment->save();

        if ($request->payment_status == 1) {
            TeamRegistration::where('team_name', $payment->team_name)
                ->update(['is_paid' => 1]);
        } else {
            TeamRegistration::where('team_name', $payment->team_name)
                ->update(['is_paid' => 0]);
        }

        return redirect()->back()->with('success', 'Payment status updated successfully!');
    }
}