<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/themes', [PublicController::class, 'themes'])->name('themes.index');
Route::get('/themes/{theme}', [PublicController::class, 'themeArticles'])->name('themes.show');
Route::get('/articles', [PublicController::class, 'articles'])->name('articles.index');
Route::get('/recherche/suggestions', [PublicController::class, 'searchSuggestions'])->name('search.suggestions');
Route::get('/articles/{article}', [PublicController::class, 'show'])->name('articles.show');
Route::get('/articles/{article}/download', [PublicController::class, 'download'])->name('articles.download');

Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');

// Serve uploaded files
Route::get('/uploads/{type}/{filename}', function ($type, $filename) {
    $path = base_path("uploads/{$type}/{$filename}");
    
    if (!file_exists($path)) {
        abort(404);
    }
    
    return response()->file($path);
})->where('type', 'covers|sliders|pdfs|branding|profiles|authors|bannieres')->name('uploads.serve');

// Admin Authentication Routes
Route::get('site-admin0018', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('site-admin0018', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Public User Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/connexion', [App\Http\Controllers\Auth\UserAuthController::class, 'showLoginForm'])->name('user.login');
    Route::post('/connexion', [App\Http\Controllers\Auth\UserAuthController::class, 'login'])->name('user.login.post');
    Route::get('/inscription', [App\Http\Controllers\Auth\UserAuthController::class, 'showRegisterForm'])->name('user.register');
    Route::post('/inscription', [App\Http\Controllers\Auth\UserAuthController::class, 'register'])->name('user.register.post');
});
Route::post('/deconnexion', [App\Http\Controllers\Auth\UserAuthController::class, 'logout'])->name('user.logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.home');

// User Dashboard Routes (auth required, not admin)
Route::middleware(['auth', 'not.admin'])->prefix('mon-espace')->group(function () {
    Route::get('/', [App\Http\Controllers\User\UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::put('/profil', [App\Http\Controllers\User\UserDashboardController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/favoris/{article}/toggle', [App\Http\Controllers\User\UserDashboardController::class, 'toggleFavorite'])->name('user.favorites.toggle');
});


// Admin Routes
Route::prefix('site-admin0018')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('themes', App\Http\Controllers\Admin\ThemeController::class)->except(['show'])->names([
        'index' => 'admin.themes.index',
        'create' => 'admin.themes.create',
        'store' => 'admin.themes.store',
        'edit' => 'admin.themes.edit',
        'update' => 'admin.themes.update',
        'destroy' => 'admin.themes.destroy',
    ]);
    Route::resource('articles', App\Http\Controllers\Admin\ArticleController::class)->except(['show'])->names([
        'index' => 'admin.articles.index',
        'create' => 'admin.articles.create',
        'store' => 'admin.articles.store',
        'edit' => 'admin.articles.edit',
        'update' => 'admin.articles.update',
        'destroy' => 'admin.articles.destroy',
    ]);
    Route::post('/articles/{article}/duplicate', [App\Http\Controllers\Admin\ArticleController::class, 'duplicate'])->name('admin.articles.duplicate');
    Route::post('/articles/{article}/toggle-visibility', [App\Http\Controllers\Admin\ArticleController::class, 'toggleVisibility'])->name('admin.articles.toggle-visibility');

    // Sliders management
    Route::resource('sliders', App\Http\Controllers\Admin\SliderController::class)->except(['show'])->names([
        'index' => 'admin.sliders.index',
        'create' => 'admin.sliders.create',
        'store' => 'admin.sliders.store',
        'edit' => 'admin.sliders.edit',
        'update' => 'admin.sliders.update',
        'destroy' => 'admin.sliders.destroy',
    ]);
    Route::post('sliders/{slider}/toggle', [App\Http\Controllers\Admin\SliderController::class, 'toggleVisibility'])->name('admin.sliders.toggle');

    // Bannieres management
    Route::resource('bannieres', App\Http\Controllers\Admin\BanniereController::class)->except(['show'])->names([
        'index'   => 'admin.bannieres.index',
        'create'  => 'admin.bannieres.create',
        'store'   => 'admin.bannieres.store',
        'edit'    => 'admin.bannieres.edit',
        'update'  => 'admin.bannieres.update',
        'destroy' => 'admin.bannieres.destroy',
    ]);
    Route::post('bannieres/{banniere}/toggle', [App\Http\Controllers\Admin\BanniereController::class, 'toggleVisibility'])->name('admin.bannieres.toggle');

    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except(['show'])->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    Route::post('users/{user}/approve', [App\Http\Controllers\Admin\UserController::class, 'approve'])->name('admin.users.approve');
    Route::post('users/{user}/reject', [App\Http\Controllers\Admin\UserController::class, 'reject'])->name('admin.users.reject');
    Route::get('users/{user}/request-details', [App\Http\Controllers\Admin\UserController::class, 'requestDetails'])->name('admin.users.request-details');

    Route::get('/stats', [App\Http\Controllers\Admin\StatsController::class, 'index'])->name('admin.stats.index');

    Route::resource('contacts', App\Http\Controllers\Admin\ContactController::class)->only(['index', 'show', 'destroy'])->names([
        'index' => 'admin.contacts.index',
        'show' => 'admin.contacts.show',
        'destroy' => 'admin.contacts.destroy',
    ]);

    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');
});

Route::post('/contact', [App\Http\Controllers\PublicController::class, 'submitContact'])->name('contact.submit');
