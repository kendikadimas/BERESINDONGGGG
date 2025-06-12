<?php
// app/Http/Controllers/EmergencyRequestController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\EmergencyRequest;
use Illuminate\Support\Facades\Auth;

class EmergencyRequestController extends Controller
{
    // Menampilkan form
    public function create()
    {
        return Inertia::render('EmergencyForm');
    }

    // Menyimpan permintaan darurat
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:5000',
            'photo' => 'nullable|image|max:2048', // Foto opsional
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('emergency_proofs', 'public');
        }

        EmergencyRequest::create([
            'user_id' => Auth::id(),
            'description' => $validated['description'],
            'photo_path' => $path,
            'status' => 'pending', // Status awal saat ajuan dibuat
        ]);

        // Di sini Anda akan memicu event untuk mengirim notifikasi ke semua tukang
        // event(new NewEmergencyRequest($newRequest));

        // Untuk sekarang, kita redirect dengan pesan sukses
        return redirect()->route('home')->with('success', 'Permintaan darurat Anda telah disiarkan ke semua tukang terdekat!');
    }
}