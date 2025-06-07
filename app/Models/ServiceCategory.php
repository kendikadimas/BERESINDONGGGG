<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class ServiceCategory extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    
    public function services()
{
    return $this->hasMany(Service::class);
}
}
