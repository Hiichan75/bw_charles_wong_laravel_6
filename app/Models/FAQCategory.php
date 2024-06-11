<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQCategory extends Model
{
    use HasFactory;

    protected $table = 'f_a_q_categories';
    protected $fillable = ['name'];

    public function faqs()
    {
        return $this->hasMany(FAQ::class, 'category_id');
    }
}

