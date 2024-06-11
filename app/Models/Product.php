<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'user_id'
    ];

    public function orders()
{
    return $this->hasMany(Order::class);
}

public function getFormattedPriceAttribute()
{
    return '€' . number_format($this->price, 2, ',', '.');
}


}
