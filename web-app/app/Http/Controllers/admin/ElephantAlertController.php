<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ElephantAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ElephantAlertController extends Controller
{
    public function index(Request $request)
    {
        try {
            $elephantAlerts = ElephantAlert::query();
            if ($request->has('date') && $request->date != '') {
                $elephantAlerts->whereDate('created_at', $request->date);
            }
            $elephantAlerts = $elephantAlerts->get();
            Log::info('Elephant Alerts Retrieved: ' . $elephantAlerts->count() . ' records');
            return view('admin.elephant_alerts.index', compact('elephantAlerts'));
        } catch (\Exception $e) {
            Log::error('Error fetching elephant alerts: ' . $e->getMessage());
            return view('admin.elephant_alerts.index', ['elephantAlerts' => collect([])])->with('error', 'Failed to load elephant alerts.');
        }
    }

    public function delete($id)
    {
        $alert = ElephantAlert::findOrFail($id);
        if ($alert->image) {
            Storage::disk('public')->delete($alert->image);
        }
        $alert->delete();
        return redirect()->route('admin.elephant-alerts.index')->with('success', 'Elephant alert deleted successfully.');
    }
}