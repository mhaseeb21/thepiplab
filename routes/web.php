<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\servicesController;
use App\Http\Controllers\signupController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\ClientPortalController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ClientServicesController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminSignalController;
use App\Http\Controllers\SignalController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AdminPurchaseRequestController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\ShowTeamController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\LiveMarketsController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\NowPaymentsController;
use App\Http\Controllers\PublicSignalController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

use App\Http\Controllers\AdminAffiliateInquiryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\AdminPartnerRequestController;
use App\Http\Controllers\StudentMaterialController;
use App\Http\Controllers\AdminStudyMaterialController;
use App\Http\Controllers\PublicPostController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\MarketWidgetController;
use App\Http\Controllers\BotRequestController;
use App\Http\Controllers\AdminBotRequestController;
use App\Http\Controllers\AdminSignalsAccessController;

Route::get('/debug/http', function () {
    $r = \Illuminate\Support\Facades\Http::get('https://www.google.com');
    return [
        'ok' => $r->successful(),
        'status' => $r->status(),
    ];
});


// ✅ Public Routes
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [servicesController::class, 'index'])->name('services');
Route::post('/affiliate', [AffiliateController::class, 'store'])->name('affiliate.store');
Route::get('/Live-prices', [LiveMarketsController::class, 'index'])->name('Live');
Route::get('/sendMail', [SendMailController::class, 'index'])->name('sendMail');
Route::get('/results', [PublicSignalController::class, 'index'])->name('signals.results');
Route::get('/results/{signal}', [PublicSignalController::class, 'show'])->name('signals.results.show');
Route::get('/insights', [PublicPostController::class, 'index'])->name('posts.public.index');
Route::get('/insights/{slug}', [PublicPostController::class, 'show'])->name('posts.public.show');

Route::get('/api/market-widget', [MarketWidgetController::class, 'index'])->name('market.widget');



// Forgot password (request reset link)
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware(['throttle:forgot-password', 'turnstile'])
    ->name('password.email');




// Reset password (from email link)
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

// ✅ Webhook (NO auth middleware)
Route::post('/webhooks/nowpayments', [NowPaymentsController::class, 'ipn'])->name('webhooks.nowpayments');


// ✅ Email verification routes (user must be logged in)
Route::middleware('auth')->group(function () {

    // Show verification notice page
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    // Handle verification link
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        // After verify, send user to dashboard
        return redirect()->route('client.dashboard');
    })->middleware('signed')->name('verification.verify');

    // Resend verification email
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');
});

Route::middleware(['auth', 'verified', 'student.course'])->prefix('client/student')->group(function () {
    Route::get('/lectures', [StudentMaterialController::class, 'lectures'])->name('student.lectures');
    Route::get('/resources', [StudentMaterialController::class, 'resources'])->name('student.resources');
});

Route::middleware(['auth','verified','student.course'])
    ->get('/client/materials/{material}/download', [StudentMaterialController::class, 'download'])
    ->name('student.materials.download');


// ✅ Client Routes
Route::prefix('client')->group(function () {

    // Guest routes
    Route::middleware('guest')->group(function () {
        Route::get('/register/{referral_code?}', [signupController::class, 'index'])->name('client.register');
        Route::post('/register', [signupController::class, 'register'])
    ->middleware(['throttle:signup', 'turnstile'])
    ->name('store.register');
        Route::get('/login', [loginController::class, 'index'])->name('client.login');
        Route::post('/login', [loginController::class, 'login'])
    ->middleware(['throttle:login', 'turnstile'])
    ->name('login');

    });

    // Authenticated but NOT verified routes (allowed)
    Route::middleware('auth')->group(function () {
        // If you want a portal accessible before verification, keep it here.
        // Otherwise move it to auth+verified group below.
        Route::get('/portal', [ClientPortalController::class, 'index'])->name('client.portal');




// NEW
Route::post('/logout', [loginController::class, 'logout'])->name('client.logout');
    });

    // ✅ Authenticated + VERIFIED routes (protected features)
        Route::middleware(['auth', 'verified'])->group(function () {

        
        
            Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
        Route::get('/profile', [ClientServicesController::class, 'index'])->name('client.services');

        Route::get('/signals', [SignalController::class, 'index'])->name('client.signals');
        Route::get('/client/signals/{signal}', [SignalController::class, 'show'])->name('client.signals.show');

        Route::get('/purchase/{product}', [PurchaseController::class, 'create'])->name('purchase.create');
        Route::post('/purchase', [PurchaseController::class, 'store'])->name('purchase.store');

        Route::get('/partner/apply', [PartnerController::class, 'create'])
        ->name('client.partner.apply');

    Route::post('/partner/apply', [PartnerController::class, 'store'])
        ->name('client.partner.store');

        // ✅ This route can stay here too (if it was "making issue" due to auth/permissions, verified will also apply)
        Route::get('/purchase-prompt', [SignalController::class, 'purchasePrompt'])->name('purchase.prompt');

        Route::get('/referrals', [ReferralController::class, 'referralDashboard'])->name('referrals.dashboard');
        Route::get('/users/{id}/referrals', [ShowTeamController::class, 'index'])->name('referrals.team');

        Route::get('/withdraw', [WithdrawController::class, 'create'])->name('client.withdraw');
        Route::post('/withdraw', [WithdrawController::class, 'store'])->name('client.withdraw.store');
        Route::get('/withdraw/history', [WithdrawController::class, 'history'])->name('client.withdraw.history');

Route::get('/bot/request', [BotRequestController::class, 'create'])->name('bot.request.create');
    Route::post('/bot/request', [BotRequestController::class, 'store'])->name('bot.request.store');

    Route::get('/bot/requests/my', [BotRequestController::class, 'myRequests'])->name('bot.request.my');

    // client actions after quote
    Route::post('/bot/requests/{id}/accept', [BotRequestController::class, 'acceptQuote'])->name('bot.request.accept');
    Route::get('/bot/requests/{id}/payment', [BotRequestController::class, 'paymentForm'])->name('bot.request.payment.form');
    Route::post('/bot/requests/{id}/payment', [BotRequestController::class, 'submitPayment'])->name('bot.request.payment.submit');

        
        // Signals subscribe (automatic)
        Route::get('/signals/subscribe', [NowPaymentsController::class, 'createSignalPayment'])
            ->name('signals.subscribe');

        // Optional success/cancel pages
        Route::get('/signals/subscribe/success', fn () => view('client.subscribe_success'))->name('subscribe.success');
        Route::get('/signals/subscribe/cancel', fn () => view('client.subscribe_cancel'))->name('subscribe.cancel');
    });
});

