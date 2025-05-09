<?php

namespace App\Http\Controllers\admin;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function Index()
    {
        $sliders = Slider::all();

        return view('admin.Home.slider',compact('sliders'));
    }

    public function storeslider(Request $request)
    {
        $validatedData = $request->validate([
            'top_heading'   => 'required',
            'sub_heading'   => 'required|string|max:255',
            'content'       => 'required|string|max:255',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation (max 2MB)
            'view_more_link' => 'nullable|url',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slides', 'public');
        }

        // Create slider record
        Slider::create([
            'top_heading' => $validatedData['top_heading'],
            'sub_heading' => $validatedData['sub_heading'],
            'content' => $validatedData['content'],
            'image_link' => $imagePath,
            'view_more_link' => $validatedData['view_more_link'],
        ]);

        return redirect()->back()->with('success', 'Slide added Successfully!');
    }
    public function updateslider(Request $request)
    {
        $validatedData = $request->validate([
            'slider_id' => 'required|exists:sliders,id',
            'top_heading' => 'required|string|max:255',
            'sub_heading' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'view_more_link' => 'nullable|url',
        ]);

        $slider = Slider::findOrFail($request->slider_id);

        $slider->top_heading = $validatedData['top_heading'];
        $slider->sub_heading = $validatedData['sub_heading'];
        $slider->content = $validatedData['content'];
        $slider->view_more_link = $validatedData['view_more_link'];

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($slider->image_link) {
                Storage::disk('public')->delete($slider->image_link);
            }
            $slider->image_link = $request->file('image')->store('slides', 'public');
        }

        $slider->save();

        return redirect()->back()->with('success', 'Slide updated successfully!');
    }

    public function deleteslider($id)
    {
        $slider = Slider::findOrFail($id);

        // Delete the associated image if it exists
        if ($slider->image_link) {
            Storage::disk('public')->delete($slider->image_link);
        }

        $slider->delete();

        return redirect()->back()->with('success', 'Slide deleted successfully!');
    }
}