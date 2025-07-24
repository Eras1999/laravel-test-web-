<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SnakeCatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SnakeCatcherApproved;

class SnakeCatcherController extends Controller
{
    public function index()
    {
        try {
            $snakeCatchers = SnakeCatcher::all();
            Log::info('Snake Catchers Retrieved: ' . $snakeCatchers->count() . ' records');
            return view('admin.snake_catchers.index', compact('snakeCatchers'));
        } catch (\Exception $e) {
            Log::error('Error fetching snake catchers: ' . $e->getMessage());
            return view('admin.snake_catchers.index', ['snakeCatchers' => collect([])])->with('error', 'Failed to load snake catchers.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'image' => 'required|image|max:2048',
            'district' => 'required|in:Colombo,Gampaha,Kalutara,Kandy,Matale,Nuwara Eliya,Galle,Matara,Hambantota,Jaffna,Kilinochchi,Mannar,Vavuniya,Mullaitivu,Batticaloa,Ampara,Trincomalee,Kurunegala,Puttalam,Anuradhapura,Polonnaruwa,Badulla,Moneragala,Ratnapura,Kegalle',
            'description' => 'required|string',
            'mobile_number' => 'required|regex:/^0[0-9]{9}$/',
            'facebook_link' => 'required|url',
        ]);

        $imagePath = $request->file('image')->store('snake_catchers', 'public');

        $catcher = SnakeCatcher::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $imagePath,
            'district' => $request->district,
            'description' => $request->description,
            'mobile_number' => $request->mobile_number,
            'facebook_link' => $request->facebook_link,
            'status' => 'approved',
        ]);

        // Send approval email for admin-added catchers
        try {
            Mail::to($catcher->email)->send(new SnakeCatcherApproved($catcher));
        } catch (\Exception $e) {
            Log::error('Failed to send approval email to ' . $catcher->email . ': ' . $e->getMessage());
        }

        return redirect()->route('admin.snake-catchers.index')->with('success', 'Snake catcher added successfully.');
    }

    public function update(Request $request, $id)
    {
        $catcher = SnakeCatcher::findOrFail($id);
        $status = $request->input('status');

        if (in_array($status, ['pending', 'approved', 'rejected'])) {
            $catcher->update(['status' => $status]);

            // Send email if status is changed to approved
            if ($status === 'approved' && $catcher->email) {
                try {
                    Mail::to($catcher->email)->send(new SnakeCatcherApproved($catcher));
                } catch (\Exception $e) {
                    Log::error('Failed to send approval email to ' . $catcher->email . ': ' . $e->getMessage());
                }
            }

            return redirect()->route('admin.snake-catchers.index')->with('success', "Snake catcher status updated to $status.");
        }
        return redirect()->route('admin.snake-catchers.index')->with('error', 'Invalid status update.');
    }

    public function delete($id)
    {
        $catcher = SnakeCatcher::findOrFail($id);
        if ($catcher->image) {
            Storage::disk('public')->delete($catcher->image);
        }
        $catcher->delete();
        return redirect()->route('admin.snake-catchers.index')->with('success', 'Snake catcher deleted successfully.');
    }
}