Route::middleware(['auth','verified','student.course'])
    ->get('/client/materials/{material}/download', [StudentMaterialController::class, 'download'])
    ->name('student.materials.download');

// ✅ Admin Routes
Route::prefix('admin')->group(function () {

    // Guest middleware for admin
    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'login'])->name('admin.authenticate');
    });

    // Authenticated admin routes
    // ✅ If your admins are also users in `users` table and you want email verification for admins too,
    // add 'verified' here as well: ['admin.auth', 'verified']
    Route::middleware(['admin.auth', 'verified'])->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        Route::get('/upload-signal', [AdminSignalController::class, 'index'])->name('admin.signal');
        Route::post('/submit-signal', [AdminSignalController::class, 'store'])->name('admin.signalUpload');

        Route::patch('/admin/purchase/{id}', [AdminPurchaseRequestController::class, 'update'])->name('admin.purchase.update');
        Route::get('/purchase-request', [AdminPurchaseRequestController::class, 'index'])->name('admin.purchaseRequest');

        Route::get('/withdraw-requests', [WithdrawController::class, 'adminIndex'])->name('admin.withdraw.requests');
        Route::post('/withdraw-requests/{id}/approve', [WithdrawController::class, 'approve'])->name('admin.withdraw.approve');
        Route::post('/withdraw-requests/{id}/reject', [WithdrawController::class, 'reject'])->name('admin.withdraw.reject');

Route::get('/materials', [AdminStudyMaterialController::class, 'index'])->name('admin.materials.index');
    Route::get('/materials/create', [AdminStudyMaterialController::class, 'create'])->name('admin.materials.create');
    Route::post('/materials', [AdminStudyMaterialController::class, 'store'])->name('admin.materials.store');

    Route::get('/materials/{material}/edit', [AdminStudyMaterialController::class, 'edit'])->name('admin.materials.edit');
    Route::put('/materials/{material}', [AdminStudyMaterialController::class, 'update'])->name('admin.materials.update');

    Route::delete('/materials/{material}', [AdminStudyMaterialController::class, 'destroy'])->name('admin.materials.destroy');


Route::get('/affiliate-inquiries', [AdminAffiliateInquiryController::class, 'index'])
    ->name('admin.affiliate.inquiries');

// Optional route
Route::post('/affiliate-inquiries/{id}/contacted', [AdminAffiliateInquiryController::class, 'markContacted'])
    ->name('admin.affiliate.inquiries.contacted');

Route::get('/partner-requests', [AdminPartnerRequestController::class, 'index'])
        ->name('admin.partner.requests');

    Route::post('/partner-requests/{id}', [AdminPartnerRequestController::class, 'update'])
        ->name('admin.partner.requests.update');

Route::get('/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
    Route::get('/posts/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts', [AdminPostController::class, 'store'])->name('admin.posts.store');

    Route::get('/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/posts/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');

    Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');

    Route::post('/posts/{post}/toggle', [AdminPostController::class, 'togglePublish'])->name('admin.posts.toggle');
Route::get('/bot-requests', [AdminBotRequestController::class, 'index'])->name('admin.bot_requests.index');
    Route::post('/bot-requests/{id}/quote', [AdminBotRequestController::class, 'sendQuote'])->name('admin.bot_requests.quote');
    Route::post('/bot-requests/{id}/status', [AdminBotRequestController::class, 'setStatus'])->name('admin.bot_requests.status');
Route::get('/signals-access', [AdminSignalsAccessController::class, 'index'])
        ->name('admin.signals.access');

    Route::post('/signals-access/grant', [AdminSignalsAccessController::class, 'grant'])
        ->name('admin.signals.access.grant');
        Route::get('/signals', [AdminSignalController::class, 'show'])->name('admin.signals.show');
        Route::post('/signals/{id}/edit', [AdminSignalController::class, 'edit'])->name('admin.signals.edit');
        Route::get('/active-signals-subscribers',[AdminPurchaseRequestController::class, 'activeSignalsSubscribers'])->name('admin.signals.subscribers');
        Route::middleware(['admin.auth'])->group(function () {

        });
      });
});