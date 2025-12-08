<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\TitipTulisanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;

// =======================
// Public Routes
// =======================
Route::post('/kontak-kami', [KontakController::class, 'store'])->name('kontak.store');
Route::view('/kontak', 'kontak')->name('kontak');
Route::view('/tentang', 'tentang')->name('tentang');
Route::view('/profile', 'profile')->name('profile');
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/news/show/{news:slug}', [HomeController::class, 'show'])->name('news.show');
Route::post('/news/{news}/like', [LikeController::class, 'likeNews'])->name('news.like');
Route::get('/news/{categories:slug}/category', [HomeController::class, 'viewCategory'])->name('news.viewCategory');

Route::prefix('Tulisan-tamu')->group(function () {
    Route::get('/', [TitipTulisanController::class, 'create'])->name('titip-tulisan.create');
    Route::post('/', [TitipTulisanController::class, 'store'])->name('titip-tulisan.store');
    Route::get('/show/{titipTulisan:slug}', [TitipTulisanController::class, 'show'])->name('titip-tulisan.show');
    Route::post('/{titipTulisan}/like', [LikeController::class, 'likeTitipTulisan'])->name('titip-tulisan.like');
});

Route::prefix('comments')->group(function () {
    Route::post('/', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/get', [CommentController::class, 'getComments'])->name('comments.get');
});

// =======================
// Guest Routes
// =======================
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login/submit', [LoginController::class, 'loginSubmit'])->name('login.submit');
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/register/submit', [LoginController::class, 'registerSubmit'])->name('register.submit');
});

// =======================
// Authenticated Routes (Semua User)
// =======================
Route::middleware(['auth', 'online.status'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Profile
    Route::resource('profile', UserController::class)->parameters(['profile' => 'user'])
        ->only(['edit', 'update']);

    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/count', [NotificationController::class, 'unreadNotificationsCount'])->name('count');
        Route::get('/fetch', [NotificationController::class, 'fetchNotifications'])->name('fetch');
        Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('markAsRead');
    });
});

// =======================
// Komentar Routes untuk SEMUA Role (Super Admin, Editor, Writer)
// =======================
Route::middleware(['auth'])->prefix('admin/comments')->name('admin.comments.')->group(function () {
    // Route yang bisa diakses semua role (dengan batasan masing-masing di controller)
    Route::get('/my-news', [CommentController::class, 'myNewsComments'])->name('myNewsComments');
    Route::get('/news/{newsId}', [CommentController::class, 'newsComments'])->name('newsComments');
    Route::delete('/{id}', [CommentController::class, 'destroy'])->name('destroy'); // hapus komentar

    // Route khusus Super Admin
    Route::middleware('role:Super Admin')->group(function () {
        Route::get('/', [CommentController::class, 'index'])->name('index'); // hanya Super Admin
        Route::post('/{id}/restore', [CommentController::class, 'restore'])->name('restore');
        Route::delete('/{id}/force-delete', [CommentController::class, 'forceDelete'])->name('forceDelete');
    });
});

// =======================
// Super Admin Routes
// =======================
Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    // Category
    // Category Routes
    Route::prefix('admin/category')->name('admin.category.')->group(function () {
        Route::get('/manage', [CategoryController::class, 'manage'])->name('manage');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');


        Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    // Users
    Route::prefix('admin/users')->name('admin.users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('manage');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::patch('/{user}/assignRole', [UserController::class, 'assignRole'])->name('assignRole');
    });

    // News Management
    Route::prefix('admin/news')->name('admin.news.')->group(function () {
        Route::get('/manage', [NewsController::class, 'manage'])->name('manage');
        Route::delete('/{id}', [NewsController::class, 'destroy'])->name('destroy');
    });

    // Titip Tulisan Admin
    Route::prefix('admin/titip-tulisan')->name('admin.titip-tulisan.')->group(function () {
        Route::get('/', [TitipTulisanController::class, 'manage'])->name('manage');
        Route::get('/status', [TitipTulisanController::class, 'status'])->name('status');
        Route::get('/view/{titipTulisan}', [TitipTulisanController::class, 'view'])->name('view');
        Route::patch('/status/{titipTulisan}', [TitipTulisanController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/delete/{titipTulisan}', [TitipTulisanController::class, 'destroy'])->name('destroy');
    });

    // Kontak Admin
    Route::prefix('admin/kontak')->name('admin.kontak.')->group(function () {
        Route::get('/', [KontakController::class, 'index'])->name('index');
        Route::delete('/delete/{id}', [KontakController::class, 'destroy'])->name('destroy');
    });
});

// =======================
// Editor Routes
// =======================
Route::middleware(['auth', 'permission:Status News|Update Status News'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/news/status', [NewsController::class, 'status'])->name('news.status');
    Route::get('/news/view/{news:slug}', [NewsController::class, 'view'])->name('news.view');
    Route::patch('/news/update-status/{id}', [NewsController::class, 'updateStatus'])->name('news.updateStatus');
});

// =======================
// Writer Routes
// =======================
Route::middleware(['auth', 'permission:Create News|Store News|Edit News|Update News|Draft'])->group(function () {
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/view/{news:slug}', [NewsController::class, 'view'])->name('news.view');
    Route::get('/news/{news:slug}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{news:slug}', [NewsController::class, 'update'])->name('news.update');
    Route::get('/news/draft', [NewsController::class, 'draft'])->name('news.draft');
});

// =======================
// Search Route
// =======================
Route::get('/search', [HomeController::class, 'search'])->name('search');
