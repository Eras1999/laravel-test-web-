<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UserCredential;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\News;
use App\Models\Contact;
use App\Models\OfficialBlog;
use App\Models\CommunityBlog;
use App\Models\AdoptionPost;
use App\Models\SnakeCatcher;
use App\Models\RescuePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Fetch counts from the database with error handling
            $totalUsers = UserCredential::count() ?? 0;
            $totalSliders = class_exists('App\Models\Slider') ? Slider::count() : 0;
            $totalTestimonials = class_exists('App\Models\Testimonial') ? Testimonial::count() : 0;
            $totalNews = class_exists('App\Models\News') ? News::count() : 0;
            $totalContacts = class_exists('App\Models\Contact') ? Contact::count() : 0;
            $totalOfficialBlogs = class_exists('App\Models\OfficialBlog') ? OfficialBlog::count() : 0;
            $totalCommunityBlogs = class_exists('App\Models\CommunityBlog') ? CommunityBlog::count() : 0;
            $totalAdoptionPosts = class_exists('App\Models\AdoptionPost') ? AdoptionPost::count() : 0;
            $totalSnakeCatchers = class_exists('App\Models\SnakeCatcher') ? SnakeCatcher::count() : 0;
            $totalRescuePosts = class_exists('App\Models\RescuePost') ? RescuePost::count() : 0;

            // Log the counts for debugging
            Log::info('Dashboard Counts', [
                'totalUsers' => $totalUsers,
                'totalSliders' => $totalSliders,
                'totalTestimonials' => $totalTestimonials,
                'totalNews' => $totalNews,
                'totalContacts' => $totalContacts,
                'totalOfficialBlogs' => $totalOfficialBlogs,
                'totalCommunityBlogs' => $totalCommunityBlogs,
                'totalAdoptionPosts' => $totalAdoptionPosts,
                'totalSnakeCatchers' => $totalSnakeCatchers,
                'totalRescuePosts' => $totalRescuePosts,
            ]);

            // Pass counts to the view
            return view('admin.dashboard', compact(
                'totalUsers',
                'totalSliders',
                'totalTestimonials',
                'totalNews',
                'totalContacts',
                'totalOfficialBlogs',
                'totalCommunityBlogs',
                'totalAdoptionPosts',
                'totalSnakeCatchers',
                'totalRescuePosts'
            ));
        } catch (\Exception $e) {
            Log::error('Error fetching dashboard counts: ' . $e->getMessage());
            return view('admin.dashboard', [
                'totalUsers' => 0,
                'totalSliders' => 0,
                'totalTestimonials' => 0,
                'totalNews' => 0,
                'totalContacts' => 0,
                'totalOfficialBlogs' => 0,
                'totalCommunityBlogs' => 0,
                'totalAdoptionPosts' => 0,
                'totalSnakeCatchers' => 0,
                'totalRescuePosts' => 0,
            ]);
        }
    }
}