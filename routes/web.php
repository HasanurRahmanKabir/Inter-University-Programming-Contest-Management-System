<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminProfileController;
use App\Http\Controllers\admin\ContestController;
use App\Http\Controllers\admin\DownloadDetailsController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\KitStatusController;
use App\Http\Controllers\admin\NoticeController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\RuleController;
use App\Http\Controllers\admin\SponsorController;
use App\Http\Controllers\admin\TeamController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\VolunteerController;
use App\Http\Controllers\admin\WebsiteSettingController;
use App\Http\Controllers\website\CoachController;
use App\Http\Controllers\website\ForgotPasswordController;
use App\Http\Controllers\website\NoticeInfoController;
use App\Http\Controllers\website\RegisterInfoController;
use App\Http\Controllers\website\RulesController;
use App\Http\Controllers\website\TeamRegistrationController;
use App\Http\Controllers\website\UserLoginController;
use App\Http\Controllers\website\VolunteersController;
use App\Http\Controllers\website\WebsiteController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

// Public Website Routes
Route::get('', [WebsiteController::class, 'index'])->name('home');
Route::get('/teams', [RegisterInfoController::class, 'index'])->name('website.teams');
Route::get('/notices', [NoticeInfoController::class, 'index'])->name('website.notices');
Route::get('/rules', [RulesController::class, 'index'])->name('website.rules');

Route::get('/registration-info', [RegisterInfoController::class, 'index']);
Route::get('/notice-info', [NoticeInfoController::class, 'index']);

// Public Team Registration
Route::get('team/registration', [TeamRegistrationController::class, 'index'])->name('team.registration');
Route::post('/check-duplicate-db', [TeamRegistrationController::class, 'checkDuplicateInDB']);
Route::match(['get', 'post'], 'team/registration/submit', [TeamRegistrationController::class, 'store'])->name('team.registration.store');

// Public User Authentication
Route::get('/login', [UserLoginController::class, 'index'])->name('user.login');
Route::post('/login/submit', [UserLoginController::class, 'login'])->name('user.login.submit');
Route::post('/logout', [UserLoginController::class, 'logout'])->name('user.logout');

