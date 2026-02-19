<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'brand',
        'category_id',
        'image',
        'price',
        'old_price',
        'badge',
        'description',
        'specs',
    ];

    protected $casts = [
        'specs' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
