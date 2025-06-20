<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Impor semua controller yang digunakan di satu tempat agar rapi
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EmergencyRequestController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PartnerApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\WarrantyClaimController; // Asumsi Anda punya controller ini

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Rute untuk bagian frontend (yang dilihat oleh customer/pengunjung).
*/

// --- Rute Halaman Utama & Statis ---
Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

// --- Rute Halaman Layanan ---
Route::get('/cleaning', [PageController::class, 'cleaning'])->name('cleaning');
Route::get('/repairing', [PageController::class, 'repairing'])->name('repairing');
Route::get('/layanan/{service}', [PageController::class, 'showServiceWorkers'])->name('services.workers');

// --- Rute Alur Booking & Pembayaran ---
Route::middleware('auth')->group(function () {
    Route::get('/booking/{service}/{tukang}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::post('/checkout/{order}', [PaymentController::class, 'createTransaction'])->name('checkout.create');
        Route::post('/ratings/{order}', [RatingController::class, 'store'])->name('ratings.store');

});
// Rute ini tidak perlu auth karena link bisa dibuka oleh siapa saja untuk bayar
Route::get('/checkout-page/{order}', [PaymentController::class, 'showCheckoutPage'])->name('checkout.show');

Route::post('/booking', [BookingController::class, 'store'])->name('booking.store')->middleware('auth');

// --- Rute Fitur Spesifik (Emergency, Garansi, Mitra, Testimoni) ---
Route::middleware('auth')->group(function () {
    Route::get('/bantuan-darurat', [EmergencyRequestController::class, 'create'])->name('emergency.create');
    Route::post('/bantuan-darurat', [EmergencyRequestController::class, 'store'])->name('emergency.store');

    // Route::get('/klaim-garansi', [WarrantyClaimController::class, 'create'])->name('warranty.claim.create');
    // Route::post('/klaim-garansi', [WarrantyClaimController::class, 'store'])->name('warranty.claim.store');
    
    Route::get('/jadi-mitra', [PartnerApplicationController::class, 'create'])->name('partner.apply');
    Route::post('/jadi-mitra', [PartnerApplicationController::class, 'store'])->name('partner.store');
    
    // Route::get('/tambah-testimoni', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/tambah-testimoni', [TestimonialController::class, 'store'])->name('testimonials.store');
});

// --- Rute Profil (Customer) ---
Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');


/*
|--------------------------------------------------------------------------
| Rute Autentikasi
|--------------------------------------------------------------------------
| File ini berisi rute untuk login, register, logout, dll.
| Sudah disediakan oleh Laravel dan seharusnya tidak perlu diubah.
*/
require __DIR__.'/auth.php';