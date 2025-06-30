<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\UserCredentialsController;
use App\Http\Controllers\admin\OfficialBlogsController;
use App\Http\Controllers\admin\CommunityBlogsController as AdminCommunityBlogsController;
use App\Http\Controllers\Frontend\CommunityBlogsController as FrontendCommunityBlogsController;
use App\Http\Controllers\Frontend\AdoptionPostsController;
use App\Http\Controllers\FrontendAuthController;
use App\Http\Controllers\admin\AdoptionPostsController as AdminAdoptionPostsController;
use App\Http\Controllers\Frontend\SnakeCatcherController;
use App\Http\Controllers\admin\SnakeCatcherController as AdminSnakeCatcherController;
use App\Http\Controllers\Frontend\RescuePostsController;
use App\Http\Controllers\admin\RescuePostsController as AdminRescuePostsController;
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

Route::controller(FrontendCommunityBlogsController::class)->group(function () {
    Route::get('/community-blogs', 'index')->name('community-blogs.index');
    Route::get('/community-blogs/submit', 'create')->name('community-blogs.submit');
    Route::post('/community-blogs/submit', 'store')->name('community-blogs.store');
    Route::get('/community-blogs/{id}', 'show')->name('community-blogs.show');
});

Route::controller(AdminCommunityBlogsController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/community-blogs', 'index')->name('admin.community-blogs.index');
    Route::patch('/admin/community-blogs/{id}', 'update')->name('admin.community-blogs.update');
    Route::delete('/admin/community-blogs/{id}', 'destroy')->name('admin.community-blogs.delete');
});

Route::controller(AdoptionPostsController::class)->middleware(['auth:frontend'])->group(function () {
    Route::get('/adoption-posts/create', 'create')->name('adoption-posts.create');
    Route::get('/adoption-posts/form', 'form')->name('adoption-posts.form');
    Route::post('/adoption-posts', 'store')->name('adoption-posts.store');
    Route::get('/adoption-posts', 'index')->name('adoption-posts.index');
    Route::patch('/adoption-posts/{id}/adopted', 'adopted')->name('adoption-posts.adopted');
    Route::patch('/adoption-posts/{id}/repost', 'repost')->name('adoption-posts.repost');
});

Route::controller(AdminAdoptionPostsController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/adoption-posts', 'index')->name('admin.adoption-posts.index');
    Route::patch('/admin/adoption-posts/{id}', 'update')->name('admin.adoption-posts.update');
    Route::delete('/admin/adoption-posts/{id}', 'delete')->name('admin.adoption-posts.delete');
});

Route::controller(SnakeCatcherController::class)->middleware(['auth:frontend'])->group(function () {
    Route::get('/snake-catchers', 'index')->name('snake-catchers.index');
    Route::post('/snake-catchers', 'store')->name('snake-catchers.store');
});

Route::controller(AdminSnakeCatcherController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/snake-catchers', 'index')->name('admin.snake-catchers.index');
    Route::post('/admin/snake-catchers', 'store')->name('admin.snake-catchers.store');
    Route::patch('/admin/snake-catchers/{id}', 'update')->name('admin.snake-catchers.update');
    Route::delete('/admin/snake-catchers/{id}', 'delete')->name('admin.snake-catchers.delete');
});

Route::controller(RescuePostsController::class)->middleware(['auth:frontend'])->group(function () {
    Route::get('/rescue-posts', 'index')->name('rescue-posts.index');
    Route::post('/rescue-posts', 'store')->name('rescue-posts.store');
    Route::get('/rescue-posts/{id}', 'show')->name('rescue-posts.show');
    Route::post('/rescue-posts/{id}/comment', 'comment')->name('rescue-posts.comment');
    Route::patch('/rescue-posts/{id}/mark-rescued', [\App\Http\Controllers\Frontend\RescuePostsController::class, 'markAsRescued'])
    ->name('rescue-posts.markAsRescued')
    ->middleware('auth:frontend');

});

Route::controller(AdminRescuePostsController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/rescue-posts', 'index')->name('admin.rescue-posts.index');
    Route::delete('/admin/rescue-posts/{id}', 'delete')->name('admin.rescue-posts.delete');
    Route::patch('/admin/rescue-posts/{id}/rescued', 'rescued')->name('admin.rescue-posts.rescued');
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

// Update the profile route to use RescuePostsController@profile
Route::get('/my-profile', [RescuePostsController::class, 'profile'])->name('profile')->middleware('auth:frontend');