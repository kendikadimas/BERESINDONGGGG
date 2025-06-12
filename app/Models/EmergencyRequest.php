<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EmergencyRequest extends Model
{
    protected $fillable = ['user_id', 'tukang_id', 'description', 'photo_path', 'status'];

    public function customer() { return $this->belongsTo(User::class, 'user_id'); }
    public function worker() { return $this->belongsTo(User::class, 'tukang_id'); }
}