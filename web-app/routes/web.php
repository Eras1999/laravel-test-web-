<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Redirect root to Sign In page for all users (authenticated or not)
Route::get('/', function () {
    return redirect()->route('signin');
})->name('home');

// Homepage route, accessible only to authenticated users
Route::get('/home', function () {
    $sliders = \App\Models\Slider::all();
    $testimonials = \App\Models\Testimonial::all();
    $news = \App\Models\News::orderBy('date', 'desc')->paginate(3);
    return view('frontend.home', compact('sliders', 'testimonials', 'news'));
})->middleware(['auth'])->name('home.authenticated');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
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

Route::get('/rescue', function () {
    return view('frontend.rescue');
})->name('rescue');

Route::get('/report', function () {
    return view('frontend.report');
})->name('report');

Route::get('/snakeID', function () {
    return view('frontend.snakeID');
})->name('snakeID');

Route::get('/blog', function () {
    return view('frontend.blog');
})->name('blog');

require __DIR__.'/auth.php';

// Custom Authentication Routes
Route::get('/signin', [AuthController::class, 'showSignInForm'])->name('signin');
Route::post('/signin', [AuthController::class, 'signIn']);
Route::get('/signup', [AuthController::class, 'showSignUpForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signUp']);
Route::get('/forgot-password', function () {
    return view('frontend.forgot-password');
})->name('forgot-password');

// Google Socialite Routes
Route::get('/login/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [AuthController::class, 'handleGoogleCallback']);