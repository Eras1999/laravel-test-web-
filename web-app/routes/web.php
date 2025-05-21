<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\NewsController;
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
})->middleware('auth.custom')->name('home.authenticated');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(SliderController::class)->middleware(['auth','verified'])->group(function () {
    Route::get('/SliderIndex','Index')->name('slider.index');
    Route::POST('/saveSlider','storeslider')->name('slider.store'); 
    Route::post('/sliderUpdate','updateslider')->name('slider.update');
    Route::get('/deleteSlider/{id}','deleteslider')->name('slider.delete');
});

Route::controller(TestimonialController::class)->middleware(['auth','verified'])->group(function () {
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

require __DIR__.'/auth.php';

// Custom Authentication Routes (Moved after auth.php to override defaults)
Route::get('/signin', [AuthController::class, 'showSignIn'])->name('signin');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin.post');
Route::get('/signup', [AuthController::class, 'showSignUp'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');