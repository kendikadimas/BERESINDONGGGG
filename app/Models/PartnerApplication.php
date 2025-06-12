<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PartnerApplication extends Model
{
    protected $fillable = [
        'user_id',
        'identity_document_path',
        'profile_photo_path',
        'status',
        'rejection_reason',
    ];

    // Relasi ke user yang mengajukan
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}