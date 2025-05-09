<?php

namespace App\Http\Controllers\admin;

use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function Index(){
        $testimonials = Testimonial::all();
        return view('admin.Home.testimonial',compact('testimonials'));
    }
 
    public function storeTestimonial(Request $request){
 
        $request->validate([
            'tt_name' => 'required',
            'tt_profession' => 'required',
            'tt_description' => 'required',
            'tt_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        if($request->hasFile('tt_image')){
              $imagePath = $request->file('tt_image')->store('testimonial','public');
        }
 
        Testimonial::create([
            'name' => $request->tt_name,
            'profession' => $request->tt_profession,
            'description' => $request->tt_description,
            'image' => $imagePath
        ]);
 
 
        return redirect()->back()->with('success','Testimonial added successfully! ');
    }
 
    public function updateTestimonial(Request $request){
 
        $request->validate([
            'tt_name' => 'required',
            'tt_profession' => 'required',
            'tt_description' => 'required',
            'tt_id' => 'required',
        ]);
 
        if($request->hasFile('tt_image')){
             $imagePath = $request->file('tt_image')->store('testimonial','public');
         }
 
         $update = Testimonial::find($request->tt_id);
         $update->name = $request->tt_name;
         $update->profession = $request->tt_profession;
         $update->description = $request->tt_description;
         if($request->hasFile('tt_image')){
             $update->image = $imagePath;
         }
 
         $update->save();
 
 
         return redirect()->back()->with('success','Testimonial updated successfully! ');
    }
 
    public function deleteTestimonial($id){
 
        $delete = Testimonial::find($id);
        $delete->delete();
        return redirect()->back()->with('success','Testimonial deleted successfully! ');
    }
 }