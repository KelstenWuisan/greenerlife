<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome', [
        "title" => "Home",
    ]);
})->name('home');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');
Route::post('/logout', [AuthManager::class, 'logout'])->name('logout');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::get('/welcome', function () {
    return view('welcome', [
        "title" => "Home",
    ]);
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
    ]);
});

Route::get('/posts', [PostController::class, 'index'])->name('posts');

Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/categories', function()
{
    return view('categories', [
        "title" => "Post Categories",
        "categories" => Category::all()
    ]);
});

Route::get('/categories/{category:slug}', function(Category $category) {
    return view('posts', [
        "title" => "Post by Category: $category->name",
        "posts" => $category->posts()->paginate(5),  // Paginate the posts by category
        "category" => $category->name,
        "categories" => Category::all(),
    ]);
});

Route::get('/authors/{user:name}', function(User $user){
    return view('posts', [
        "title" => "Post By Author : $user->name",
        "posts" => $user->posts()->paginate(5),
        "categories" => Category::all(),
    ]);
});

// Route::get('/createpost', [AuthManager::class, 'create'])->name('create');
// Route::post('/createpost', [AuthManager::class, 'createPost'])->name('create.post');

Route::post('/createpost', [AuthManager::class, 'createPost'])->name('create.post');

// web.php
Route::post('/posts/{post}/rsvp', [PostController::class, 'rsvp'])->middleware('auth');


Route::get('/donate', function () {
    return view('donate', [
        "title" => "donate",
    ]);
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/challenges', [ChallengeController::class, 'index']);
    Route::post('/challenges/submit', [ChallengeController::class, 'submitProof'])->name('challenges.submit');

    Route::get('/donate', function () {
        return view('donate', [
            "title" => "donate",
        ]);
    });

    Route::post('/donate', [DonationController::class, 'store'])->name('donate');

    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/createpost', [AuthManager::class, 'create'])->name('create');
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
