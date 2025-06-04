<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\UserCredentialsController;
use App\Http\Controllers\admin\OfficialBlogsController;
use App\Http\Controllers\FrontendAuthController;
use App\Http\Controllers\Frontend\CommunityBlogsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Root route to handle authenticated and unauthenticated users
Route::get('/', function () {
    if (Auth::guard('frontend')->check()) {
        return redirect()->route('home.authenticated');
    }
    return redirect()->route('signin');
})->name('home');

// Homepage route, accessible only to authenticated frontend users
Route::get('/home', function () {
    $sliders = \App\Models\Slider::all();
    $testimonials = \App\Models\Testimonial::all();
    $news = \App\Models\News::orderBy('date', 'desc')->paginate(3);
    return view('frontend.home', compact('sliders', 'testimonials', 'news'));
})->middleware(['auth:frontend'])->name('home.authenticated');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(SliderController::class)->middleware(['auth','verified'])->group(function (){
    Route::get('/SliderIndex','Index')->name('slider.index');
    Route::POST('/saveSlider','storeslider')->name('slider.store'); 
    Route::post('/sliderUpdate','updateslider')->name('slider.update');
    Route::get('/deleteSlider/{id}','deleteslider')->name('slider.delete');
});

Route::controller(TestimonialController::class)->middleware(['auth','verified'])->group(function (){
    Route::get('/TestimonialIndex','Index')->name('Testimonial.index');
    Route::post('/saveTestimonial','storeTestimonial')->name('Testimonial.store');
    Route::post('/TestimonialUpdate','updateTestimonial')->name('Testimonial.update');
    Route::get('/deleteTestimonial/{id}','deleteTestimonial')->name('Testimonial.delete');
});

Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');

Route::post('/submit-contact', [App\Http\Controllers\admin\ContactController::class, 'store'])->name('contact.submit');

Route::controller(ContactController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/ContactIndex', 'index')->name('contact.index');
    Route::patch('/update-contact-status/{id}', 'updateStatus')->name('contact.updateStatus');
    Route::get('/delete-contact/{id}', 'delete')->name('contact.delete');
});

Route::controller(NewsController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/NewsIndex', 'index')->name('news.index');
    Route::post('/saveNews', 'store')->name('news.store');
    Route::patch('/updateNews/{id}', 'update')->name('news.update');
    Route::get('/deleteNews/{id}', 'destroy')->name('news.delete');
});

Route::controller(UserCredentialsController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/UserCredentialsIndex', 'index')->name('user_credentials.index');
});

Route::controller(OfficialBlogsController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/OfficialBlogsIndex', 'index')->name('official_blogs.index');
    Route::post('/saveOfficialBlog', 'store')->name('official_blogs.store');
    Route::patch('/updateOfficialBlog/{id}', 'update')->name('official_blogs.update');
    Route::get('/deleteOfficialBlog/{id}', 'destroy')->name('official_blogs.delete');
});

Route::controller(OfficialBlogsController::class)->group(function () {
    Route::get('/official-blogs', 'show')->name('official-blogs.index');
    Route::get('/official-blogs/{id}', 'showDetail')->name('official-blogs.show');
});

Route::controller(CommunityBlogsController::class)->group(function () {
    Route::get('/community-blogs', 'index')->name('community-blogs.index');
    Route::get('/community-blogs/submit', 'create')->name('community-blogs.submit');
});

Route::get('/privacy-policy', function () {
    return view('frontend.privacy-policy');
})->name('privacy-policy');

Route::get('/terms-and-conditions', function () {
    return view('frontend.terms-and-conditions');
})->name('terms-conditions');

Route::get('/what-we-do', function () {
    return view('frontend.what-we-do');
})->name('what-we-do');

Route::get('/faq', function () {
    return view('frontend.faq');
})->name('faq');

Route::get('/about-us', function () {
    return view('frontend.about-us');
})->name('about-us');

require __DIR__.'/auth.php';

// Custom Authentication Routes for Frontend Users
Route::get('/signin', [FrontendAuthController::class, 'showSignIn'])->name('signin');
Route::post('/signin', [FrontendAuthController::class, 'signIn'])->name('signin.post');
Route::get('/signup', [FrontendAuthController::class, 'showSignUp'])->name('signup');
Route::post('/signup', [FrontendAuthController::class, 'signUp'])->name('signup.post');
Route::get('/forgot-password', function () {
    return view('frontend.forgot-password');
})->name('forgot-password');
Route::post('/logout', [FrontendAuthController::class, 'logout'])->name('logout');
Route::get('/my-profile', [FrontendAuthController::class, 'showProfile'])->name('profile')->middleware('auth:frontend');