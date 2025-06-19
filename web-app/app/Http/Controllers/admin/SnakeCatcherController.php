<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SnakeCatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SnakeCatcherController extends Controller
{
    public function index()
    {
        $snakeCatchers = SnakeCatcher::all();
        return view('admin.snake_catchers.index', compact('snakeCatchers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'district' => 'required|in:Colombo,Gampaha,Kalutara,Kandy,Matale,Nuwara Eliya,Galle,Matara,Hambantota,Jaffna,Kilinochchi,Mannar,Vavuniya,Mullaitivu,Batticaloa,Ampara,Trincomalee,Kurunegala,Puttalam,Anuradhapura,Polonnaruwa,Badulla,Moneragala,Ratnapura,Kegalle',
            'description' => 'required|string',
            'mobile_number' => 'required|regex:/^0[0-9]{9}$/',
            'facebook_link' => 'required|url',
        ]);

        $imagePath = $request->file('image')->store('snake_catchers', 'public');

        SnakeCatcher::create([
            'name' => $request->name,
            'image' => $imagePath,
            'district' => $request->district,
            'description' => $request->description,
            'mobile_number' => $request->mobile_number,
            'facebook_link' => $request->facebook_link,
            'status' => 'approved', // Admin-added catchers are approved by default
        ]);

        return redirect()->route('admin.snake-catchers.index')->with('success', 'Snake catcher added successfully.');
    }

    public function update(Request $request, $id)
    {
        $catcher = SnakeCatcher::findOrFail($id);
        $status = $request->input('status');

        if (in_array($status, ['pending', 'approved', 'rejected'])) {
            $catcher->update(['status' => $status]);
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