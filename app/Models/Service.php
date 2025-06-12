<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'description', 'base_price', 'icon_path', 'service_category_id'];

    public function orders() {
        return $this->hasMany(Order::class);
    }
   
    public function Category() {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    // app/Models/Service.php
public function providers()
{
    // Menandakan bahwa sebuah Service bisa disediakan oleh banyak User (tukang)
    return $this->belongsToMany(User::class)
                ->withPivot('description', 'price', 'status')
                ->withTimestamps();
}

}
