<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'tukang_id',
        'service_id',
        'schedule',
        'problem_description',
        'status',
        'total_price',
        'original_tukang_id',
    ];

    protected $casts = [
        'schedule' => 'datetime',
        'total_price' => 'decimal:2'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function proofs() {
        return $this->hasMany(OrderProof::class);
    }

    // app/Models/Order.php
public function warrantyClaims()
{
    return $this->hasMany(WarrantyClaim::class);
}

    public function originalTukang() {
        return $this->belongsTo(User::class, 'original_tukang_id');
    }

    // Relasi ke Rating
    public function rating(): HasOne
    {
        return $this->hasOne(Rating::class);
    }

    public function worker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tukang_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
