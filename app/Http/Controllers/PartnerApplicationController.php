<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\PartnerApplication;

class PartnerApplicationController extends Controller
{
    // Menampilkan form pengajuan
    public function create()
    {
        return Inertia::render('BecomePartnerForm');
    }

    // Menyimpan data pengajuan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'identity_document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'profile_photo' => 'required|image|max:2048',
        ]);

        $identityPath = $request->file('identity_document')->store('partner-documents', 'public');
        $photoPath = $request->file('profile_photo')->store('avatars', 'public');

        PartnerApplication::create([
            'user_id' => $request->user()->id,
            'identity_document_path' => $identityPath,
            'profile_photo_path' => $photoPath,
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Pengajuan Anda berhasil dikirim dan sedang direview oleh Admin.');
    }
}