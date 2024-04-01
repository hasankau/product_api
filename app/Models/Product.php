<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'code',
        'category',
        'image',
        'sellingPrice',
        'specialPrice',
        'status',
        'isDeliveryAvailable'
    ];

    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class);
    }

}
