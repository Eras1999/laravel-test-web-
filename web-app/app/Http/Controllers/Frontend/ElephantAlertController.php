<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ElephantAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class ElephantAlertController extends Controller
{
    public function index()
    {
        return view('frontend.elephant_alerts.index');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'mobile_number' => 'required|string|regex:/^0[0-9]{9}$/',
                'district' => 'required|in:Colombo,Gampaha,Kalutara,Kandy,Matale,Nuwara Eliya,Galle,Matara,Hambantota,Jaffna,Kilinochchi,Mannar,Vavuniya,Mullaitivu,Batticaloa,Ampara,Trincomalee,Kurunegala,Puttalam,Anuradhapura,Polonnaruwa,Badulla,Moneragala,Ratnapura,Kegalle',
                'latitude' => 'required|numeric|between:5.9,9.9', // Sri Lanka latitude range
                'longitude' => 'required|numeric|between:79.5,82.0', // Sri Lanka longitude range
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'elephant_count' => 'required|integer|min:1',
                'health_status' => 'required|in:healthy,normal,injured',
                'description' => 'required|string|max:1000',
            ], [
                'mobile_number.regex' => 'The mobile number must be a valid 10-digit Sri Lankan number starting with 0 (e.g., 0771234567).',
                'latitude.between' => 'The selected location is outside Sri Lanka.',
                'longitude.between' => 'The selected location is outside Sri Lanka.',
                'image.mimes' => 'The image must be a JPEG, PNG, or JPG file.',
                'image.max' => 'The image size must not exceed 2MB.',
            ]);

            $data = $request->all();

            if ($request->hasFile('image')) {
                try {
                    $data['image'] = $request->file('image')->store('elephant_alerts', 'public');
                } catch (\Exception $e) {
                    Log::error('Image Upload Error: ' . $e->getMessage());
                    return redirect()->route('elephant-alerts.index')->with('error', 'Failed to upload image. Please try again with a valid image file.');
                }
            }

            $alert = ElephantAlert::create($data);
            Log::info('New alert created with ID: ' . $alert->id . ' at ' . $alert->created_at);

            if ($request->query('redirect') === 'map') {
                return redirect()->route('elephant-alerts.map')->with('success', 'Elephant alert submitted successfully.');
            }

            return redirect()->route('elephant-alerts.index')->with('success', 'Elephant alert submitted successfully.');
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            Log::error('Validation Error in Elephant Alert Submission: ' . implode(', ', $errors));
            return redirect()->route('elephant-alerts.index')->with('error', 'Validation failed: ' . implode(', ', $errors));
        } catch (\Exception $e) {
            Log::error('Elephant Alert Submission Error: ' . $e->getMessage());
            return redirect()->route('elephant-alerts.index')->with('error', 'Failed to submit alert: ' . $e->getMessage());
        }
    }

    public function map()
    {
        // Fetch today's reports (from 12:00 AM today to now)
        $alerts = ElephantAlert::today()->get();
        Log::info('Fetched ' . $alerts->count() . ' alerts for today: ' . Carbon::today()->setTimezone('Asia/Colombo')->format('Y-m-d H:i:s'));

        // Fetch all alerts from the last 7 days (including today)
        $startDate = Carbon::today()->setTimezone('Asia/Colombo')->subDays(7)->startOfDay();
        $allAlerts = ElephantAlert::where('created_at', '>=', $startDate)
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch reports from the previous 7 days (excluding today) for history
        $historyStartDate = Carbon::today()->setTimezone('Asia/Colombo')->subDay()->startOfDay();
        $historyEndDate = Carbon::today()->setTimezone('Asia/Colombo')->subDays(7)->startOfDay();
        $historyAlerts = ElephantAlert::whereBetween('created_at', [$historyEndDate, $historyStartDate])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($alert) {
                return Carbon::parse($alert->created_at)->setTimezone('Asia/Colombo')->format('Y-m-d');
            });

        return view('frontend.elephant_alerts.map', [
            'alerts' => $alerts,
            'history' => $historyAlerts,
            'allAlerts' => $allAlerts
        ]);
    }
}