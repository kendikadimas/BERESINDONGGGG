<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia; // <-- JANGAN LUPA import Inertia

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda mendaftarkan rute web untuk aplikasi Anda.
|
*/

// Rute untuk menampilkan landing page
Route::get('/', function () {
    return Inertia::render('LandingPage');
})->name('home');

Route::get('/tambah-testimoni', function () {
    return Inertia::render('AddTestimoni');
})->name('testimonials.create');

// routes/web.php
use Illuminate\Http\Request;

Route::post('/testimonials', function (Request $request) {
    // Validasi data yang masuk
    $request->validate([
        'name' => 'required|string|max:255',
        'message' => 'required|string|max:5000',
    ]);

    // Simpan data ke database (Contoh)
    // Testimonial::create($request->all());

    // Redirect kembali dengan pesan sukses
    return back()->with('success', 'Terima kasih, testimoni Anda berhasil dikirim!');
})->name('testimonials.store');

Route::get('/about', function () {
    return Inertia::render('AboutPage');
})->name('about');

Route::get('/repairing', function () {
    return Inertia::render('RepairingPage');
})->name('repairing');

Route::get('/cleaning', function () {
    return Inertia::render('CleaningPage');
})->name('cleaning');

Route::get('/cworkers', function () {
    return Inertia::render('CleaningWorkers');
})->name('cworkers');

Route::get('/rworkers', function () {
    return Inertia::render('RepairingWorkers');
})->name('rworkers');

Route::get('/booking', function () {
    return Inertia::render('BookingForm');
})->name('booking');

// Rute untuk halaman register
Route::get('/register', function () {
    return Inertia::render('../Auth/Register'); // Contoh jika file ada di resources/js/Pages/Auth/Register.vue
})->name('register');

Route::get('/about', function () {
    return Inertia::render('AboutUs'); // Contoh jika file ada di resources/js/Pages/Auth/Register.vue
})->name('about');

// Rute untuk halaman profile (contoh dengan middleware)
Route::get('/profile', function () {
    // Ini akan merender komponen 'Profile.vue'
    return Inertia::render('ProfilePage'); // Contoh jika file ada di resources/js/Pages/Profile/Show.vue
})->name('profile');


Route::get('/emergency', function () {
    return Inertia::render('EmergencyForm');
})->name('emergency.form');

Route::get('/klaim-garansi', function () {
    return Inertia::render('WarrantyClaimForm');
})->name('warranty.claim.create')->middleware('auth'); // Contoh: hanya untuk user yang login


Route::post('/klaim-garansi', function (Request $request) {
    // Validasi data yang masuk, termasuk file gambar
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'proof_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file
    ]);

    // Simpan file yang di-upload
    if ($request->hasFile('proof_photo')) {
        $path = $request->file('proof_photo')->store('warranty_claims', 'public');
        // $validated['proof_photo_path'] = $path; // Simpan path ke database
    }

    // Simpan data ke database (Contoh)
    // WarrantyClaim::create($validated);

    // Redirect kembali dengan pesan sukses
    return back()->with('success', 'Klaim Anda berhasil diajukan!');
})->name('warranty.claim.store')->middleware('auth');

// Anda tetap bisa menyertakan file route lain di sini
require __DIR__.'/settings.php';
require __DIR__.'/auth.php'; // Pastikan route di dalam file auth.php juga menggunakan Inertia::render jika untuk frontend