<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminLogin;
use App\Http\Controllers\admin\ContestController;
use App\Http\Controllers\admin\DownloadDetailsController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\KitStatusController;
use App\Http\Controllers\admin\NoticeController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\RulesAdminController;
use App\Http\Controllers\admin\SponsorController;
use App\Http\Controllers\admin\TeamController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\VolunteerController;
use App\Http\Controllers\website\CoachController;
use App\Http\Controllers\website\TeamMemberController;
use App\Http\Controllers\website\TeamRegistrationController;
use App\Http\Controllers\website\UserLogin;
use App\Http\Controllers\website\VolunteersController;
use App\Http\Controllers\website\WebsiteController;
use App\Http\Controllers\website\RegisterInfoController;
use App\Http\Controllers\website\NoticeInfoController;
use App\Http\Controllers\website\RulesController;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;


// Homepage
Route::get('', [WebsiteController::class, 'index']);

// Registration Info & Rules
Route::get('/registration-info', [RegisterInfoController::class, 'index']);
Route::get('/notice-info', [NoticeInfoController::class, 'index']);
Route::get('/rules', [RulesController::class, 'index']);

// Website Routes (Public View)
Route::get('website/coach', [CoachController::class, 'index']);
Route::post('website/coach/store', [CoachController::class, 'store']);
Route::get('website/volunteer', [VolunteersController::class, 'index']);

// Registration Form View & Actions
Route::get('team/registration', [TeamRegistrationController::class, 'index'])->name('team.registration');
Route::post('/check-duplicate-db', [TeamRegistrationController::class, 'checkDuplicateInDB']);
Route::post('team/registration/store', [TeamRegistrationController::class, 'store']);

// User Login Routes
Route::get('website/user_login', [UserLogin::class, 'index'])->name('user.login');
Route::post('website/user_login_submit', [UserLogin::class, 'login'])->name('user.login.submit');
Route::post('website/user_logout', [UserLogin::class, 'logout'])->name('user.logout');


//Admin Authentication
Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('/admin_login', [AdminLogin::class, 'index'])->name('admin.login');
    Route::post('/admin_login_submit', [AdminLogin::class, 'login'])->name('admin.login.submit');
});


//Admin Dashboard Routes
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {

    // Logout
    Route::post('/logout', [AdminLogin::class, 'logout'])->name('admin.logout');

    // Main Dashboard
    Route::get('/dashboard', [UserController::class, 'index'])->name('admin.dashboard');

    // Admin Management
    Route::get('/dashboard/admin', [AdminController::class, 'index']);
    Route::post('/dashboard/store', [AdminController::class, 'store'])->name('admin.store');
    Route::put('/dashboard/update/{admin_id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/dashboard/delete/{admin_id}', [AdminController::class, 'destroy']);

    // Contest Management
    Route::get('/dashboard/contest', [ContestController::class, 'index']);
    Route::post('/dashboard/contest/store', [ContestController::class, 'store']);
    Route::put('/dashboard/contest/update/{contest_id}', [ContestController::class, 'update'])->name('admin.contest.update');
    Route::delete('/dashboard/contest/delete/{contest_id}', [ContestController::class, 'destroy']);

    // Team Management
    Route::get('/dashboard/team', [TeamController::class, 'index'])->name('admin.teamregistration.index');
    Route::get('/dashboard/team/{id}', [TeamController::class, 'show'])->name('admin.team.show');
    Route::put('/dashboard/team/update/{team_id}', [TeamController::class, 'update'])->name('team.update');
    Route::delete('/dashboard/team/delete/{team_id}', [TeamController::class, 'destroy']);

    // Payment Management
    Route::get('/dashboard/payment', [PaymentController::class, 'index']);
    Route::get('/dashboard/payment/{id}', [PaymentController::class, 'show'])->name('admin.payment.show');
    Route::put('/dashboard/payment/update/{id}', [PaymentController::class, 'update'])->name('admin.payment.update');
    // Volunteer Management
    Route::get('/dashboard/volunteer', [VolunteerController::class, 'index']);
    Route::post('/dashboard/volunteer/store', [VolunteerController::class, 'store']);
    Route::put('/dashboard/volunteer/update/{volunteer_id}', [VolunteerController::class, 'update'])->name('admin.volunteer.update');
    Route::delete('/dashboard/volunteer/delete/{volunteer_id}', [VolunteerController::class, 'destroy']);

    // Notice Management
    Route::get('/dashboard/notice', [NoticeController::class, 'index']);
    Route::post('/dashboard/notice/store', [NoticeController::class, 'store']);
    Route::put('/dashboard/notice/update/{notice_id}', [NoticeController::class, 'update'])->name('admin.notice.update');
    Route::delete('/dashboard/notice/delete/{notice_id}', [NoticeController::class, 'destroy']);

    // Rules Management
    Route::get('/dashboard/rules_admin', [RulesAdminController::class, 'index']);
    Route::post('/dashboard/rules_admin/store', [RulesAdminController::class, 'store']);
    Route::put('/dashboard/rules_admin/update/{rules_id}', [RulesAdminController::class, 'update'])->name('admin.rules.update');
    Route::delete('/dashboard/rules_admin/delete/{rules_id}', [RulesAdminController::class, 'destroy']);

    // Download Details
    Route::get('/dashboard/downloaddetails', [DownloadDetailsController::class, 'index']);
    Route::get('/dashboard/downloaddetails/{id}', [DownloadDetailsController::class, 'show']);

    // Gallery Management
    Route::get('/dashboard/gallery', [GalleryController::class, 'index'])->name('admin.gallery');
    Route::post('/dashboard/gallery/store', [GalleryController::class, 'store'])->name('admin.gallery.store');
    Route::delete('/dashboard/gallery/delete/{id}', [GalleryController::class, 'destroy'])->name('admin.gallery.delete');

    // Kit Status
    Route::get('/dashboard/kitstatus', [KitStatusController::class, 'index']);
    Route::post('/dashboard/kitstatus/store', [KitStatusController::class, 'store']);
    Route::put('/dashboard/kitstatus/update/{id}', [KitStatusController::class, 'update']);
    // Sponsor Management
    Route::get('/dashboard/sponsor', [SponsorController::class, 'index']);
    Route::post('/dashboard/sponsor/store', [SponsorController::class, 'store']);
    Route::put('/dashboard/sponsor/update/{sponsor_id}', [SponsorController::class, 'update'])->name('admin.sponsor.update');
    Route::delete('/dashboard/sponsor/delete/{sponsor_id}', [SponsorController::class, 'destroy']);

});

//Coach & Volunteer Dashboard Routes

// Coach Dashboard
Route::group(['prefix' => 'coach', 'middleware' => 'auth:team'], function () {
    Route::get('/dashboard', [CoachController::class, 'index'])->name('coach.dashboard');
    Route::post('/payment/store', [CoachController::class, 'storePayment'])->name('coach.payment.store');
    Route::put('/profile/update', [CoachController::class, 'updateProfile'])->name('coach.profile.update');

});

// Volunteer Dashboard
Route::group(['prefix' => 'volunteer', 'middleware' => 'auth:volunteer'], function () {
    Route::get('/dashboard', [VolunteersController::class, 'index'])->name('volunteer.dashboard');
    Route::post('/kit/save', [VolunteersController::class, 'saveKitStatus'])->name('volunteer.kit.save');
});



// System/Utility Routes
Route::get('/_boost/browser-logs', function () {
    return response('', 204);
});

require __DIR__ . '/settings.php';