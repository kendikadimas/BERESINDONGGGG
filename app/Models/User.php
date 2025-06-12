<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

// Pastikan Anda juga mengimpor model lain yang direlasikan
use App\Models\Order;
use App\Models\Rating;
use App\Models\Service;

// 1. Pastikan kelas Anda mengimplementasikan FilamentUser
class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // 2. Tambahkan semua kolom baru ke dalam $fillable
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Wajib ada untuk menyimpan role
        'phone',
        'address',
        'skill',
        'avatar_path',            // Wajib ada untuk foto profil tukang
        'identity_document_path', // Wajib ada untuk KTP tukang
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'rating' => 'float',
        ];
    }

    // --- RELASI-RELASI ---

    public function ordersAsCustomer()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function ordersAsTukang()
    {
        return $this->hasMany(Order::class, 'tukang_id');
    }

    public function offeredServices()
    {
        return $this->belongsToMany(Service::class)
                        ->withPivot('description', 'price', 'status')
                        ->withTimestamps();
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'tukang_id');
    }

    // --- LOGIKA FILAMENT ---
    
    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->role === 'admin';
        }

        if ($panel->getId() === 'tukang') {
            return $this->role === 'tukang';
        }

        return false;
    }

    public function partnerApplications()
    {
        return $this->hasMany(PartnerApplication::class);
    }
    
    // app/Models/User.php
public function testimonials()
{
    return $this->hasMany(Testimonial::class);
}
}