// Password Reset Routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showEmailForm'])->name('forgot.password');
Route::post('forgot-password/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('forgot.password.send');
Route::get('forgot-password/verify-otp', [ForgotPasswordController::class, 'showOtpForm'])->name('forgot.password.verify');
Route::post('forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('forgot.password.verify.submit');
Route::get('forgot-password/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('forgot.password.reset');
Route::post('forgot-password/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('forgot.password.reset.submit');

// Admin Guest Routes
Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
    Route::post('/login/submit', [AdminLoginController::class, 'login'])->name('admin.login.submit');
});

// Admin Protected Routes
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::post('/profile/update', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('admin.profile.password');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Admins
    Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins.index');
    Route::post('/admins', [AdminController::class, 'store'])->name('admin.store');
    Route::put('/admins/{admin_id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admins/{admin_id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // Contests
    Route::get('/contests', [ContestController::class, 'index'])->name('admin.contest.index');
    Route::post('/contests', [ContestController::class, 'store'])->name('admin.contest.store');
    Route::put('/contests/{contest_id}', [ContestController::class, 'update'])->name('admin.contest.update');
    Route::delete('/contests/{contest_id}', [ContestController::class, 'destroy'])->name('admin.contest.destroy');

    // Teams
    Route::get('/teams', [TeamController::class, 'index'])->name('admin.teamregistration.index');
    Route::get('/teams/{id}', [TeamController::class, 'show'])->name('admin.team.show');
    Route::put('/teams/{team_id}', [TeamController::class, 'update'])->name('team.update');
    Route::delete('/teams/{team_id}', [TeamController::class, 'destroy'])->name('admin.team.destroy');

    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('admin.payment.index');
    Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('admin.payment.show');
    Route::put('/payments/{id}', [PaymentController::class, 'update'])->name('admin.payment.update');

    // Volunteers
    Route::get('/volunteers', [VolunteerController::class, 'index'])->name('admin.volunteer.index');
    Route::post('/volunteers', [VolunteerController::class, 'store'])->name('admin.volunteer.store');
    Route::put('/volunteers/{volunteer_id}', [VolunteerController::class, 'update'])->name('admin.volunteer.update');
    Route::delete('/volunteers/{volunteer_id}', [VolunteerController::class, 'destroy'])->name('admin.volunteer.destroy');

    // Notices
    Route::get('/notices', [NoticeController::class, 'index'])->name('admin.notice.index');
    Route::post('/notices', [NoticeController::class, 'store'])->name('admin.notice.store');
    Route::put('/notices/{notice_id}', [NoticeController::class, 'update'])->name('admin.notice.update');
    Route::delete('/notices/{notice_id}', [NoticeController::class, 'destroy'])->name('admin.notice.destroy');

    // Rules
    Route::get('/rules', [RuleController::class, 'index'])->name('admin.rules.index');
    Route::post('/rules', [RuleController::class, 'store'])->name('admin.rules.store');
    Route::put('/rules/{rules_id}', [RuleController::class, 'update'])->name('admin.rules.update');
    Route::delete('/rules/{rules_id}', [RuleController::class, 'destroy'])->name('admin.rules.destroy');

    // Download Details
    Route::get('/download-details', [DownloadDetailsController::class, 'index'])->name('admin.downloaddetails.index');
    Route::get('/download-details/{id}', [DownloadDetailsController::class, 'show'])->name('admin.downloaddetails.show');

    // Gallery
    Route::get('/gallery', [GalleryController::class, 'index'])->name('admin.gallery');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('admin.gallery.store');
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('admin.gallery.delete');

    // Kit Status
    Route::get('/kit-status', [KitStatusController::class, 'index'])->name('admin.kitstatus.index');
    Route::post('/kit-status', [KitStatusController::class, 'store'])->name('admin.kitstatus.store');
    Route::put('/kit-status/{id}', [KitStatusController::class, 'update'])->name('admin.kitstatus.update');

    // Sponsors
    Route::get('/sponsors', [SponsorController::class, 'index'])->name('admin.sponsor.index');
    Route::post('/sponsors', [SponsorController::class, 'store'])->name('admin.sponsor.store');
    Route::put('/sponsors/{sponsor_id}', [SponsorController::class, 'update'])->name('admin.sponsor.update');
    Route::delete('/sponsors/{sponsor_id}', [SponsorController::class, 'destroy'])->name('admin.sponsor.destroy');

    // Website Settings
    Route::get('/website-settings', [WebsiteSettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/website-settings', [WebsiteSettingController::class, 'update'])->name('admin.settings.update');
    Route::get('/website-settings/delete-image/{field}', [WebsiteSettingController::class, 'deleteImage'])->name('admin.settings.deleteImage');

    Route::get('/clear-cache', function () {
        Artisan::call('optimize:clear');
        return back()->with('cache_success', 'System cache cleared and performance optimized successfully!');
    })->name('admin.clear.cache');
});

// Coach Dashboard
Route::group(['prefix' => 'coach', 'middleware' => 'auth:team'], function () {
    Route::get('/dashboard', [CoachController::class, 'index'])->name('coach.dashboard');
    Route::post('/payment/store', [CoachController::class, 'storePayment'])->name('coach.payment.store');
    Route::match(['get', 'put', 'post'], '/profile/save', [CoachController::class, 'updateProfile'])->name('coach.profile.update');
});

// Volunteer Dashboard
Route::group(['prefix' => 'volunteer', 'middleware' => 'auth:volunteer'], function () {
    Route::get('/dashboard', [VolunteersController::class, 'index'])->name('volunteer.dashboard');
    Route::post('/kit/save', [VolunteersController::class, 'saveKitStatus'])->name('volunteer.kit.save');
});

// System & Utility
Route::get('/_boost/browser-logs', function () {
    return response('', 204);
});

Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('view:cache');
    return 'System cache cleared and performance optimized successfully!';
});

Route::get('storage/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = response()->make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->where('filename', '.*');

Route::get('/storage-link', function () {
    try {
        Artisan::call('storage:link');
        return 'The [public/storage] directory has been linked successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::get('/databasefresh-seed', function () {
    try {
        Artisan::call('migrate:fresh', [
            '--seed' => true,
            '--force' => true,
        ]);
        return 'Database reset and seeded successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
