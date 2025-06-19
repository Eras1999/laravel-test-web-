<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SnakeCatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SnakeCatcherController extends Controller
{
    public function index(Request $request)
    {
        $query = SnakeCatcher::where('status', 'approved');

        // Apply district filter if provided
        if ($request->filled('district')) {
            $query->where('district', $request->district);
        }

        $snakeCatchers = $query->get();
        return view('frontend.snake_catchers.index', compact('snakeCatchers'));
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
        ]);

        return redirect()->route('snake-catchers.index')->with('success', 'Application submitted successfully and is awaiting approval.');
    }
}