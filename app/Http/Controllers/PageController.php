<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function cleaning()
    {
        // 1. Cari kategori "Cleaning"
        $cleaningCategory = ServiceCategory::where('slug', 'cleaning')->firstOrFail();

        // 2. Ambil semua layanan yang termasuk dalam kategori "Cleaning"
        // Kita hanya mengambil kolom yang dibutuhkan: nama dan path ikon
    $services = $cleaningCategory->services()->get(['id', 'name', 'icon_path']);
        
        // 3. Ambil data pekerja (misalnya, 5 tukang dengan rating tertinggi)
        $workers = User::where('role', 'tukang')
            ->orderBy('rating', 'desc')
            ->limit(5)
            ->get(['id', 'name', 'avatar_path', 'rating', 'skill']);

        // 4. Kirim semua data ke komponen Vue sebagai props
        return Inertia::render('CleaningPage', [
            'cleaningCategories' => $services,
            'cleaningWorkers' => $workers,
        ]);
    }

    public function repairing()
    {
        // 1. Cari kategori "Repairing"
        $repairingCategory = ServiceCategory::where('slug', 'repairing')->firstOrFail();

        // 2. Ambil semua layanan yang termasuk dalam kategori "Repairing"
        //    PASTIKAN ANDA MENYERTAKAN 'id'
        $services = $repairingCategory->services()->get(['id', 'name', 'icon_path']);

        // 3. Ambil data pekerja (contoh: 5 tukang acak)
        // Anda bisa membuat logika rekomendasi yang lebih kompleks di sini
        $workers = User::where('role', 'tukang')
            ->inRandomOrder()
            ->limit(5)
            ->get(['id', 'name', 'avatar_path', 'rating', 'skill']);

        // 4. Kirim semua data ke komponen Vue 'RepairingPage'
        return Inertia::render('RepairingPage', [
            'repairingCategories' => $services,
            'repairingWorkers' => $workers,
        ]);
    }

    public function showServiceWorkers(Service $service)
    {
        // Ambil semua tukang yang menawarkan layanan ini & statusnya approved
        $workers = $service->providers()
            ->where('service_user.status', 'approved')
            ->get();

        // Render halaman baru, kirim data service dan workers
        return Inertia::render('ServiceWorkersPage', [
            'service' => $service,
            'workers' => $workers,
        ]);
    }

    public function about()
    {
        return Inertia::render('AboutUs');
    }
}